<?php
/**
  **************************************************************************************************
  **********  莎莎源码 2016 WAP版官方正式版  *****  官方正版 *** 版权所有 *** 盗版必究  **********
  **********------------------------------------------------------------------------------**********
  * 官方网站：http://bbs.sasadown.cn/ 官方店铺：http://bbs.sasadown.cn/  *  官方店铺QQ：151619143 请认准再购买 *
  **************************************************************************************************
*/
$BDPHP2014='implode';$bdphpjj20148888='date';
require_once 'bdconfig.php';
require_once 'public/bdsend.php';
$out_trade_no = $GLOBALS['bdphpjj20148888'](base64_decode('WW1kSGlz'));
$dddate = $GLOBALS['bdphpjj20148888'](base64_decode('WS1tLWQgSDpp'));
$bdproduct = $_POST['bdproduct'];
$bdproductb = $_POST['bdproductb'];
$bdproxh = $_POST['bdproxh'];
$bdmun = $_POST['bdmun'];
$bdprice = $_POST['bdprice'];
$bdzfbjg = $bdprice * $alipayzk;
$bdname = $_POST['bdname'];
$bdprovince = $_POST['bdprovince'];
$bdcity = $_POST['bdcity'];
$bdarea = $_POST['bdarea'];
$bdaddress = $_POST['bdaddress'];
$bdmob = $_POST['bdmob'];
$bdpay = $_POST['bdpay'];
$bdguest = $_POST['bdguest'];
$bdqq = $_POST['bdqq'];
$bdemail = $_POST['bdemail'];
$referer = $_POST['referer'];
$bdpost = $_POST['bdpost'];
$url = $_POST['url'];
$purl = $_POST['purl'];


/**
  **************************************************************************************************
  **********  莎莎源码 2016 WAP版官方正式版  *****  官方正版 *** 版权所有 *** 盗版必究  **********
  **********------------------------------------------------------------------------------**********
  * 官方网站：http://bbs.sasadown.cn/ 官方店铺：http://bbs.sasadown.cn/  *  官方店铺QQ：151619143 请认准再购买 *
  **************************************************************************************************
*/

$mail = new PHPMailer();
$mail->CharSet = base64_decode('Z2IyMzEy');
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 25;
$mail->Host = $Mailhost;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->From = $MailFrom;
$mail->FromName = $FromName;
$mail->AddAddress($MailTo, $FromName);
$mail->AddAddress($MailTob, $FromName);
$mail->WordWrap = 50;
$mail->IsHTML(true);
?>