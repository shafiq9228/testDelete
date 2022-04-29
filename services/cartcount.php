<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';

$chk = $db->query("SELECT * FROM `cart` WHERE refid = '" . $userid . "' ");

//$emparray[] = "SELECT * FROM `cart` WHERE tempcartid = '" . $tempcartid . "' AND orderstatus = 'notplaced' ";
//echo json_encode($emparray); exit;



$count = $chk->rowCount();
$emparray[] = $count;
echo json_encode($emparray); exit;
  