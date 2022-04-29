<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
date_default_timezone_set('Asia/Kolkata');
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$user_id = 'DP'; //example from session variable
$cur_date = date('dmyHi'); //timestamp ticket submitted
$reg_num = '#'.$user_id.'-'. $cur_date;


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

$m = $db->query("SELECT * FROM register WHERE  mobile='".$_GET['mobile']."' and status = 'Approved' ")->rowCount();
$e = $db->query("SELECT * FROM register WHERE  email='".$_GET['email']."' and status = 'Approved'  ")->rowCount();
   	
	if($m != 0){
	    
	    $result = "mobileError";
	}else if($e !=0){
	    
	 $result = "emailError";
	}else{
	
$otp = rand(1000,9999);

$postad = $db->query("INSERT INTO register (`reg_num`,`name`,`email`,`mobile`,`otp`,`password`,`date`,`deviceid`,`regid`,`status`,`mobile_status`,`approval_status`,`gender`,`dob`) VALUES ('$reg_num','$_GET[name]','$_GET[email]','$_GET[mobile]','$otp','$_GET[password]','$date','$_GET[deviceid]','$_GET[regid]','Pending','Pending','Pending','$_GET[gender]','$_GET[dob]')");
		
if($postad) {
	
 
 
 $message = "$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T%26C  https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.";
$sms=str_replace(" ","%20","$message"); 


$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$_GET[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007590985028115916";
//include "regemail.php";

get_data($url);

$insid = $db->lastInsertId();				
$result = $insid."delli".$otp;
}else{ $result = "Error";}		


}


echo json_encode($result);


?>