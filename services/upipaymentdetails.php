<?php 

header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
date_default_timezone_set('Asia/Kolkata');

$date = date('Y-m-d');
include_once 'config.php';


	 
	
$resource = $db->query("SELECT * FROM `upi_payments`  WHERE  guid = '".$_GET['transaction']."'  ");

$result=$resource->fetch();


echo json_encode($result);
?>
