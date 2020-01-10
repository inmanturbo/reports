<?php
if(!isset($_SESSION)){session_start();}
ob_start();
date_default_timezone_set("America/New_York");

// make connection if user is valid
require("pdo_connect.php");

//convert current date to string
list($cur_week, $cur_month, $cur_day, $cur_year)=explode(',', date("W,M,m,d,y", strtotime ("Now")));

// Begin Admin
?>