<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";
extract($_POST);
extract($_GET);
//print_r($_GET);
$date = date('Y-m-d');

function get_data($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

$reg = $db->query("SELECT * FROM register WHERE  guid = '".$tempuserid."'  ")->fetch();

	

		
if($reg) {
	
$otp = rand(1000,9999);

$postad = $db->query("UPDATE register SET otp = '".$otp."'  WHERE guid = '".$reg['guid']."'");

$message = "$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T%26C https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.";
$sms=str_replace(" ","%20","$message");  

//$url = "https://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=catchway2020&mobilenumber=$reg[mobile]&message=$sms&sid=GENRAL&mtype=N&DR=Y"; 
 

$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$reg[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007590985028115916";

//include "regemail.php";

//get_data($url);


$api_key = '561D6D54DB7A77';
$contacts = $reg[mobile];
$template_id = '1007590985028115916';
$from = 'DAKNPY';
$sms_text = urlencode("$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T&C https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.");

//Submit to server

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://msg.klientbox.com/app/smsapi/index.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=9&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id);
$response = curl_exec($ch);
curl_close($ch);

$insid = $db->lastInsertId();				
$result = $insid;
}else{ $result = "Error";}		



echo json_encode($result);


?>