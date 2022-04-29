<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';

$chk = $db->query("SELECT sum(total) as total FROM `cart` WHERE refid = '" . $userid . "'  ");

//$emparray[] = "SELECT * FROM `cart` WHERE tempcartid = '" . $tempcartid . "' AND orderstatus = 'notplaced' ";
//echo json_encode($emparray); exit;



$count = $chk->fetch();
//$emparray[] = $count;

if($count[0] > 0){  $emparray[] = $count[0]; }else{ $emparray[] = "0"; }
echo json_encode($emparray); exit;
//echo $total;exit;  