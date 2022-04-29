<?php 

header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
date_default_timezone_set('Asia/Kolkata');

$date = date('Y-m-d');
include_once 'config.php';


	 
	
$resource = $db->query("SELECT merchantname,mobile,amount,DATE_FORMAT(datetime,'%d-%m-%Y %h:%i %p') as date,transid,payment_id,service,provider,utr,number,type,status,logo,provider_id FROM `transactions`  WHERE userid='" . $userid . "' AND guid = '".$_GET['transaction']."'  ");

$result=$resource->fetch();


echo json_encode($result);
?>
