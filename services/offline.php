<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


         $orderid=$_GET['orderid'];
		 $payment=$_GET['payment'];
		 $user_id=$_GET['user_id'];
	
		 
if(!empty($orderid) && !empty($payment) && !empty($user_id) ){
		     
	     
$data = $db->query("UPDATE `orders` SET `status`='Order Placed',`paymentmethod`='".$payment."',timeslot = '$timeslot' WHERE `guid`='".$orderid."' and `userid`='".$user_id."'");


if($data) { 
		 
    $cart = $db->query("UPDATE order_items SET status = 'Order Placed',order_status='Order Placed',timeslot = '$timeslot' WHERE   userid= '".$user_id."' and od_id = '".$_GET['orderid']."' "); 
		  
       
$sth = $db->query ("DELETE FROM `cart` WHERE `refid`= '".$user_id."' ");
	
		 }else{
		  
		  $response = "Error";   
		 }}else{
		  
		  $response = "Error";   
		 }
		 
echo json_encode($response);exit;
