<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
date_default_timezone_set('Asia/Kolkata'); 

require "config.php";
extract($_POST);
$date = date('Y-m-d');
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

$app = $db->query("SELECT * FROM `register` WHERE mobile = '".$username."' ")->fetch();

if($app['guid']!=''){
    
if($app['mobile_status'] =='Verified' && $app['status'] =='Approved' && $app['approval_status'] =='Approved'){
    
//$result = 'Approveddelli'.$app['guid'];
$otp = rand(1000,9999);

$data = $db->query("UPDATE register SET otp ='".$otp."' WHERE guid = '".$app['guid']."' and mobile = '".$username."' ");

$message = "$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T%26C https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.";

//$message="$otp is your DAKSHINPAY LOGIN OTP. By confirming OTP, you agree to DAKSHINPAY's T and C https://www.dakshinpay.com/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DAKSHINPAY NEVER CALLS TO VERIFY OTP";
$sms=str_replace(" ","%20","$message"); 

 //$url = "https://api.smscountry.com/SMSCwebservice_bulk.aspx?User=catchway&passwd=2020@catchway&mobilenumber=$_GET[mobile]&message=$sms&sid=GENRAL&mtype=N&DR=Y"; 
 
 

//$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$username&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007590985028115916";


//get_data($url);


$api_key = '561D6D54DB7A77';
$contacts = $username;
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

    
$result = $app['guid']."delli".$otp;


}else if($app['mobile_status'] =='Verified' && $app['status'] =='Approved' && $app['approval_status'] =='Pending'){

$result = 'Approval Pending';    
}else if($app['mobile_status'] =='Verified' && $app['status'] =='Approved' && $app['approval_status'] =='Rejected'){

$result = 'Rejected';   
}else if($app['mobile_status'] =='Verified' && $app['status'] =='Pending' && $app['approval_status'] =='Pending'){

$result = 'Verifieddelli'.$app['guid'];    

}else if($app['mobile_status'] =='Pending' && $app['status'] =='Pending' && $app['approval_status'] =='Pending'){

$otp = rand(1000,9999);


$data = $db->query("UPDATE register SET otp ='".$otp."' WHERE guid = '".$app['guid']."' and mobile = '".$username."' ");


$message = "$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T%26C https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.";
$sms=str_replace(" ","%20","$message"); 


$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$username&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007590985028115916";
//include "regemail.php";

//get_data($url);


$api_key = '561D6D54DB7A77';
$contacts = $username;
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


$result = $app['guid']."delli".$otp;


}
}else{
 
$otp = rand(1000,9999);



$postad = $db->query("INSERT INTO register (`entryby`,`mobile`,`otp`,`date`,`deviceid`,`regid`,`status`,`mobile_status`,`approval_status`,`account`,`credit`) VALUES ('Customer','$username','$otp','$date','$deviceid','$regid','Pending','Pending','Pending','Active','0')");

if($postad) {
	
$message = "$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T%26C  https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.";
$sms=str_replace(" ","%20","$message"); 


$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$username&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007590985028115916";


//get_data($url);

$api_key = '561D6D54DB7A77';
$contacts = $username;
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
$result = $insid."delli".$otp;

}else{ $result = "Error";}	
    


}

echo json_encode($result);

//echo "0";exit;
?>