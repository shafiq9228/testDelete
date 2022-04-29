<?php include_once 'config.php';
date_default_timezone_set('Asia/Kolkata'); 

$payid=$_REQUEST['payid'];
$opr_ref=$_REQUEST['opr_ref'];

$tlid=$_REQUEST['tlid'];

$agent_id=$_REQUEST['agent_id'];

$status=$_REQUEST['status'];


$txn_mode=$_REQUEST['txn_mode'];


$response=json_encode($_REQUEST);




$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


$resource = $db->query("INSERT IGNORE INTO `callback`(`payid`,`opr_ref`,`tlid`, `agent_id`,`status`,`txn_mode`,`res`) VALUES ('$payid', '$opr_ref', '$tlid','$agent_id','$status','$txn_mode','$response' )");



if($status == 'success'){

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

$sql = $db->query("UPDATE upi_payments SET transid = '" . $val . "' ,status = 'Debit',bank_ref ='".$payid."',paymentresponse = '$response',tlid =  '".$tlid."' ,txstatus_desc = 'Success'  WHERE  agentid = '".$agent_id."' ");

$u = $db->query("SELECT * FROM `upi_payments`  where agentid = '".$agent_id."' ")->fetch();


$reg = $db->query("SELECT * FROM `register`  where guid = '".$u['userid']."' ")->fetch();



$postad = $db->query("INSERT INTO transactions (`fkey`,`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`logo`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`bill_status`,`sound_notification`,`service`,`provider`,`number`,`client_id`,`provider_id`,`validity`,`upi`,`orderid`,`status_message`) VALUES ('$u[guid]','General','$reg[pincode]','$val','".$u['userid']."','0','".$u['name']."','$pro[icon]','$reg[name]','$reg[mobile]','$u[amount]','UPI Payment','Debit','$date','$datetime','0','0','UPI Payment','UPI Payment','$u[mobile]','$u[agentid]','0','$validity','$u[upi]','".$arr['order_id']."','Success')");

}else{
    
 $sql = $db->query("UPDATE upi_payments SET status = 'Failure',paymentresponse = '$response' ,tlid =  '".$tlid."',message = 'Failed' ,txstatus_desc = 'Failed' WHERE  agentid = '".$agent_id."' ");
   
 $tsql = $db->query("UPDATE transactions SET status = 'Failed',status_message = 'Failed'  WHERE  client_id = '".$agent_id."' ");

}