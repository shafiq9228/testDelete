<?php 
$otp= '9989';
$api_key = '561D6D54DB7A77';
$contacts = '8500303062';
$template_id = '1007590985028115916';
$from = 'DAKNPY';
$sms_text = urlencode("$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T&C https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.");

//Submit to server

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://msg.klientbox.com/app/smsapi/index.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=9&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id);
$response = curl_exec($ch);

//echo $response;
curl_close($ch); 

