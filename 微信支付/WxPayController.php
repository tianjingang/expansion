<?php
/**
 * Created by PhpStorm.
 * Date: 16/10/21
 * auther:luoya
 * email:15075002926@163.com
 *
 */

// use Yii;
// use yii\web\Controller;

	class WxPayController extends Controller
	{

		private $wechatInfo;

		private $userWechatInfo;

		private $videoId;

		private $paySSLCert = '/wxb/www/apiv2/WxpayAPI_php_v3/cert/apiclient_cert.pem';

	    private $paySSLKey = '/wxb/www/apiv2/WxpayAPI_php_v3/cert/apiclient_key.pem';

		private $payKey = 'c051cb1b4e836bad21cb176701ee4881';

		public function __construct()
		{
			$this->wechatInfo = Yii::app()->params['wechat'];
		}

		public function actionIndex(){
			//使用jsapi接口
			$jsApi = new JsApi_pub();

			//=========步骤1：网页授权获取用户openid============
			//通过code获得openid
			if (!isset($_GET['code']))
			{
				//触发微信返回code码
				$url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL);
				Header("Location: $url"); 
			}else
			{
				//获取code码，以获取openid
				$code = $_GET['code'];
				$jsApi->setCode($code);
				$openid = $jsApi->getOpenId();
			}
		}

		//当前为获取用户授权
		public function actionUserOauth()
		{


			/**
			 * 1. 用户授权放在用户进入页面之后；
			 * 2. 用户授权后通过code获取openid和access_token，将openid入库，将access_token存入缓存中，缓存存入名称为（user_wechat_info_用户的openid）;
			 */


			// $this->userWechatInfo = Yii::app()->cache->get('user_wecaht_info');

			 // if(empty($this->userWechatInfo)){

				  $this->wechatInfo = Yii::app()->params['wechat'];
				  $code = $_GET['code'];
				  $this->videoId = $_GET['state'];

				  $http = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->wechatInfo['app_id'].'&secret='.$this->wechatInfo['app_secret'].'&code='.$code.'&grant_type=authorization_code';
				  $userInfo = file_get_contents($http);
				  $userInfo = json_decode($userInfo, true);
				  $userInfo['expires_time'] = time() + $userInfo['expires_in'];
				
				  $this->userWechatInfo = $userInfo;
			//print_r($this->userWechatInfo['openid']);die;
		    // 	Yii::app()->cache->set('user_wecaht_info', $userInfo);
			// }
			// print_r($this->userWechatInfo);
			$this->actionCreateOrder();
		}

		public function actionCreateOrder()
		{

			$playlistid = $this->videoId;

			$connection = Yii::app()->db;  
			$sqla = "SELECT id,videofilesize FROM `t_v_video` where playlistid = $playlistid";
			$command = $connection->createCommand($sqla);  
			$val= $command->queryAll();
			$video_id = $val[0]['id'];
			$sqlb = "SELECT * FROM `t_v_playlist` where id = $playlistid"; 
			$command = $connection->createCommand($sqlb);  
			$data= $command->queryAll();
			$data = $data[0];

			$orderNo = date('YmdHis', time()).rand(1000, 9999);
			$price = 1;
			$clientIp = $this->getIP();
			//回调不能带参数
			$notifyUrl = $this->appurl.'/notify.php';
			//echo $notifyUrl;die;
			$order = $this->getUnifiedOrder('酷刻家庭影院-'.$data['name'], $orderNo, 1, $clientIp, $notifyUrl, $this->userWechatInfo['openid']);
			/*$order = array(
				'return_code' => 'SUCCESS',
				'return_msg' => 'OK',
				'appid' => 'wx90a2f51d7a64ceb0',
				'mch_id' => '1394432302',
				'nonce_str' => 'XhthVaDVb6tTZ7T1',
				'sign' => 'A51248574EE448D55F907D0FBD3DDAAD',
				'result_code' => 'SUCCESS',
				'prepay_id' => 'wx2016102718540942fa0a154d0233800134',
				'trade_type' => 'JSAPI'
			);
			*/
			$wechatData = [
	            'appId' => $this->wechatInfo['app_id'],
	            'timeStamp' => (string)time(),
	            'nonceStr' => $this->generateNonceStr(32),
	            'package' => 'prepay_id=' . $order['prepay_id'],
	            'signType' => 'MD5'
	        ];

	        $wechatData['paySign'] = $this->getPaySign($wechatData, $this->payKey);


			//价格
			$data['price']=$price;
			//订单号
			$data['order_number']=$orderNo;
			//下单时间
			$data['order_time']=date("y-m-d H:i:s",time());
			//订单过期时间
			$data['aead_time']=date("Y-m-d H:i:s",strtotime("+1 day"));
			//支付状态
			$data['status_order']=0;
			//用户唯一标识
			$data['user_openid']=$this->userWechatInfo['openid'];
			//文件大小
			$data['filesize']=$val[0]['videofilesize'];


			$name=$data['name'];
			$price=$data['price'];
			$order_time=$data['order_time'];
			$aead_time=$data['aead_time'];
			$status_order=$data['status_order'];
			$openid=$data['user_openid'];
			$filesize=$data['filesize'];
			//file_put_contents('/wxb/www/apiv2/logs/filefilefilesize.log',var_export($filesize,1),FILE_APPEND);die;
			$sqla="insert into t_v_user_order (playlist_id,video_id,video_name,video_price,order_number,order_time,aead_time,status_order,user_openid,filesize)values('$playlistid','$video_id','$name','$price','$orderNo','$order_time','$aead_time','$status_order','$openid','$filesize')";
			file_put_contents('/wxb/www/apiv2/logs/baysqla.log',var_export($sqla,1),FILE_APPEND);
			$connection = Yii::app()->db; 
			$commandb = $connection->createCommand($sqla);
			$commandb->execute();
			return $this->renderPartial('/WxPlayVideo/Toplay',[
				'data'=>$data,
				'wechatInfo' => $this->wechatInfo,
				'wechatData' => $wechatData
			]);

		}
		//交易成功回调方法
		public function actionUpdateOrder()
		{	
			/*
				$Id = $this->videoId;
				$connection = Yii::app()->db; 
				$sql="update t_v_user_order set status_order = 1 where id=$Id";	
				$commandb = $connection->createCommand($sql);  
				$res= $commandb->execute();
			//$data = file_get_contents("php://input");
				*/
				//$data = file_get_contents($GLOBALS['HTTP_RAW_POST_DATA']);
				

				$url =  YII::app()->basePath . '/data/1.log';
				
				$re = file_put_contents("$url","zhifu");
			
		}

		private function getUnifiedOrder($body, $tradeNo, $totalFee, $clientIp, $notifyUrl, $openid, $goodsTag = '') {

	     	$now = time();
	    	$data = [
	    		'appid' => $this->wechatInfo['app_id'],
	    		'mch_id' => $this->wechatInfo['mch_id'],
	    		'nonce_str' => $this->generateNonceStr(),
	    		'body' => $body,
	    		'out_trade_no' => $tradeNo,
	    		'total_fee' => $totalFee,
	    		'spbill_create_ip' => $clientIp,
	    		'notify_url' => $notifyUrl,
	    		'trade_type' => 'JSAPI',
	            'openid' => $openid,
	            'time_start' => date('YmdHis', $now),
	            'time_expire' => date('YmdHis', $now + 86400)
	    	];

	        if ($goodsTag)
	        {
	            $data['goods_tag'] = $goodsTag;
	        }

	    	$data['sign'] = $this->getPaySign($data, $this->payKey);

	    	$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
	    	$post = $this->xml_encode($data);

	    	$res = $this->http_post($url, $post);

	    	$res = (array)simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
	    	return $res;
	    }

	    /**
		 * 生成随机字串
		 * @param number $length 长度，默认为16，最长为32字节
		 * @return string
		 */
		public function generateNonceStr($length=16){
			// 密码字符集，可任意添加你需要的字符
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$str = "";
			for($i = 0; $i < $length; $i++)
			{
				$str .= $chars[mt_rand(0, strlen($chars) - 1)];
			}
			return $str;
		}

		public function getPaySign($data, $key) {
	    	if (!$data || !$key) {
	    		return false;
	    	}

	        ksort($data);
	    	$keys = array_keys($data);

	    	$newData = array();
	    	foreach ($keys as $k) {
	    		if ($data[$k] !== '') {
	    			$newData[$k] = $data[$k];
	    		}
	    	}
	    	$str = urldecode(http_build_query($newData)) . '&key=' . $key;
	    	return strtoupper(md5($str));
	    }

	    /**
		 * XML编码
		 * @param mixed $data 数据
		 * @param string $root 根节点名
		 * @param string $item 数字索引的子节点名
		 * @param string $attr 根节点属性
		 * @param string $id   数字索引子节点key转换的属性名
		 * @param string $encoding 数据编码
		 * @return string
		*/
		public function xml_encode($data, $root='xml', $item='item', $attr='', $id='id', $encoding='utf-8') {
		    if(is_array($attr)){
		        $_attr = array();
		        foreach ($attr as $key => $value) {
		            $_attr[] = "{$key}=\"{$value}\"";
		        }
		        $attr = implode(' ', $_attr);
		    }
		    $attr   = trim($attr);
		    $attr   = empty($attr) ? '' : " {$attr}";
		    $xml   = "<{$root}{$attr}>";
		    $xml   .= self::data_to_xml($data, $item, $id);
		    $xml   .= "</{$root}>";
		    return $xml;
		}

		/**
		 * 数据XML编码
		 * @param mixed $data 数据
		 * @return string
		 */
		public static function data_to_xml($data) {
		    $xml = '';
		    foreach ($data as $key => $val) {
		        is_numeric($key) && $key = "item id=\"$key\"";
		        $xml    .=  "<$key>";
		        $xml    .=  ( is_array($val) || is_object($val)) ? self::data_to_xml($val)  : self::xmlSafeStr($val);
		        list($key, ) = explode(' ', $key);
		        $xml    .=  "</$key>";
		    }
		    return $xml;
		}

		public static function xmlSafeStr($str)
		{
			return '<![CDATA['.preg_replace("/[\\x00-\\x08\\x0b-\\x0c\\x0e-\\x1f]/",'',$str).']]>';
		}

		/**
		 * POST 请求
		 * @param string $url
		 * @param array $param
		 * @param boolean $post_file 是否文件上传
		 * @return string content
		 */
		public function http_post($url,$param,$post_file=false, $useCert = false){
			$oCurl = curl_init();
			if(stripos($url,"https://")!==FALSE){
				curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
			}

	        // if ($this->isServiceProvider)
	        // {
	        //     $this->paySSLCert = storage_path('cert/' . env('WECHAT_SERVICE_PROVIDER_MCHID') . '_apiclient_cert.pem');
	        //     $this->paySSLKey = storage_path('cert/' . env('WECHAT_SERVICE_PROVIDER_MCHID') . '_apiclient_key.pem');
	        // }

			if($useCert == true){
				//设置证书
				//使用证书：cert 与 key 分别属于两个.pem文件
				curl_setopt($oCurl, CURLOPT_SSLCERTTYPE,'PEM');
				curl_setopt($oCurl, CURLOPT_SSLCERT, $this->paySSLCert);
				curl_setopt($oCurl, CURLOPT_SSLKEYTYPE,'PEM');
				curl_setopt($oCurl, CURLOPT_SSLKEY, $this->paySSLKey);
			}

	        if ($post_file)
	        {
	            $fileFields = [];
	            foreach ($param as $fieldName => $filename)
	            {
	                $fileFields[$fieldName] = curl_file_create($filename);
	            }
	            $strPOST = $fileFields;
	        }
	        else if (is_string($param))
	        {
			    $parseData = json_decode($param);
			    if ($parseData) {
			    	curl_setopt($oCurl, CURLOPT_HTTPHEADER, [
			    		'Content-Type: application/json',
	    	    		'Content-Length: ' . strlen($param)
	    	    	]);
			    	curl_setopt($oCurl, CURLOPT_CUSTOMREQUEST, "POST");
			    }
				$strPOST = $param;
	        }
	        else
	        {
				$aPOST = array();
				foreach($param as $key=>$val){
					$aPOST[] = $key."=".urlencode($val);
				}
				$strPOST =  join("&", $aPOST);
			}
			curl_setopt($oCurl, CURLOPT_URL, $url);
			curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($oCurl, CURLOPT_POST, true);
			curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
			$sContent = curl_exec($oCurl);
			$aStatus = curl_getinfo($oCurl);
			curl_close($oCurl);
			if(intval($aStatus["http_code"])==200){
				return $sContent;
			}else{
				return false;
			}
		}
		//获取ip参数
		private function getIP(){

			if(!empty($_SERVER["HTTP_CLIENT_IP"])){
			  $cip = $_SERVER["HTTP_CLIENT_IP"];
			}
			elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
			  $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			}
			elseif(!empty($_SERVER["REMOTE_ADDR"])){
			  $cip = $_SERVER["REMOTE_ADDR"];
			}
			else{
			  $cip = false;
			}

			return $cip;
		}
			
	}

