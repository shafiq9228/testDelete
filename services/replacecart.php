<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


         $pid=$_GET['pid'];
		 $rest_id=$_GET['restaurant'];
		 $user_id=$_GET['user_id'];
	
$data = $db->query("DELETE FROM cart WHERE  loginid = '$user_id'  and orderstatus = 'notplaced' ");

$rname = $db->query("SELECT * FROM `restaurents` WHERE guid='" . $rest_id . "'")->fetch();
	
if(!empty($pid) && !empty($rest_id) && !empty($user_id) ){
		     
		     
$chk = $db->query("SELECT * FROM `cart` WHERE pid='" . $pid . "' and loginid = '" . $user_id . "' and  resid = '" . $rest_id . "' and orderstatus = 'notplaced' ")->fetch();	 
			  
$resource12 = $db->query("SELECT * FROM `products` WHERE guid='" . $pid . "'")->fetch();

	if($chk['guid']==''){	 
		 
	$item_chk = $db->query("SELECT * FROM `cart` WHERE  loginid = '" . $user_id . "' and orderstatus = 'notplaced' ")->rowCount();
	
	$res_chk = $db->query("SELECT * FROM `cart` WHERE  loginid = '" . $user_id . "' and  resid = '" . $rest_id . "' and orderstatus = 'notplaced' ")->rowCount();		  
	if($item_chk == 0){
	
	 $resource = $db->query("INSERT INTO `cart`(`loginid`, `pid` ,`price` ,`qty`,`amount`,`orderstatus`,`resid`,`restaurant`,`cityid`,`locationid`) VALUES ('" . $user_id . "','" . $pid . "','" . $resource12[price] . "','1','" . $resource12[price] . "','notplaced','$rest_id','".$rname['rname']."','".$rname['cityid']."','".$rname['locationid']."')");
          
          $response = "Success";
	
	}else if($res_chk > 0){
		  
          $resource = $db->query("INSERT INTO `cart`(`loginid`, `pid` ,`price` ,`qty`,`amount`,`orderstatus`,`resid`,`restaurant`,`cityid`,`locationid`) VALUES ('" . $user_id . "','" . $pid . "','" . $resource12[price] . "','1','" . $resource12[price] . "','notplaced','$rest_id','".$rname['rname']."','".$rname['cityid']."','".$rname['locationid']."')");
          
          $response = "Success";
	}else{
          
          $response =  "res_error";
          
		 }
		 
	    
	    
	}else{
			
			 $amount=$resource12[price]*$qty;
			 
             $resource = $db->query("UPDATE cart SET qty = '" . $qty . "' , amount='" . $amount . "' WHERE guid= '".$chk['guid']."'"); 
			 
		 $response = "Success";	 
		 }
		 
		 }else{
		  
		  $response = "Error";   
		 }
		 
echo json_encode($response);exit;
