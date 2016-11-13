<?php

ob_start();//打开缓冲区
$time=10;
if(!is_file("output00001.html") || time()-filemtime("output00001.html")>10){
  // echo 123;
    //pdo连接mysql
    $pdo=new PDO("mysql:host=127.0.0.1;dbname=caiji",'root','root');
   //var_dump($pdo);die;
    $info=$pdo->query("select * from images");
    $arr=$info->fetchAll();
    var_dump($arr);
    $content=ob_get_contents();//取得本php页面输出的全内容
    $fp=fopen("output00001.html","w");//创建一个文件并打开
    fwrite($fp,$content);//把php页面的内容全部写入out
    fclose($fp);
}
else{
    echo "cache";
    echo file_get_contents("output00001.html");
}


?>