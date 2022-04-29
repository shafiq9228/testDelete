<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

extract($_GET);
require 'phpmailler/PHPMailerAutoload.php';




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
     
     
$postad = $db->query("INSERT INTO transactions (`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`payment_id`,`status_message`) VALUES ('Bill Payment','$reg[pincode]','$val','$userid','0','Dakshinpay','$reg[name]','$reg[mobile]','$amount','Payment request sent to razorpay','Pending','$date','$datetime','$payment_id','Pending')");
		
	
if($postad) {

$insid = $db->lastInsertId();				


$result = $insid;
    
    
}else{ $result = "Error";}


echo json_encode($result);


?>