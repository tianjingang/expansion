<?php
	require_once("../bdconfig.php");
	$optEmail = $bdzhifubao;
	$totleFee = $bdpay;
	 
	$isSend = $bdzfsm;
 
	$bankFullName =$bdbank_yh;
	$optCardNo = $bdbank_kh;
	
	
 
	
?>
<html>
<head>
<meta charset="gb2312">
<title>������ת��֧��ҳ��...</title>
</head>

<body>
<form id="alipaysubmit" name="alipaysubmit" action="https://shenghuo.alipay.com/transfercore/confirmSuperNet.htm" method="POST">
  <input type="hidden" name="optEmail" value="<?php echo $optEmail ?>"/>
  <input type="hidden" name="totleFee" value="<?php echo $totleFee ?>"/>
  <input type="hidden" name="bankFullName" value="<?php echo $bankFullName ?>"/>
  <input type="hidden" name="memo" value="<?php echo $isSend ?>"/>
  <input type="hidden" name="optCardNo" value="<?php echo $optCardNo ?>"/>
  <input type="hidden" name="smsNo" value="<?php echo $smsNo ?>"/>
  <!--<input type="hidden" value="submit" value="����Ϊ����ת��֧��������ҳ��,��δ�Զ�ת������...">-->
  <input type="hidden" value="submit"  >
</form>
<script type="text/javascript">
   document.forms['alipaysubmit'].submit();
</script>
</body>
</html>
