<?php
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','dakshinp_dakshinpay');
define('DB_USER','dakshinp_dakshinpay');
define('DB_PASS','sO$CWcz&*{Cq'); 
$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8', DB_USER, DB_PASS,  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
return($db);
?>