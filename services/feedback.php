<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');

extract($_GET);

$postad = $db->query("INSERT INTO feedback (`name`,`mobile`,`subject`,`message`,`userid`,`deviceid`,`regid`,`date`) VALUES ('$name','$mobile','$subject','$message','".$userid."','$deviceid','".$regid."','$date')");
		
	
if($postad) {

include "feedbackmail.php";

$insid = $db->lastInsertId();				
$result =  $insid;
}else{ $result = "Error";}

echo json_encode($result);


?>