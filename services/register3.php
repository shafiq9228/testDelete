<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

date_default_timezone_set('Asia/Kolkata');
require "config.php";

extract($_GET);

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
$date = date('Y-m-d');
$user_id = 'DP'; //example from session variable
$cur_date = date('dmyHi'); //timestamp ticket submitted
$reg_num = '#'.$user_id.'-'. $cur_date;      
      
      
$data = $db->query("SELECT * FROM register WHERE   guid = '".$tempuserid."'    ");

if($info = $data->fetch()) {
    
$data1 = $db->query("UPDATE register SET reg_num = '$reg_num',relationship1 ='".$_GET['relationship1']."' ,ref_mobile1 = '".$_GET['ref_mobile1']."',ref_name1='".$_GET['ref_name1']."', relationship2 = '".$_GET['relationship2']."',ref_mobile2 = '".$_GET['ref_mobile2']."',ref_name2 = '".$_GET['ref_name2']."',status = 'Approved' WHERE guid = '".$info['guid']."'");

include "regemail.php";
 
$message="Dear Customer - Thank you for your registering in Dakshinpay . Your application is under processing , You will be informed  once your account is activated";
$sms=str_replace(" ","%20","$message"); 


$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$info[mobile]&text=$sms&coding=0&pe_id=1001724022979357639";

get_data($url);

$response = $info['guid'];

}else {
//	echo "Error";
 $response= "Error";         
}

 echo json_encode( $response);


?>