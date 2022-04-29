<?php ob_start();

ini_set('max_execution_time', -1); 

date_default_timezone_set('Asia/Kolkata');

require "config.php";
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');
require 'phpmailler/PHPMailerAutoload.php';

define( 'API_ACCESS_KEY', 'AAAAVVzX-7Q:APA91bE-TFFSKkJOOhbg9ce3dg6x9TgW8TvxThSwpKvKoB5rH1ZefZhVECaN23gw-eonUIO1hBrmnFr3vINwYOtJh5tVZNPBn4n-Mnu6RkJFd4AU-mdt5A9t2SLlFHgJ20XPPuXqmBSF' );

function get_data($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

$fromdate = date('Y-m').'-01';

$todate = date('Y-m').'-15';


$duedate = date("Y-m-d", strtotime($date . " +2 days"));    

$maxid = $db->query("SELECT  max(guid) FROM register where status = 'Approved' ")->fetch();

for($i=1;$i<=$maxid;$i++){

$row = $db->query("SELECT *  FROM register where  guid = '".$i."' ")->fetch();

//while($row = $sql->fetch()){ 
    
 
$chk = $db->query("SELECT * FROM `bills`  where userid = '".$row['guid']."' and date = '$date' ")->rowCount();

if($chk == 0){
    

$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$row['guid']."' and status = 'Debit' and bill_status = '0' ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$row['guid']."' and status = 'Cashback' and bill_status = '0' ")->fetch();

$total = $tb[0]-$tc[0];

if($total > 0){
    

$postad = $db->query("INSERT INTO bills (`pincode`,`userid`,`custid`,`name`,`email`,`mobile`,`subtotal`,`interest`,`waiveoff`,`total`,`duedate`,`date`,`datetime`,`deviceid`,`regid`,`status`,`fromdate`,`todate`) VALUES ('$row[pincode]','$row[guid]','$row[reg_num]','$row[name]','$row[email]','$row[mobile]','$total','0','0','$total','$duedate','$date','$datetime','$row[deviceid]','$row[regid]','Pending','$fromdate','$todate')");
		
$last_id = $db->lastInsertId();

$sql = $db->query("UPDATE transactions SET bill_status = '1'  where userid = '".$row['guid']."' and status = 'Debit' ");

$cql = $db->query("UPDATE transactions SET bill_status = '1'  where userid = '".$row['guid']."' and status = 'Cashback' ");


$notif = "Dear Customer - Statement of Rs.$total with a due date of duedate ".date('d M Y',strtotime($duedate))." has been generated for your Dakshinpay account  Pay using https://www.dakshinpay.com/services/paymentrequest.php?paymentid=$last_id.   Plz ignore if already paid";


$info =  $db->query ("SELECT * FROM `register` where guid = '".$row['guid']."' ")->fetch();
  



$sms=str_replace(" ","%20","$notif"); 


 

$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$info[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007305393175152386";

//get_data($url);


$api_key = '561D6D54DB7A77';
$contacts = $info[mobile];
$template_id = '1007305393175152386';
$from = 'DAKNPY';
$sms_text = urlencode("Dear Customer - Statement of Rs.$total with a due date of duedate ".date('d M Y',strtotime($duedate))." has been generated for your Dakshinpay account  Pay using https://www.dakshinpay.com/services/paymentrequest.php?paymentid=$last_id.   Plz ignore if already paid");

//Submit to server

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://msg.klientbox.com/app/smsapi/index.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=9&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id);
$response = curl_exec($ch);
curl_close($ch);

//echo "text";exit;
    $singleID = $info['regid']; 
    $fcmMsg = array(
    	'body' =>  $notif,
    	'title' => "Bill Status",
    	'sound' => "default",
        'color' => "#203E78" 
    );
    $fcmFields = array(
    	'to' => $singleID,
        'priority' => 'high',
    	'notification' => $fcmMsg
    );
    $headers = array(
    	'Authorization: key=' . API_ACCESS_KEY,
    	'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    $result = curl_exec($ch );
    //curl_close( $ch );

$postad = $db->query("INSERT INTO customer_notif(`transid`,`userid`,`message`,`date`,`datetime`,`status`) VALUES ('$last_id','".$row['guid']."','$notif','$date','$datetime','1')");

//include "email_bill.php";

include "templates/outstanding.php";
}
}
}

echo "Bills generated";

?>