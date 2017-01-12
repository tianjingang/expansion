<?php
/**
  **************************************************************************************************
  **********  莎莎源码 2016 WAP版官方正式版  *****  官方正版 *** 版权所有 *** 盗版必究  **********
  **********------------------------------------------------------------------------------**********
  ****** 官方网站：http://bbs.sasadown.cn/  *****  莎莎源码 ********
  **************************************************************************************************
  **********------------------------------------------------------------------------------**********
  **********  莎莎源码 2016 WAP版官方正式版完全开源无任何加密 杜绝倒卖 鄙视加密捣卖者   **********
  **************************************************************************************************
 */
 
session_start();
require_once 'public/bdnet.php';
date_default_timezone_set('Asia/Shanghai');

$mail->Subject = "订单编号".$out_trade_no."，".$bdname."-".$bdmob."来新订单咯，请注意！";
$mail->Body = "

	<p style='height:40px;line-height:40px;font-size:28px;font-weight:bold;color:#bd0a01'>".$FromName."订单详情</p>
	<p>【订单编号】：<font color='#BD0000'>".$out_trade_no."</font></p>
	<P>【订购产品】：".$bdproduct."</P>";
	if(!empty($_POST['bdproductb'])){$mail->Body .= '<p>【产品型号】：'.$bdproductb.'</p>';};
	$mail->Body .="<P>【数量】：".$bdmun."</P>
	<P>【收货姓名（会员名）】：".$bdname."</P>
	<P>【电话号码】：<a href='http://www.baidu.com/s?wd=".$bdmob."'>".$bdmob."</a></P>
	<P>【所在地区】：".$bdprovince.$bdcity.$bdarea."</P>
	<P>【详细地址】：".$bdaddress."</P>
	<P>【付款方式】：".$bdpay."</P>
	<P>【留言备注】：".$bdguest."</P>
	<P>【来路页面】：".$referer."</P>
	<P>【下单页面】：".$purl."</P>
	<P>【下单IP】：<a href='http://www.baidu.com/s?wd=".$_SERVER['REMOTE_ADDR']."'>".$_SERVER['REMOTE_ADDR']."</a></P>
";

if(empty($_POST['bdname'])||empty($_POST['bdmob'])){
    echo "<p style='font-size:12px;color:#BD0000;'>错误提示：CLPHP订单系统2015提示您：空单不允许提交！<a href='"."$_SERVER[HTTP_REFERER]"."'>>返回重新填写!>>></a></p>";
    exit(0);
}
if (isset($_SESSION["post_sep"])){
    if (time() - $_SESSION["post_sep"] < $allow_sep){
	    exit("<script>alert('$sepmsg');javascript:history.go(-1);</script>");
	}
	else{
	    $_SESSION["post_sep"] = time();
	} 
} 
else{
    $_SESSION["post_sep"] = time(); 
}
if(!$mail->Send()){
	
	if($clwrite=="on"){

		$f = fopen($cldatadir,"a");
		fwrite($f,$cldata);
		fclose($f);
		}
    echo 'CLPHP订单系统2015友情提示您:邮件发送失败！别担心，您提交的订单信息没有丢失，已写入数据文件中。您还可以提示站长从以下三个方面依次排除邮件发送失败原因：第一，检查bdconfig.php配置文件中发件箱地址、邮箱SMTP服务器地址、发件箱登录密码(如果必须开启客户端授权密码才能开启POP3服务的163邮箱作为发件箱，则需要将登录密码改成客户端授权密码）是否正确配置好；第二，检查您的发件箱是否开启pop3服务；第三，检查空间是否禁用SMTP，fsockopen、pfsockopen和stream_socket_client三个函数至少要开一个。';
}

/**
  **************************************************************************************************
  **********  温馨提示产品名字尽量简短才好  ********  莎莎源码  **********
  **************************************************************************************************
*/


	elseif($bdpay=="支付宝支付"){
	if($zfbwkfs=="skm"){
	$url="public/bd_alipay.php?payAmount=".$bdzfbjg."&bdproduct=".urlencode($bdproduct)."&bdname=".urlencode($bdname)."&bdmob=".urlencode($bdmob)."&out_trade_no=".urlencode($out_trade_no);
	//echo $url;
	Header("Location:$url"); 
    exit;
	}
	elseif($zfbwkfs=="sh"){
	 $url="alipay/pay_".$alipaytype."/alipayapi.php?wfproduct=".urlencode($bdproduct)."&wfmun=".$bdnum."&wfzfbjg=".$bdzfbjg."&wfname=".urlencode($bdname)."&wfaddress=".urlencode($bdaddress)."&wfmob=".$bdmob."&wftel=".$bdtel."&wfpost=".$bdpost."&wfguest=".urlencode($bdguest)."&wfno=".$out_trade_no;
    Header("Location:$url"); 
    exit;
	}
}
elseif($bdpay=="微信支付"){

	$url="public/cl_weixin.php?payAmount=".$bdzfbjg."&bdproduct=".urlencode($bdproduct)."&bdname=".urlencode($bdname)."&bdmob=".urlencode($bdmob)."&out_trade_no=".urlencode($out_trade_no);
	//echo $url;
	Header("Location:$url"); 
    exit;
	}
else{
header("location:./public/bdddok.php?out_trade_no=$out_trade_no&bdproduct=$bdproduct&bdname=$bdname&bdmob=$bdmob&bdprovince=$bdprovince&bdcity=$bdcity&bdarea=$bdarea&bdaddress=$bdaddress&bdpay=$bdpay");
    exit;
}
?>