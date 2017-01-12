<?php
require_once "jssdk.php";
$jssdk = new JSSDK('wx90a2f51d7a64ceb0','84f4659ceccf66d2e71775c1458b0699');
$signPackage = $jssdk->GetSignPackage();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>提交支付</title>
		<meta name="viewport" content="width=device-width initial-scale=1,minimum-scale=1,maximum-scale=1,user-scable=no" />
		<meta name="format-detection" content="telephone=no"/>
		<link rel="stylesheet" href="<?php echo $this->staticUrl?>/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->staticUrl?>/css/swiper.min.css"/>
		<script type="text/javascript" src="<?php echo $this->staticUrl?>/js/jquery-1.8.3.min.js" ></script>
	</head>
		<input name='orderid' type='hidden' value='<?= $data["order_number"] ?>'/>
					<!--
						<?php //echo $jsApiParameters; ?>
					-->
	
	<script>
		//调用微信JS api 支付
			function jsApiCall()
			{
				
				var orderid = $('input[name="orderid"]').val();
				var strRandom = 
				WeixinJSBridge.invoke(
					'getBrandWCPayRequest',
					<?php echo json_encode($wechatData)?>,
					function(res){
						WeixinJSBridge.log(res.err_msg);
						if(res.err_msg=="get_brand_wcpay_request:cancel"){
							alert("已取消微信支付");
						}else if(res.err_msg=="get_brand_wcpay_request:ok"){
							//alert('支付成功,自动跳转进入下载页面');
									$.get('http://api.wefi.com.cn/apiv2/index.php?r=WxPlayVideo/getUrl',{o:orderid},function(e){
										if(e=="交易成功"){
											location.href=("http://api.wefi.com.cn/apiv2/index.php?r=WxPlayVideo/auth");
										}else{
											location.href=("http://api.wefi.com.cn/apiv2/index.php?r=WxPlayVideo/auth&callback="+e);
										}
										
									});
							}else{
								alert("微信服务器故障,请重新支付");
							}
						}
					);
				}

			function callpay()
			{
				if (typeof WeixinJSBridge == "undefined"){
					if( document.addEventListener ){
						document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
					}else if (document.attachEvent){
						document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
						document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
					}
				}else{
					jsApiCall();
				}
			}
	</script>

	<body>
		<!--顶部信息-->
		<header>
			 <h1 class="logo"><a href="?r=WxPlayVideo/Index"></a></h1>
			 <ul class="nav-bar">
				<li><a href="?r=WxPlayVideo/Search" class="search-icon"></a></li>			 	
				<li><a href="?r=WxPlayVideo/Download" class="down-icon"></a></li>			 	
				<li><a href="?r=WxPlayVideo/Info" class="info-icon"></a></li>			 	
			 </ul>			
		</header>
		<html id="html"></html>
		<!--订单详情-->
		<div class="fontstyle col-3 bobCl10 order-tit">订单详情</div>
		<ul class="fontstyle col-3 bobCl10 order-text">
			<li><label>影片名称：</label><span id="video_name"><?php echo $data['name'] ?></span></li>
			<li><label>清  晰  度：</label><span>4K</span></li>
			<li><label>声音规格：</label><span>杜比7.1环绕声</span></li>
			<li><label>影片大小：</label><span><?php $filesize=$data['filesize']; echo round($filesize/1073741824,2); ?>G</span></li>		
		</ul>
		<div class="order-play bobCl10 fontstyle">
		   <p class="col-3 padd1">您支付<span id="video_price" class="col-red"><?php echo $data['price'] ?>RMB</span>即可拥有该片</p>
		</div>
		<div class="order-state mb58">
			<h4>购买说明</h4>
			<p>当您确认支付后，该片将迅速获取下载授权，并开始离线下载，
				影片将存储在酷刻盒子里，下载完成后，可以用盒子遥控器打开盒子内安装的酷刻家庭影院APP，
				选择电影，点击播放即可放映影片</p>			
		</div>		
		<div class="btn-down">
			<a href="javascript:void(0);"  onclick="callpay()" class="btn">确认支付</a>
		</div>

	</body>
</html>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	
