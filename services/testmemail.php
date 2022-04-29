<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_GET);
extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
require 'phpmailler/PHPMailerAutoload.php';



$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ")->fetch();




include "service_trans_notification.php";
//include "mer_trans_notification.php";



?>