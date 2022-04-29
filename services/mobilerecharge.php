<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_GET);
extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
require 'phpmailler/PHPMailerAutoload.php';


$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ")->fetch();

$ser = $db->query("SELECT * FROM `services`  where guid = '".$_GET['serviceid']."' ")->fetch();

$pro = $db->query("SELECT * FROM `providers`  where guid = '".$_GET['provider_id']."' ")->fetch();

if($reg['approval_status'] == 'Approved' && $reg['account']=='Active'){
    

$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit'  ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback'  ")->fetch();


$tcr = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit'  ")->fetch();

$int = $db->query ("SELECT sum(interest) FROM `interest` where status = 'Paid' and userid = '".$userid."' ")->fetch();


$credit = ($reg['credit']+$tc[0]+$tcr[0])-$tb[0]-$int[0];

$balance = ($reg['credit']+$tc[0])-$tb[0]-$amount;



/* spent amount */

$b = $db->query ("SELECT sum(total) FROM `bills` where status = 'Pending' and userid = '".$userid."' ")->fetch();


$debt_unbilled = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit' and bill_status = '0'   ")->fetch();

$tc_unbilled = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback' and bill_status = '0' ")->fetch();


$totalspent = $b[0]+$debt_unbilled[0];

$creditbalance = $reg['credit']+$tc_unbilled[0]-$totalspent;


if($creditbalance >= $amount){
    
$uniqueid = rand(1000,9999);
    
    
//this will collect data from form
$provider_id = $_GET['provider_id']; 
$number = $_GET['number'];
$amount = $_GET['amount'];
$client_id = $uniqueid; //(your system unique id. that you can check in pay2all);
//end of data collection from form


 
if($validity !=null || $validity !=''){     
$expirydate =  date("Y-m-d", strtotime($date . $validity));    
}else{ $expirydate = null; $validity = 0; }

//echo "INSERT INTO recharges (`pincode`,`userid`,`customerno`,`amount`,`status`,`date`,`datetime`,`service`,`provider_name`,`provider_id`,`number`,`client_id`,`expiry_date`,`validity`) VALUES ('$reg[pincode]','$userid','$reg[mobile]','$amount','Pending','$date','$datetime','$ser[service_name]','$pro[provider_name]','$provider_id','$number','$client_id','$expirydate','$validity')";exit;
$sql = $db->query("INSERT INTO recharges (`pincode`,`userid`,`customerno`,`amount`,`status`,`date`,`datetime`,`service`,`provider_name`,`provider_id`,`number`,`client_id`,`expiry_date`,`validity`) VALUES ('$reg[pincode]','$userid','$reg[mobile]','$amount','Pending','$date','$datetime','$ser[service_name]','$pro[provider_name]','$provider_id','$number','$client_id','$expirydate','$validity')");
     
$rech_id = $db->lastInsertId();				
    
$postad = $db->query("INSERT INTO transactions (`type`,`fkey`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`logo`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`bill_status`,`sound_notification`,`service`,`provider`,`number`,`client_id`,`provider_id`,`validity`,`status_message`) VALUES ('Services','$rech_id','$reg[pincode]','$val','$userid','0','$pro[provider_name]','$pro[icon]','$reg[name]','$reg[mobile]','$amount','success','Pending','$date','$datetime','0','0','$ser[service_name]','$pro[provider_name]','$number','$client_id','$provider_id','$validity','Pending')");
		

$insid = $db->lastInsertId();				
		
		
		
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.pay2all.in/v1/payment/recharge',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'number='.$number.'&amount='.$amount.'&provider_id='.$provider_id.'&client_id='.$client_id,
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJmYWM5OTA4YzgxMDk1ZDQ1NzkxYTZkYmZiMTQxYTVlZGI2NzQwZDRiNGI2MWVmNTNhZWEwMzE0ZDI1NjhhM2M4NTcxN2Y5MGMyMmU5ZmE2In0.eyJhdWQiOiIxIiwianRpIjoiMmZhYzk5MDhjODEwOTVkNDU3OTFhNmRiZmIxNDFhNWVkYjY3NDBkNGI0YjYxZWY1M2FlYTAzMTRkMjU2OGEzYzg1NzE3ZjkwYzIyZTlmYTYiLCJpYXQiOjE2MTY2Njg3NjcsIm5iZiI6MTYxNjY2ODc2NywiZXhwIjoxNjQ4MjA0NzY3LCJzdWIiOiI0MzAiLCJzY29wZXMiOltdfQ.fZrhPWm4px5LZuhzKf5CUBJXzO0WLiVt-BiExkPfFgGmwvYYIs385HBBj2Yrn_L4TcNpjb11MoZsa51g9zi6Ta2zOu1wDGbMDW-Lk8fHBUj_EkpH_lGNJ0-IdzlnoDd7pyV7SBb_SmTP_EzY1hjhSk72nf1LXKmhygaPDhdmKEIQr5D7SedGDOkHrlyug7LaGU67N1UegeEOz5arrzXzuRsZM0b6qogzP0fwR0Dof8oD4Mx1OO44p1_0N2cKFLYJcKp1DHRiZcwMkXLEPDvVLKH_lB0CNPhxJ9q2qrV9VkPcTkfXn8Vq4whDshBqQR9QXZQ0OZ6ahjo0dDqB8uk0HNBhJGUdpuEhjdafnHeMO_UY7MxGwjmaFdkS6iu4jH_2ThlSJr77kZHGpXXcfWfKoO9GIFIWQKgVLpIPZlty1oN4tjkrpVlUmcKr61FDEzrbu_7sOzhxB-QrD9zCWMSogXS5rLhLAQiVWc_z6lSpKNSIOZUi-SIXxLFiq3Cr6hv_SCffwZf9kPN1uCXTdm6jr3FSRMzBMsUxysz_f5aPa0XEeM8TR5JzCLGCI5SqeyraWxs8cCaiKkRQ_E0BRSeX63awuGChInRCyVVy6K0h4CnT1UuUcSZk2yD5P9HjrUB237X0LkfzwCsM8nTRkKyl3jHCL6-HcIun9-36TeYYFcI',
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$arr = json_decode($response, true);

//print_r($arr);


$status_id = $arr['status_id']; 

//echo $response;
//echo "status:".$status;

if($status_id == '0' || $status_id == '1'){
    
$day = date('d',strtotime($date));
$mon = date('m',strtotime($date));
$year = date('Y',strtotime($date));       
        
      			 	 	
$orderid = $day.$mon.$year;

  $bth = $db->query("SELECT * FROM transactions where status = 'Debit' ");
  $count = $bth->rowCount();
  //echo $count; exit;
  if($count > 0) {
    $sth = $db->query("SELECT MAX(guid) FROM transactions where status = 'Debit' ");
    $row = $sth->fetch();
    $dt=$row[0];
    $qry = $db->query("SELECT transid FROM transactions WHERE guid='$dt' and status = 'Debit' ");
    $rest = $qry->fetch();
        
    $d=substr($rest[0],13);
        $icc = $d+1;
    $val= $orderid."DPD00".$icc; 
    } else {
       $val= $orderid.'DPD001';
     }  
 

$sql = $db->query("UPDATE recharges SET transid = '" . $val . "',message = '".$arr['message']."' ,status = 'Debit',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."',response = '$arr'  WHERE  guid = '".$rech_id."' ");


$postad = $db->query("UPDATE transactions SET transid = '" . $val . "',message = '".$arr['message']."',status = 'Debit',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."',status_message = 'Success'  WHERE  guid = '".$insid."' ");


//$sql = $db->query("INSERT INTO recharges (`pincode`,`transid`,`userid`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`service`,`provider_name`,`provider_id`,`utr`,`reportid`,`orderid`,`status_id`,`number`,`client_id`,`expiry_date`,`validity`) VALUES ('$reg[pincode]','$val','$userid','$reg[mobile]','$amount','".$arr['message']."','Debit','$date','$datetime','$ser[service_name]','$pro[provider_name]','$provider_id','".$arr['utr']."','".$arr['reportid']."','".$arr['orderid']."','".$arr['status_id']."','$number','$client_id','$expirydate','$validity')");
     
     
//$postad = $db->query("INSERT INTO transactions (`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`logo`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`bill_status`,`sound_notification`,`service`,`provider`,`utr`,`reportid`,`orderid`,`status_id`,`number`,`client_id`,`provider_id`,`validity`) VALUES ('Services','$reg[pincode]','$val','$userid','0','$pro[provider_name]','$pro[icon]','$reg[name]','$reg[mobile]','$amount','success','Debit','$date','$datetime','0','0','$ser[service_name]','$pro[provider_name]','".$arr['utr']."','".$arr['reportid']."','".$arr['orderid']."','".$arr['status_id']."','$number','$client_id','$provider_id','$validity')");
		
		
				
	
if($postad) {

//$insid = $db->lastInsertId();				


include "service_trans_notification.php";
//include "mer_trans_notification.php";


$result =  $insid;
}
}else if($status_id == '2'){  //Failure

$sql = $db->query("UPDATE recharges SET message = '".$arr['message']."' ,status = 'Failed',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."',response = '$response'  WHERE  guid = '".$rech_id."' ");


$postad = $db->query("UPDATE transactions SET message = '".$arr['message']."',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."',status_message = 'Failed',status = 'Failed'  WHERE  guid = '".$insid."' "); 

}else if($status_id == '3'){ //processing or pending

$sql = $db->query("UPDATE recharges SET transid = '" . $val . "',message = '".$arr['message']."' ,status = 'Debit',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."',response = '$response'  WHERE  guid = '".$rech_id."' ");


$postad = $db->query("UPDATE transactions SET transid = '" . $val . "',message = '".$arr['message']."',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."',status_message = 'Processing',status = 'Debit'  WHERE  guid = '".$insid."' "); 

}else{ 
    
$sql = $db->query("UPDATE recharges SET message = '".$arr['message']."' ,status = 'Failure',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."',response = '$response'  WHERE  guid = '".$rech_id."' ");


$postad = $db->query("UPDATE transactions SET message = '".$arr['message']."',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."',status_message = 'Failed',status = 'Failed'  WHERE  guid = '".$insid."' "); 
   
if($arr['message']!=''){    
$result = $arr['message'];
}else{
   $result = 'Check Wallet';
}  
    
}
}else{ $result = "debit"; }
}else if($reg['approval_status'] == 'Approved' && $reg['account']=='Blocked'){

$result = "Blocked";
}else if($reg['approval_status'] == 'Hold'){

$result = "Hold";
}else{  $result = "Inactive"; }
echo json_encode($result);

?>