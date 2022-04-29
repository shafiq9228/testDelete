<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_GET);
extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

require 'phpmailler/PHPMailerAutoload.php';

$u = $db->query("SELECT * FROM `upi_payments`  where guid = '".$_GET['transaction']."' ")->fetch();


$reg = $db->query("SELECT * FROM `register`  where guid = '".$userid."' ")->fetch();

//$ser = $db->query("SELECT * FROM `services`  where guid = '".$u['serviceid']."' ")->fetch();



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
 /* end of spent */
$set = $db->query ("SELECT * FROM `settings` where guid = '1' ")->fetch();

$total = $amount+$set['charges'];

if($creditbalance >= $total){
    
if($message ==''){ $message = 'Payment to '.$total.' '; }

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.zuelpay.com/finance/upi/transaction',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
 
"request": {
"vpa": "'.$u[upi].'",
"account_name": "'.$u[name].'", 
"agent_id": "'.$u[agentid].'",
"amount": "'.$amount.'",
"email": "'.$reg[email].'",
"mobile": "'.$reg[mobile].'",
"remark": "'.$message.'"
}
}',
  CURLOPT_HTTPHEADER => array(
    'Token: ZKEY2b638d4a4b38a8b171e359e93',
    'Accept: application/json',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);


$arr = json_decode($response, true);

//echo $response;

if($arr['status'] == 'success'){

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

$sql = $db->query("UPDATE upi_payments SET transid = '" . $val . "' ,status = 'Debit',message = '".$arr['message']."',bank_ref ='".$arr['bank_ref']."' ,txstatus_desc = '".$arr['txstatus_desc']."',balance='".$arr['balance']."',charge = '".$arr['charge']."',charged_amount = '".$arr['charged_amount']."' , total = '".$total."',remarks = '$remarks',amount =  '$amount',charges = '".$set['charges']."',order_id = '".$arr['order_id']."',tlid =  '".$arr['tlid']."',paymentresponse =  '$response'  WHERE  guid = '".$transaction."' ");


if($arr['message'] =='Transaction Processing'){ 
    $status_message = 'Failed';
}else if($arr['message'] =='Transaction Successful'){
   
   $status_message = 'Success'; 
}else{ $status_message = 'Pending'; }

$postad = $db->query("INSERT INTO transactions (`fkey`,`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`logo`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`bill_status`,`sound_notification`,`service`,`provider`,`number`,`client_id`,`provider_id`,`upi`,`orderid`,`status_message`) VALUES ('$u[guid]','General','$reg[pincode]','$val','$userid','0','$u[name]','icon_upi4.png','$reg[name]','$reg[mobile]','$total','".$arr['message']."','Debit','$date','$datetime','0','0','UPI Payment','UPI Payment','$u[mobile]','".$arr['tlid']."','0','$u[upi]','".$arr['order_id']."','$status_message')");
		

$insid = $db->lastInsertId();


$result =  $transaction;

}else if($arr['status'] == 'failure'){

  
$sql = $db->query("UPDATE upi_payments SET status = 'Failed',message = '".$arr['message']."',bank_ref ='".$arr['bank_ref']."' ,txstatus_desc = '".$arr['txstatus_desc']."',balance='".$arr['balance']."',charge = '".$arr['charge']."',charged_amount = '".$arr['charged_amount']."', total = '".$total."',order_id = '".$arr['order_id']."',tlid =  '".$arr['tlid']."',paymentresponse =  '$response'  WHERE  guid = '".$transaction."' ");



$result =  $arr;
  
}else{
 $result = $arr;   
}
}else{ $result = "debit"; }
}else if($reg['approval_status'] == 'Approved' && $reg['account']=='Blocked'){

$result = "Blocked";
}else{  $result = "Inactive"; }
echo json_encode($result);

?>