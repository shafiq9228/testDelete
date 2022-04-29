<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

extract($_GET);
require 'phpmailler/PHPMailerAutoload.php';

require('razorpay-php/Razorpay.php');
session_start();
use Razorpay\Api\Api;
$api = new Api('rzp_live_aVjyVBEPSCkf4I', 'a4Nz5PlBmYilpsYya7kaSDD9');
$orderData = [
    'receipt'         => $userid,
    'amount'          => $amount * 100,
    'currency'        => 'INR',
    'payment_capture' => 1
];
$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];


$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ")->fetch();



$day = date('d',strtotime($date));
$mon = date('m',strtotime($date));
$year = date('Y',strtotime($date));       
        
      			 	 	
$orderid = $day.$mon.$year;

  $bth = $db->query("SELECT * FROM transactions where status = 'Credit' ");
  $count = $bth->rowCount();
  //echo $count; exit;
  if($count > 0) {
    $sth = $db->query("SELECT MAX(guid) FROM transactions where status = 'Credit' ");
    $row = $sth->fetch();
    $dt=$row[0];
    $qry = $db->query("SELECT transid FROM transactions WHERE guid='$dt' and status = 'Credit' ");
    $rest = $qry->fetch();
        
    $d=substr($rest[0],13);
        $icc = $d+1;
    $val= $orderid."DPC00".$icc; 
    } else {
       $val= $orderid.'DPC001';
     }  
     
     
$postad = $db->query("INSERT INTO transactions (`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`payment_id`,`status_message`,`razorpay_order_id`) VALUES ('Bill Payment','$reg[pincode]','$val','$userid','0','Dakshinpay','$reg[name]','$reg[mobile]','$amount','Payment request sent to razorpay','Pending','$date','$datetime','$payment_id','Pending','$razorpayOrderId')");
		
	
if($postad) {

$insid = $db->lastInsertId();				


$result = $insid;
    
  $result =  array(
                    'status' => true,
                    'message' =>'Payment initiated',
                    'txnid' => $insid,
                    'order_id' => $razorpayOrderId
                    );
                    
}else{ 
    
     $result =  array(
                    'status' => false,
                    'message' => 'Please try again'
                    ); 
    
}


echo json_encode($result);


?>