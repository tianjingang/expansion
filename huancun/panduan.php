<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/16
 * Time: 10:49
 */
if(isset($_COOKIE['username'])){
    echo "欢迎".$_COOKIE['username']."登陆&nbsp;&nbsp;<a href='outlogin.php'>退出</a>";

}else{
    echo "<a href='login.php'>登录</a>";
}

?>