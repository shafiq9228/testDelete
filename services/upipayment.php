<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_GET);
extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


function random19() {
  $number = "";
  for($i=0; $i<19; $i++) {
    $min = ($i == 0) ? 1:0;
    $number .= mt_rand($min,9);
  }
  return $number;
}

$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ")->fetch();

$ser = $db->query("SELECT * FROM `services`  where guid = '".$_GET['serviceid']."' ")->fetch();

$pro = $db->query("SELECT * FROM `providers`  where guid = '".$_GET['provider_id']."' ")->fetch();

if($reg['approval_status'] == 'Approved' && $reg['account']=='Active'){
    
$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit'   ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback'  ")->fetch();

$tcr = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit'  ")->fetch();


$credit = ($reg['credit']+$tc[0]+$tcr[0])-$tb[0];

$balance = ($reg['credit']+$tc[0])-$tb[0]-$amount;

$set = $db->query ("SELECT * FROM `settings` where guid = '1' ")->fetch();

$total = $u[amount]+$set['charges'];

if($credit >= $total){
    
$uniqueid = rand(1000,9999);
    
    
//this will collect data from form
$upi = $_GET['upi']; 
$name = $_GET['accountname'];
$number = $_GET['mobile'];
$amount = $_GET['amount'];
$email = $_GET['email'];
$remarks = $_GET['remarks'];

$agentid = "DPY".random19(); //(your system unique id. that you can check in Zuel pay);
//end of data collection from form

if($validity){     
$expirydate =  date("Y-m-d", strtotime($date . $validity));    
}else{ $expirydate = '0000-00-00'; }



$sql = $db->query("INSERT INTO upi_payments (`pincode`,`userid`,`upi`,`name`,`email`,`mobile`,`amount`,`charges`,`total`,`remarks`,`status`,`date`,`datetime`,`agentid`) VALUES ('$reg[pincode]','$userid','$upi','$name','$email','$mobile','$amount','$set[charges]','$total','$remarks','Pending','$date','$datetime','$agentid')");
     
$rech_id = $db->lastInsertId();				
    


//$insid = $db->lastInsertId();





$result =  $rech_id;

}else{ $result = "debit"; }
}else if($reg['approval_status'] == 'Approved' && $reg['account']=='Blocked'){

$result = "Blocked";
}else{  $result = "Inactive"; }
echo json_encode($result);

?>