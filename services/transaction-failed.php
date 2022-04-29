<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');

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

$message="Dear Customer - Your payment Rs. $amount is failed";
$sms=str_replace(" ","%20","$message"); 

if($billid > 0){
    
 $postad = $db->query("UPDATE transactions SET payment_id = '$payment_id'  WHERE  userid = '$userid' and guid = '$billid' ");

}
//$url = "http://145.239.206.220/smsapi/index.jsp?username=dakshin&pwd=pradeep&msisdn=$reg[mobile]&msg=$sms&senderid=DAKNPY&pe_id=1001724022979357639";

$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$reg[mobile]&text=$sms&coding=0&pe_id=1001724022979357639";

//get_data($url);

include "templates/failed.php";	


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
  $mail->Subject='Payment failed for  Rs. '.$amount.' ';
  $mail->Body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>Transaction Failed</title>
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
-->
</style>
</head>
<style>
	@import url("https://fonts.googleapis.com/css2?family=Prompt:wght@300&family=Roboto+Slab&display=swap");
	 body {
            margin: 0;
            padding: 0;
            
            background: #f3f3f3;
			font-family: "Prompt", sans-serif;
        }
		.due{
		color: #dedede;
		text-align:center;
		font-family: "Prompt", sans-serif;
		font-weight: 400;
		font-size: 14px;
		}
		.late{
			color: #fff;
			font-size:30px;
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
</style>
<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background: #f3f3f3;""><div align="center"><img src="https://dakshinpay.com/cw_admin/templates/images/logo-new.png" height="100" style="object-fit:contain; width: 300px;" /></div>
	</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" align="center" style="min-width: 100%; background: #032553;  border-radius: 10px 10px 0px 0px; ">

      <tr>
        <td align="center" style="padding-top: 20px;"><img src="https://dakshinpay.com/cw_admin/templates/images/cancel.png"  height="100" / style="object-fit:contain;" /></td>
      </tr>
      <tr>
        <td align="center" class="late">Transaction Failed</td>
      </tr>
      <tr>
        <td align="center" class="rate">Your repayment of <i class="fa fa-inr" aria-hidden="true"></i> '.$amount.' for DaskhinPAY dues</td>
      </tr>
      <tr >
        <td align="center" style="padding-bottom: 20px;"><span class="due" >could not be processed due to some technical issue.</span></td>
      </tr>
	  
	  
	  
      <tr >
	  
        <td height="60" align="center" valign="middle" style="padding-bottom: 30px; padding-top:10px; " mc:edit="tm8-05">
		
		
            <!--multiline> 
              <div align="center"><br />
                    <a href="#" class="btn" >Retry</a></div>
          </multiline--> 
		  <!--<img src="https://dakshinpay.com/cw_admin/templates/images/fp.png"  height="100" / style="object-fit:contain; position: absolute; left: 15%; margin-top: -65px; width: 15%;" />-->
		         </td>
		  
		    
      </tr>
	  
	  
      
     
	  
    </table>
    </td>
  </tr>
</table>
</body>
</html>';

$mail->send(); */
