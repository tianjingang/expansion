<?php
header('content-type:text/html;charset=utf-8');
$username=$_POST['username'];
$password=$_POST['password'];
setcookie('username',$username);
echo "<script>location.href='k780.php'</script>";
?>
