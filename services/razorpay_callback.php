<?php include_once 'config.php';
date_default_timezone_set('Asia/Kolkata'); 

$date = date('Y-m-d');

$post = file_get_contents('php://input');


/*$result = '{"entity":"event",
             "account_id":"acc_G2wS1M6ka4EqiE",
             "event":"payment.failed",
             "contains":["payment"],
             "payload":{"payment":{"entity":{"id":"pay_I79mZ4uxDIZ6eC","entity":"payment","amount":32300,"currency":"INR","status":"failed","order_id":null,"invoice_id":null,"international":false,"method":"wallet","amount_refunded":0,"refund_status":null,"captured":false,"description":"Bill Payment","card_id":null,"bank":null,"wallet":"phonepe","vpa":null,"email":"zuberzubb@gmail.com","contact":"+917760424275","notes":[],"fee":null,"tax":null,"error_code":"BAD_REQUEST_ERROR","error_description":"Payment processing cancelled by user","error_source":"customer","error_step":"payment_authentication","error_reason":"payment_cancelled","acquirer_data":{"transaction_id":null},"created_at":1633764792}}},"created_at":1633764884}'; */


$response = json_decode($post, true);


$status =  $response[payload][payment][entity][status];

$paymentid =  $response[payload][payment][entity][id];

//$response=json_encode($_REQUEST);


$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


$resource = $db->query("INSERT  INTO `razorpaycallback`(`response`,`data`,`status`,`payment_id`,`date`) VALUES ('$response','$post','$status','$paymentid','$date')");

if($status == 'authorized' || $status == 'captured'){


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
     
     
$postad = $db->query("UPDATE transactions SET transid = '$val' , status = 'Credit',message = 'Amount settled to dakshinpay',message = 'Success',status_message = 'Success'  WHERE  payment_id = '$paymentid'  ");

}