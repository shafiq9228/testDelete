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

function get_blockdata($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function dateDifference($start_date, $end_date){
    // calulating the difference in timestamps 
    $diff = strtotime($start_date) - strtotime($end_date);
     
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds
    return ceil(abs($diff / 86400));
}

$maxid = $db->query("SELECT  max(guid) FROM bills where status = 'Pending' and date_add(date,interval 2 day) < '$date' ")->fetch();

for($i=1;$i<=$maxid;$i++){

//echo "SELECT *  FROM bills where status = 'Pending' and date_add(date,interval 3 day) < '$date' and guid = '".$i."' ";exit;
$row = $db->query("SELECT *  FROM bills where status = 'Pending' and date_add(date,interval 2 day) < '$date' and guid = '".$i."' ")->fetch();

//$sql = $db->query("SELECT *  FROM bills where status = 'Pending' and date_add(date,interval 3 day) < '$date' order by guid asc");
//while($row = $sql->fetch()){ 
    
$after3days =  date("Y-m-d", strtotime($row['date'] . " +3 days"));    
//$after3days = strtotime(date("Y-m-d", strtotime($row['date'])) . " +3 days");    
$tb = $db->query("SELECT sum(total),sum(waiveoff) FROM bills where status = 'Pending' and guid =  '".$row['guid']."' ")->fetch();


$int = $db->query ("SELECT sum(interest) FROM `interest` where status = 'Pending' and bill = '".$row['guid']."' ")->fetch();

$reg = $db->query("SELECT * FROM register where guid =  '".$row['userid']."' ")->fetch();

$info = $db->query("SELECT * FROM register where guid =  '".$row['userid']."' ")->fetch();


$chk = $db->query("SELECT * FROM interest where  bill =  '".$row['guid']."' and date = '$date' ")->fetch();

if($chk == 0){

/*if($tb[0] <= 500){
    $interest = 10;
}elseif($tb[0] > 500 && $tb[0] <= 2500){
    $interest = 20;
}elseif($tb[0] > 2500 && $tb[0] <= 5000){
     $interest = 30;
}elseif($tb[0] > 5000 && $tb[0] <= 10000){
     $interest = 40;
} elseif($tb[0] > 10000 && $tb[0] <= 25000){
     $interest = 50;
}     */


if($tb[0] <= 1000){
    
    $baseamount = 10;
    $gst = 1.8;
    
    $interest = 11.8;
    
}elseif($tb[0] > 1000 && $tb[0] <= 5000){
    
    $baseamount = 10;
    $gst = 3.6;
    $interest = 23.6;
}

if($int[0] < 280){
    
$total = $tb[0]+$interest+$int[0]-$tb[1];


    
    
$postad = $db->query("INSERT INTO interest (`userid`,`bill`,`subtotal`,`baseamount`,`gst`,`interest`,`total`,`date`,`datetime`,`status`) VALUES ('$row[userid]','$row[guid]','$tb[0]','$baseamount','$gst','$interest','$total','$date','$datetime','Pending')");


$day = date('d',strtotime($date));
$mon = date('m',strtotime($date));
$year = date('Y',strtotime($date));       
        
      			 	 	
$orderid = $day.$mon.$year;

  $bth = $db->query("SELECT * FROM transactions where status = 'Latefee' ");
  $count = $bth->rowCount();
  //echo $count; exit;
  if($count > 0) {
    $sth = $db->query("SELECT MAX(guid) FROM transactions where status = 'Latefee' ");
    $trow = $sth->fetch();
    $dt=$trow[0];
    $qry = $db->query("SELECT transid FROM transactions WHERE guid='$dt' and status = 'Latefee' ");
    $rest = $qry->fetch();
        
    $d=substr($rest[0],13);
        $icc = $d+1;
    $val= $orderid."DPL00".$icc; 
    } else {
       $val= $orderid.'DPL001';
     }  
     
$postad = $db->query("INSERT INTO transactions (`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`) VALUES ('General','$reg[pincode]','$val','".$row['userid']."','0','Dakshinpay','$row[name]','$row[mobile]','$interest','Late fee','Latefee','$date','$datetime')");




$totalinterest =  $interest+$int[0];

$dateDiff = dateDifference($row['duedate'], $date);

//$message="Your due date was crossed and a late fee of Rs. $interest has been charged to your DAKSHINPAY account. Your total outstanding is now Rs $total.Please make the payment at the earliest using  DakshinPay App - Plz ignore if already paid.";

$message="You are $dateDiff day(s) past your due date and a late fee of Rs. $totalinterest interest has been charged to your DAKSHINPAY account. Your total outstanding is now Rs $total.Please make the payment at the earliest using  DakshinPay App or https://www.dakshinpay.com/services/paymentrequest.php?paymentid=$row[0] - Plz ignore if already paid.";

$sms=str_replace(" ","%20","$message"); 



$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$reg[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007350597826968951";

//get_data($url);

$api_key = '561D6D54DB7A77';
$contacts = $reg['mobile'];
$template_id = '1007350597826968951';
$from = 'DAKNPY';
$sms_text = urlencode("You are $dateDiff day(s) past your due date and a late fee of Rs. $totalinterest interest has been charged to your DAKSHINPAY account. Your total outstanding is now Rs $total.Please make the payment at the earliest using  DakshinPay App or https://www.dakshinpay.com/services/paymentrequest.php?paymentid=$row[0] - Plz ignore if already paid.");

//Submit to server

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://msg.klientbox.com/app/smsapi/index.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=9&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id);
$response = curl_exec($ch);
curl_close($ch);


$singleID = $reg['regid']; 
    $fcmMsg = array(
    	'body' => "Your due date was crossed and a late fee of Rs. $interest has been charged to your DAKSHINPAY account. Your total outstanding is now Rs $total",
    	'title' => "Payment Status",
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
    
}    
//include "late-fee-charged.php";    

include "templates/latefee.php";

$as = $db->query("SELECT * FROM register where status = 'Active' and guid = '".$row['userid']."' ")->rowCount();

if($as > 0){
//include "account_blocked.php";


$message="Your Dakshinpay account has been blocked. Kindly clear your dues to reactivate your Dakshinpay account by using  https://www.dakshinpay.com/services/paymentrequest.php?paymentid=$row[0] for any assistance, please reach out to us at customercare@dakshinpay.com";

$sms=str_replace(" ","%20","$message"); 


 
$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$reg[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007349383456586393";

//include "regemail.php";

//get_blockdata($url);


$api_key = '561D6D54DB7A77';
$contacts = $reg[mobile];
$template_id = '1007349383456586393';
$from = 'DAKNPY';
$sms_text = urlencode("Your Dakshinpay account has been blocked. Kindly clear your dues to reactivate your Dakshinpay account by using  https://www.dakshinpay.com/services/paymentrequest.php?paymentid=$row[0] for any assistance, please reach out to us at customercare@dakshinpay.com");

//Submit to server

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://msg.klientbox.com/app/smsapi/index.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=9&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id);
$response = curl_exec($ch);
curl_close($ch);

include "templates/blocked.php";

}

$up = $db->query("UPDATE register SET account = 'Blocked'  WHERE  guid = '".$row['userid']."' ");


}

}

?>