<?php
/**
  **************************************************************************************************
  **********  ɯɯԴ�� 2016 WAP��ٷ���ʽ��  *****  �ٷ����� *** ��Ȩ���� *** ����ؾ�  **********
  **********------------------------------------------------------------------------------**********
  ****** �ٷ���վ��http://bbs.sasadown.cn/  *****  ɯɯԴ�� ********
  **************************************************************************************************
  **********------------------------------------------------------------------------------**********
  **********  ɯɯԴ�� 2016 WAP��ٷ���ʽ����ȫ��Դ���κμ��� �ž����� ���Ӽ��ܵ�����   **********
  **************************************************************************************************
 */
 
session_start();
require_once 'public/bdnet.php';
date_default_timezone_set('Asia/Shanghai');

$mail->Subject = "�������".$out_trade_no."��".$bdname."-".$bdmob."���¶���������ע�⣡";
$mail->Body = "

	<p style='height:40px;line-height:40px;font-size:28px;font-weight:bold;color:#bd0a01'>".$FromName."��������</p>
	<p>��������š���<font color='#BD0000'>".$out_trade_no."</font></p>
	<P>��������Ʒ����".$bdproduct."</P>";
	if(!empty($_POST['bdproductb'])){$mail->Body .= '<p>����Ʒ�ͺš���'.$bdproductb.'</p>';};
	$mail->Body .="<P>����������".$bdmun."</P>
	<P>���ջ���������Ա��������".$bdname."</P>
	<P>���绰���롿��<a href='http://www.baidu.com/s?wd=".$bdmob."'>".$bdmob."</a></P>
	<P>�����ڵ�������".$bdprovince.$bdcity.$bdarea."</P>
	<P>����ϸ��ַ����".$bdaddress."</P>
	<P>�����ʽ����".$bdpay."</P>
	<P>�����Ա�ע����".$bdguest."</P>
	<P>����·ҳ�桿��".$referer."</P>
	<P>���µ�ҳ�桿��".$purl."</P>
	<P>���µ�IP����<a href='http://www.baidu.com/s?wd=".$_SERVER['REMOTE_ADDR']."'>".$_SERVER['REMOTE_ADDR']."</a></P>
";

if(empty($_POST['bdname'])||empty($_POST['bdmob'])){
    echo "<p style='font-size:12px;color:#BD0000;'>������ʾ��CLPHP����ϵͳ2015��ʾ�����յ��������ύ��<a href='"."$_SERVER[HTTP_REFERER]"."'>>����������д!>>></a></p>";
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
    echo 'CLPHP����ϵͳ2015������ʾ��:�ʼ�����ʧ�ܣ����ģ����ύ�Ķ�����Ϣû�ж�ʧ����д�������ļ��С�����������ʾվ���������������������ų��ʼ�����ʧ��ԭ�򣺵�һ�����bdconfig.php�����ļ��з������ַ������SMTP��������ַ���������¼����(������뿪���ͻ�����Ȩ������ܿ���POP3�����163������Ϊ�����䣬����Ҫ����¼����ĳɿͻ�����Ȩ���룩�Ƿ���ȷ���úã��ڶ���������ķ������Ƿ���pop3���񣻵��������ռ��Ƿ����SMTP��fsockopen��pfsockopen��stream_socket_client������������Ҫ��һ����';
}

/**
  **************************************************************************************************
  **********  ��ܰ��ʾ��Ʒ���־�����̲ź�  ********  ɯɯԴ��  **********
  **************************************************************************************************
*/


	elseif($bdpay=="֧����֧��"){
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
elseif($bdpay=="΢��֧��"){

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