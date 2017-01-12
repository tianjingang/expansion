<?php
	require_once("../bdconfig.php");
	$optEmail = $wxh;
	$payAmount = $_GET['payAmount'];
		$memo = "订单产品：".$_GET['bdproduct']."，姓名（会员名）：".$_GET['bdname']."，手机：".$_GET['bdmob']."，订单编号：".$_GET['out_trade_no'];
	$smsNo = $_GET['bdmob'];
?>
<html>
<head>


<meta http-equiv="content-type" content="text/html; charset=gb2312">

<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
<title>扫二维码微信支付</title>
<style type="text/css">

    *{margin:0;padding:0;}
    body{font:14px Microsoft YaHei,\5FAE\8F6F\96C5\9ED1,SimSun,\5B8B\4F53,Arial,Verdana;color:#000;text-align:left;padding-top:0px;background:#FFF;} 
    a:link,a:visited{color:#F00;text-decoration:none;}a:hover{color:#090;text-decoration:underline;}
    ul,li{list-style:none;display:block;}
    img{border:0 none;vertical-align:middle;}

    #bdok{
	width: 100%;
	background: #FFF;
}
    #bdok ul{
	width: 100%;
	height: auto;
	margin: 20px auto;
}    
    #bdok li{
	width: 100%;
	height: 40px;
	line-height: 40px;
	border-bottom: 1px dotted #DDD;
}    
    #bdok li span.l{
	float: left;
	width: 30%;
	text-align: right;
	margin-right: 20px;
}    
    #bdok li span.r{
	float: left;
	width: 55%;
	color: #BD0000;
} 
    #foot{
	width: 100%;
	padding-top: 90px;
	padding-right: 0;
	padding-left: 0;
	padding-bottom: 0;
	text-align: center;
	border-top: 2px dotted #DDD;
}
    #foot p.go{font:12px SimSun,\5B8B\4F53,Arial,Verdana;color:#090;margin-bottom:20px;}
    #time{font:14px Arial,Verdana;color:#F90;font-weight:bold;}
</style>
</head>

<body style="width:100%; margin:0px auto">

<div align="center" style="font-family: '微软雅黑'; font-size: 18px; color: #071BF5; width:100%">
<img src="wxfk1.png" width="100%">
<img src="wxfk.png" width="30%">
</div>
<div align="center" style="font-family: '微软雅黑'; font-size: 18px; color: #071BF5; width:100%; " >请用手机打开微信APP，扫一扫上面的二维码图案，<br>免加好友向本站付款<span style="color: #F50707"><?php echo $payAmount ?></span>元。<br>付款前请确保收款微信号是<span style="color: #F50707"><?php echo $optEmail ?></span>，建议付款说明中填写亲提交订单时填写的手机号(QQ号)码“<span style="color: #F50707"><?php echo $smsNo ?></span>”，方便核对订单信息，谢谢！<br>
  <span style="color: #0DA406">附亲提交的部分订单信息：（有问题直接联系QQ151619143）</span></div>

<div id="bdok">
    <ul>
        <li>
            <span class="l">订单号：</span>
          <span class="r"><?php echo $_GET['out_trade_no']; ?></span>
        </li>
        <li>
            <span class="l">订购产品：</span>
            <span class="r"><?php echo $_GET['bdproduct']; ?></span>
        </li>

        
        <li>
            <span class="l">收货人（会员名）：</span>
            <span class="r"><?php echo $_GET['bdname']; ?></span>
        </li>
        <li>
            <span class="l">手机号(QQ号)码：</span>
            <span class="r"><?php echo $_GET['bdmob']; ?></span>
        </li> 

    </ul>
</div>
<p align="center"><a href='<?php echo $_SERVER['HTTP_REFERER']?>' title="返回"><img src="../template/images/bdgo.gif" width="100%" alt="返回" /></a></p>

</body>
</html>
