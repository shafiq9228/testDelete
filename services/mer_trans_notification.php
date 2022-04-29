<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');
extract($_GET);

define( 'VENDOR_ACCESS_KEY', 'AAAAlaChzUM:APA91bHQI6cjupe1gmq06zAGUcxWdQyD-zo1EbrP1OtWR7LxG7FwQrLn21mRoCveVbxoUrmaiGZBfqK7yPFEBQ8qnuuPrOeIDabo40SBwYLXfULKyjIaV1fCf1rPas9aT3v_67Fc38h1' );

function get_merdata($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

$notif = "Received Rs. $amount from $reg[name] on ".date('d-m-Y h:i',strtotime($datetime))." ";


$info =  $db->query("SELECT * FROM `merchants` where guid = '$merchant' ")->fetch();
 
 
$message="Dear Merchant- You have received a payment of Rs.$amount against a transactions DAKSHINPAY Merchant .Your transaction ID is $val .";
$sms=str_replace(" ","%20","$message"); 


 

$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$info[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007984443371188426";

get_merdata($url);

    $singleID = $info['regid']; 
    $fcmMsg = array(
    	'body' => "Received Rs. $amount from $reg[name]",
    	'title' => "Transaction Status",
    	'sound' => "default",
        'color' => "#203E78" 
    );
    $fcmFields = array(
    	'to' => $singleID,
        'priority' => 'high',
    	'notification' => $fcmMsg
    );
    $headers = array(
    	'Authorization: key=' . VENDOR_ACCESS_KEY,
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
    
 include "templates/merchantpayment.php";

 /* $vmail = new PHPMailer;
  $vmail->Host = 'smtp.gmail.com';
  $vmail->Port = 587;
  $vmail->SMTPAuth=true;
  $vmail->SMTPSecure='tls';
  $vmail->Username='catchwaymailler@gmail.com';
  $vmail->Password='Catchway@2020';
  $vmail->setFrom('customercare@dakshinpay.com');
  $vmail->addAddress($info[email]);
  $vmail->addReplyTo('customercare@dakshinpay.com');
  $vmail->isHTML(true);
  $vmail->Subject='Received new payment of '.$amount.'';
  $vmail->Body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>Debited from Your Account</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
<style type="text/css">
<!--
.btn1 {		text-decoration: none;
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
        <td align="center" class="late style7" style="padding-bottom: 0px;">Dear '.$info[name].'</td>
      </tr>
      
      <tr >
        <td align="center" style="padding-bottom: 0px;"><p class="due">
          <span class="style3"><span style="font-size: 20px;">&#8377;</span><span class="style6">'.$amount.'</span></span><br />
          Has been credited to your account Dakshin Pay Account ('.$info[mobile].') from '.$reg[mobile].' . Your transaction ID is #'.$val.'. </p></td>
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
			  <!--a href="" target="_blank"><img src="https://dakshinpay.com/cw_admin/templates/images/g+.png" /></a-->
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

$vmail->send(); */

$postad = $db->query("INSERT INTO merchant_notif(`transid`,`userid`,`message`,`date`,`datetime`,`status`) VALUES ('$insid','$merchant','$notif','$date','$datetime','0')");
		



?>