<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d h:i:s');
include_once 'config.php';

$p = $db->query("SELECT * FROM `products` WHERE guid='" . $product . "'")->fetch();


if(!empty($product)  && !empty($userid) ){
		     
		     
$chk = $db->query("SELECT * FROM `cart` WHERE product ='" . $product . "' and refid = '" . $userid . "'  ")->fetch();	 
			  

	if($chk['guid']=='' && $quantity > 0){	 
		 
	  

	
	 $resource = $db->query("INSERT INTO `cart`(`refid`, `product`,`charges`,`price` ,`quantity`,`total`,`date`) VALUES ('" . $userid . "','" . $product . "','" . $p[charges] . "','" . $p[price] . "','$quantity','" .$quantity * $p[price] . "','$date')");
          
          $response = "Success";
	
	}else if($chk['guid']!='' && $quantity > 0){
	    
		    $amount=$p[price]*$quantity;
		    
			$resource = $db->query("UPDATE cart SET quantity = '" . $quantity . "' , total='" . $amount . "' WHERE guid= '".$chk['guid']."'"); 
			 
		 $response = "Success";	 
		 }else{
		     
			$d = $db->query ("DELETE FROM `cart` WHERE `guid`= '".$chk['guid']."'");
     $response = "Success";
		 }
		 
		 }else{
		  
		  $response = "Please login to continue";   
		 }
		 
echo json_encode($response);exit;
