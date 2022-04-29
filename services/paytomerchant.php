<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

extract($_GET);

require 'phpmailler/PHPMailerAutoload.php';

$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ")->fetch();

if($reg['approval_status'] == 'Approved' && $reg['account']=='Active'){
    

$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit' ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback'  ")->fetch();

$tcr = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit'  ")->fetch();

$m = $db->query("SELECT * FROM `merchants`  where guid = '".$_GET['merchant']."' ")->fetch();

$int = $db->query ("SELECT sum(interest) FROM `interest` where status = 'Paid' and userid = '".$userid."' ")->fetch();


$credit = ($reg['credit']+$tc[0]+$tcr[0])-$tb[0]-$int[0];

$balance = ($reg['credit']+$tc[0])-$tb[0]-$amount;

if($credit >= $amount){

$day = date('d',strtotime($date));
$mon = date('m',strtotime($date));
$year = date('Y',strtotime($date));       
        
      			 	 	
$orderid= $day.$mon.$year;

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
     
     
$postad = $db->query("INSERT INTO transactions (`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`logo`,`paidby`,`mobile`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`bill_status`,`sound_notification`) VALUES ('General','$reg[pincode]','$val','$userid','$merchant','".$m['outlet']."','".$m['logo']."','$reg[name]','".$m['mobile']."','$reg[mobile]','$amount','$message','Debit','$date','$datetime','0','0')");
		
	
if($postad) {

$insid = $db->lastInsertId();				


include "cust_trans_notification.php";
include "mer_trans_notification.php";


$result =  $insid;

}else{ $result = "Error";}
}else{ $result = "debit"; }
}else if($reg['approval_status'] == 'Approved' && $reg['account']=='Blocked'){

$result = "Blocked";
}else if($reg['approval_status'] == 'Hold' && $reg['account']=='Active'){

$result = "Hold";
}else{  $result = "Inactive"; }
echo json_encode($result);


?>