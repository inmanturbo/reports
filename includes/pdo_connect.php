<?php
$c_username = "root";
$c_password = "";
$c_host= "127.0.0.1";
$c_database = "devwork";

global $pdo;
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
