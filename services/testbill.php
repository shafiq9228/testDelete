<?php ob_start();

ini_set('max_execution_time', -1); 

date_default_timezone_set('Asia/Kolkata');

require "config.php";
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');

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


$duedate = date("Y-m-d", strtotime($date . " +2 days"));    

$maxid = $db->query("SELECT  max(guid) FROM register where status = 'Approved' ")->fetch();

//for($i=1;$i<=$maxid;$i++){

$row = $db->query("SELECT *  FROM register where status = 'Approved' and guid = '3' ")->fetch();

//while($row = $sql->fetch()){ 
    
 
$chk = $db->query("SELECT * FROM `bills`  where userid = '".$row['guid']."' and date = '$date' ")->rowCount();

if($chk == 0){
    

$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$row['guid']."' and status = 'Debit' and bill_status = '0' ")->fetch();

if($tb[0] > 0){
    

$postad = $db->query("INSERT INTO bills (`pincode`,`userid`,`custid`,`name`,`email`,`mobile`,`subtotal`,`interest`,`waiveoff`,`total`,`duedate`,`date`,`datetime`,`deviceid`,`regid`,`status`) VALUES ('$row[pincode]','$row[guid]','$row[reg_num]','$row[name]','$row[email]','$row[mobile]','$tb[0]','0','0','$tb[0]','$duedate','$date','$datetime','$row[deviceid]','$row[regid]','Pending')");
		

$sql = $db->query("UPDATE transactions SET bill_status = '1'  where userid = '".$row['guid']."' and status = 'Debit' ");


$notif = "New bill generated for Rs.$tb[0] ,please pay before duedate ".date('d-m-Y',strtotime($duedate))." ";


$info =  $db->query ("SELECT * FROM `register` where guid = '".$row['guid']."' ")->fetch();
  



$sms=str_replace(" ","%20","$notif"); 


 
$url = "http://145.239.206.220/smsapi/index.jsp?username=dakshin&pwd=pradeep&msisdn=$info[mobile]&msg=$sms&senderid=DAKNPY&pe_id=1001724022979357639";

get_data($url);

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

$postad = $db->query("INSERT INTO customer_notif(`transid`,`userid`,`message`,`date`,`datetime`,`status`) VALUES ('$val','".$row['guid']."','$notif','$date','$datetime','1')");

//include "email_bill.php";

}
}


echo "Bills generated";

?>