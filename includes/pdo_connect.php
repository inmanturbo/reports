<?php

$c_username = "devwork";
$c_password = "123456";
$c_host= "192.168.1.2";
$c_database = "devwork";


$params=array(
'host'=>$c_host,
'user'=>$c_username,
'pwd'=>$c_password,
'db'=>$c_database,
 );

try{
$dsn=sprintf('mysql:host=%s;dbname=%s',
$params['host'],$params['db']);
$pdo=new PDO ($dsn, $params['user'], $params['pwd']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
echo $e->getMessage();
}catch (Throwable $e){
echo $e->getMessage();
}
     

?>
