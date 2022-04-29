<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
date_default_timezone_set('Asia/Kolkata'); 

require "config.php";
extract($_POST);
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');

$data = file_get_contents("php://input");





    if (isset($data)) {

        $request = json_decode($data);

        $username = $request->username;
$deviceid = $request->deviceid;
$regid = $request->regid;

                }
       
       
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



$app = $db->query("SELECT * FROM `register` WHERE mobile = '".$username."'  ")->fetch();

if($app['guid']!=''){
  
if($app['mobile']!='8500303062'){ 
    
$otp = rand(1000,9999);


$data = $db->query("UPDATE register SET otp ='".$otp."',regid = '".$regid."' WHERE guid = '".$app['guid']."' and mobile = '".$username."' ");


$message = "$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T%26C https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.";
$sms=str_replace(" ","%20","$message"); 


$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$username&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007590985028115916";



get_data($url);




$result = $app['guid']."delli".$otp;

}else{
    
$data = $db->query("UPDATE register SET regid = '".$regid."' WHERE guid = '".$app['guid']."' and mobile = '".$username."' ");

$result = $app['guid']."delli".$app['otp'];


}

}else{
 
$otp = rand(1000,9999);



$postad = $db->query("INSERT INTO register (`entryby`,`mobile`,`otp`,`date`,`datetime`,`deviceid`,`regid`,`status`,`mobile_status`,`approval_status`,`account`,`credit`,`aadhar_status`,`pan_status`) VALUES ('Customer','$username','$otp','$date','$datetime','$deviceid','$regid','Pending','Pending','Pending','Active','0','Pending','Pending')");

if($postad) {
	
$message = "$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T%26C  https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.";
$sms=str_replace(" ","%20","$message"); 


$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$username&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007590985028115916";


get_data($url);

$insid = $db->lastInsertId();				
$result = $insid."delli".$otp;

}else{ $result = "Error";}	
    


}


echo json_encode($result);

//echo "0";exit;
?>