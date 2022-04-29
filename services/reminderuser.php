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


function dateDifference($start_date, $end_date){
    // calulating the difference in timestamps 
    $diff = strtotime($start_date) - strtotime($end_date);
     
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds
    return ceil(abs($diff / 86400));
}



$maxid = $db->query("SELECT  max(guid) FROM recharges where  date_add(expiry_date,interval 2 day) > '$date' and expiry_date !='1970-01-01' and expiry_date !=''  ")->fetch();

for($i=1;$i<=$maxid;$i++){

$row = $db->query("SELECT *  FROM recharges where status = 'Debit' and date_add(expiry_date,interval 2 day) > '$date' and guid = '".$i."' and expiry_date !='1970-01-01' and expiry_date !='' ")->fetch();


$reg = $db->query("SELECT * FROM `register`  where guid = '".$row['userid']."' ")->fetch();



$dateDiff = dateDifference($row['expiry_date'], $date);



$notif = 'Your recharge plan will expire in '.$dateDiff.' days,recharge your number "'.$row['number'].'" with "'.$row['amount'].'" to continue services';
    
    
$sql = $db->query("INSERT INTO customer_notif(`transid`,`userid`,`message`,`date`,`datetime`,`status`) VALUES ('$row[guid]','$row[userid]','$notif','$date','$datetime','1')");


$message = "Your recharge plan will expire in $dateDiff ,recharge your number $row[number] to continue services - Plz ignore if already done.";


$sms=str_replace(" ","%20","$message"); 



$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$reg[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007350597826968951";

get_data($url);



 $singleID = $reg['regid']; 
    $fcmMsg = array(
    	'body' => $notif,
    	'title' => "Recharge reminder",
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

?>