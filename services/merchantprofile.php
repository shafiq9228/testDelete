<?php 

header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);

$date = date('Y-m-d');
include_once 'config.php';

$user_id=$_GET['userid'];

    
 $resource = $db->query("SELECT * FROM `merchants`  WHERE guid = '" . $merchant . "'   ");   

$result=$resource->fetch();


echo json_encode($result);
?>
