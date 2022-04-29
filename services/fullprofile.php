<?php 

header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);

$date = date('Y-m-d');
include_once 'config.php';

$user_id=$_GET['userid'];



$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ");



$result=$reg->fetch();


echo json_encode($result);
?>
