<script src="./jquery-1.7.2.min.js"></script>
<?php
ob_start();//打开缓冲区
$time=1000;
if(!is_file("k780.html") || time()-filemtime("k780.html")>1000){
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--<link href="k780%E6%95%B0%E6%8D%AE_files/main.css" type="text/css" rel="stylesheet">
        <link href="k780%E6%95%B0%E6%8D%AE_files/index.css" type="text/css" rel="stylesheet">-->
        <link href="./k780_php_files/main.css" type="text/css" rel="stylesheet">
        <link href="./k780_php_files/index.css" type="text/css" rel="stylesheet">
        <title>k780数据</title>
        <meta name="keywords" content="接口API,IP地址,手机号码,短网址,二维码,whois,备案,alexa,pagerank,DNS,汇率">
        <meta name="description" content="向开发者提供API数据:手机号码查询、IP地址查询、身份证号码查询、短网址缩短、短网址查询、二维码生成等数据，API调用灵活方便，你身边的数据专家。">
    </head>
    <body>
   <script>
	$(document).ready(function(){
    $.get("panduan.php",function(data){
			$("#qiehuan").html(data);
		});
	});
</script>


    <div class="top">
        <div class="mod_s">
            <div class="mod_t">
                <div class="top_logo">
                    <a href="http://www.k780.com/"><img src="./k780_php_files/logo.gif"></a>
                </div>
                <div class="top_nav">
                    <h2><a style="background:#4AAB4B; color:#FFFFFF;" href="http://www.k780.com/">首页</a></h2><h2><a href="http://www.k780.com/api">数据接口</a></h2><h2><a href="http://www.k780.com/article">新闻公告</a></h2><h2><a href="http://www.k780.com/price">收费标准</a></h2><h2><a target="_blank" href="http://wiki.nowapi.com/?k780.com">社区</a></h2><h2><a target="_blank" href="https://www.nowapi.com/?app=console">用户中心</a></h2>
                </div>
                <div class="top_uinfo" id="qiehuan">
    <a href="login.php">登录</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ind_ad">
        <div class="mod_s">
            <div class="mod_s"><a href="https://www.nowapi.com/?app=account&amp;type=register"><img src="./k780_php_files/index_01.png" border="0"></a></div>
        </div>
    </div>
    <div class="mod_f">
        <div class="mod_s">

            <div class="ind">
                <div class="ind-item">
                    <div class="ind-item-dy">
                        <div class="ind-item-dy-top">最新动态</div>
                        <div class="ind-item-dy-li"><a href="http://www.k780.com/article/11.html">是时候开始使用ssl （https）了</a></div><div class="ind-item-dy-li"><a href="http://www.k780.com/article/9.html">K780的部分客户案例展示</a></div><div class="ind-item-dy-li"><a href="http://www.k780.com/article/10.html">运营公告:关于帐户邮箱验证</a></div><div class="ind-item-dy-li"><a href="http://www.k780.com/article/5.html">系統更新日志</a></div><div class="ind-item-dy-li"><a href="http://www.k780.com/article/8.html">站长工具类接口加入timeout参数</a></div>
                    </div>
                    <div class="ind-item-ru">
                        <div class="ind-item-ru-top">运行状态</div>
                        <div class="ind-item-ru-li">接口状态: 正常</div>
                        <div class="ind-item-ru-li">注册用户: 19783</div>
                        <div class="ind-item-ru-li">一分钟内响应: 87518</div>
                        <div class="ind-item-ru-li">服务器负载: 正常</div>
                        <div class="ind-item-ru-li">数据最后更新: 2016-06-10 17:00:06</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="mod_s">
            <div class="mod_t">
                <a href="http://www.k780.com/intro/about.html">联系我们</a>
                <a href="http://www.k780.com/intro/feedback.html">意见反馈</a>
                <a href="http://www.k780.com/intro/help.html">帮助中心</a>
                <a href="http://www.k780.com/intro/payment.html">付款方式</a>
                <a href="http://www.k780.com/intro/policy.html">隐私政策</a>
                <script language="javascript" type="text/javascript" src="./k780_php_files/15439909.js"></script><a href="http://www.51.la/?15439909" target="_blank" title="51.La 网站流量统计系统">网站统计</a>

                <noscript><a href="http://www.51.la/?15439909" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/15439909.asp" style="border:none" /></a></noscript><script type="text/javascript">
                    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
                    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F0519aa0e64028291465eb3dcd3f34a17' type='text/javascript'%3E%3C/script%3E"));
                </script><script src="./k780_php_files/h.js" type="text/javascript"></script><a href="http://tongji.baidu.com/hm-web/welcome/ico?s=0519aa0e64028291465eb3dcd3f34a17" target="_blank"><img src="./k780_php_files/21.gif" height="20" border="0" width="20"></a>
                <br>Copyright © 中山市汇兴网络科技有限公司
                <br><a href="tencent://message/?uin=1597000273&amp;Site=k780.com&amp;Menu=yes"><img src="./k780_php_files/qq.gif" border="0"></a>
                <a href="tencent://message/?uin=1597000273&amp;Site=k780.com&amp;Menu=yes"><img src="./k780_php_files/qq.gif" border="0"></a>
            </div>
        </div>
    </div>

    </body></html>
    <?php
    $content=ob_get_contents();//取得本php页面输出的全内容
   $fp=fopen("k780.html","w");//创建一个文件并打开
   fwrite($fp,$content);//把php页面的内容全部写入out
   fclose($fp);
}
else{
echo "cache";
echo file_get_contents("k780.html");
}

