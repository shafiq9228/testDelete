<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

extract($_GET);
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
     
     
$postad = $db->query("INSERT INTO transactions (`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`payment_id`,`status_message`) VALUES ('Bill Payment','$reg[pincode]','$val','$userid','0','Dakshinpay','$reg[name]','$reg[mobile]','$amount','Amount settled to dakshinpay','Credit','$date','$datetime','$payment_id','Success')");
		
	
if($postad) {

$insid = $db->lastInsertId();				


$notif = "Paid Rs. $amount to Dakshinpay on ".date('d-m-Y h:i',strtotime($datetime))." ";


$sql = $db->query("INSERT INTO customer_notif(`transid`,`userid`,`message`,`date`,`datetime`,`status`) VALUES ('$val','$userid','$notif','$date','$datetime','1')");

$up = $db->query("UPDATE interest SET status = 'Paid'  WHERE  userid = '$userid' ");

$tr = $db->query("UPDATE bills SET status = 'Paid',paidon = '$date' WHERE  userid = '$userid' and status = 'Pending' ");

$uptr = $db->query("UPDATE transactions SET bill_status = '1'  where userid = '".$userid."' and status = 'Debit' ");

$upcb = $db->query("UPDATE transactions SET bill_status = '1'  where userid = '".$userid."' and status = 'Cashback' ");

$upcust = $db->query("UPDATE register SET account = 'Active'  WHERE  guid = '".$userid."' ");

$message="Dear Customer - Thank you for your payment of Rs. $amount against your DAKSHINPAY statement";
$sms=str_replace(" ","%20","$message"); 


 
//$url = "http://145.239.206.220/smsapi/index.jsp?username=dakshin&pwd=pradeep&msisdn=$reg[mobile]&msg=$sms&senderid=DAKNPY&pe_id=1001724022979357639";

$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$reg[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007700756213823103";

get_data($url);


$admin_msg ="Dear admin - You have received new payment of Rs. $amount from $reg[name] , $reg[mobile]";
$asms=str_replace(" ","%20","$admin_msg"); 


 
//$aurl = "http://145.239.206.220/smsapi/index.jsp?username=dakshin&pwd=pradeep&msisdn=8099993132&msg=$asms&senderid=DAKNPY&pe_id=1001724022979357639";

//$aurl = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=8099993132&text=$asms&coding=0&pe_id=1001724022979357639";

//get_data($aurl);  



 $singleID = $reg['regid']; 
    $fcmMsg = array(
    	'body' => "Thank you for your payment of Rs. $amount against your DAKSHINPAY statement ",
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
    $response = curl_exec($ch);
    //curl_close( $ch );

/*$mail = new PHPMailer;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPAuth=true;
  $mail->SMTPSecure='tls';
  $mail->Username='catchwaymailler@gmail.com';
  $mail->Password='Catchway@2020';
  $mail->setFrom('customercare@dakshinpay.com');
  $mail->addAddress($reg[email]);
  $mail->addReplyTo('customercare@dakshinpay.com');
  $mail->isHTML(true);
  $mail->Subject='Thank you for your payment of Rs. '.$amount.' against your DAKSHINPAY statement';
  $mail->Body='
  
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>Debited from Your Account</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
<style type="text/css">
<!--
.btn1 {
    text-decoration: none;
    color: #FFF;
    background: #ffffff;
    -moz-border-radius: 40px;
    border-radius: 40px;
   font-family: "Prompt", sans-serif;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    color: #e11b4c;
    padding: 15px;
}
.style2 {font-family: "Prompt", sans-serif; font-weight: 500; font-size: 16px; text-align: center;}
.style7 {font-size: 24px}
-->
</style>

<style>
	@import url("https://fonts.googleapis.com/css2?family=Prompt:wght@300&family=Roboto+Slab&display=swap");
	 body {
            margin: 0;
            padding: 0;
            
            background: #f3f3f3;
			font-family: "Prompt", sans-serif;
        }
		.due{
		color: #efebeb;
    text-align: center;
    font-family: "Prompt", sans-serif;
    font-weight: 500;
    font-size: 16px;
		}
		.late{
			color: #fff;
			font-size:24px;
			font-weight: 600;
			font-family: "Prompt", sans-serif;
		}
		.rate{
			color: #fff;
			font-size:20px;
			font-family: "Prompt", sans-serif;
		}
		.btn{
		text-decoration: none;
    color: #032553;
    background: #ffffff;
    -moz-border-radius: 40px;
    border-radius: 40px;
   font-family: "Prompt", sans-serif;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    color: #032553;
    padding: 8px 20px !important;
		}
.style3 {color: #efebeb; text-align: center; font-family: "Prompt", sans-serif; font-weight: bold; font-size: 36px; }
.style6 {font-size: 30px}
</style>
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background: #f3f3f3;"><div align="center"><img src="https://dakshinpay.com/cw_admin/templates/images/logo-new.png" height="100" style="object-fit:contain; width: 300px;" /></div>
	</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" align="center" cellpadding="10" style="min-width: 100%; 
   background: #032553;  border-radius: 10px; ">

      <tr>
        <td align="center" style="padding-top: 20px;"><img src="https://dakshinpay.com/cw_admin/templates/images/savings.png" width="110"  height="99"  style="object-fit:contain;" /></td>
      </tr>
      <tr>
        <td align="center" class="late style7" style="padding-bottom: 0px;">Dear '.$reg[name].'</td>
      </tr>
      
      <tr >
        <td align="center" style="padding-bottom: 0px;"><p class="due">
          <span class="style3"><span style="font-size: 20px;">&#8377;</span><span class="style6">'.$amount.'</span></span><br />
          Has been received from your Dakshin Pay Account ('.$reg[mobile].') to Dakshin Pay. Your transaction ID is #'.$val.'. </p></td>
      </tr>
	  
	   <tr >
        <td align="center" style="padding-bottom: 0px;"><span class="due" >Please mail us for queries </span><span class="style2" ><a href="linkto=customercare@dakshinpay.com" style="color: white;">customercare@dakshinpay.com</a></span><span class="due" > </span></td>
      </tr>
	  
      <tr style="background: #032553;">
	  
        <td height="60" align="center" valign="middle" style="padding-bottom: 30px; padding-top:10px; " mc:edit="tm8-05">
		
            <multiline>
              <p style="padding-bottom: 20px;"><span class="due" >Warm Regards,</span><br />
              <span class="due">Dakshin Pay </span><br /><br />
              <a href="https://www.facebook.com/dakshinpay.harkadampe" target="_blank"><img src="https://dakshinpay.com/cw_admin/templates/images/fb.png" /></a>
			  <a href="https://twitter.com/dakshinpay" target="_blank"><img src="https://dakshinpay.com/cw_admin/templates/images/tw.png" /></a>
			  <a href="" target="_blank"><img src="https://dakshinpay.com/cw_admin/templates/images/g+.png" /></a>
			  <a href="" target="_blank"><img src="https://dakshinpay.com/cw_admin/templates/images/insta.png" /></a>
			  </p>
            </multiline>            </td>
		  
		    
      </tr>
	  
	  
      
     
	  
    </table>
    </td>
  </tr>
</table>
</body>
</html>';

$mail->send(); */

include "templates/thankyou.php";

$result =  $insid;
    
    
}else{ $result = "Error";}


echo json_encode($result);


?>