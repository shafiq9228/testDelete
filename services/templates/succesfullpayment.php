<?php

  $mail = new PHPMailer;
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
  $mail->Subject='New payment to '.$m[outlet].'';
  $mail->Body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>DakshinPay</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.style1 {font-size: 12px}
.style2 {font-size: 12px; font-weight: bold; }
-->

.bg{
    
 background: url("https://www.dakshinpay.com/services/templates/_succesfullpayment_email.jpg");  
}
</style></head>

<body>
<table width="600" height="559" border="0" align="center" cellpadding="30" cellspacing="0" class="bg" style=" background-size: cover; background-position:bottom;">
  <tr>
    <td height="108"><img src="https://www.dakshinpay.com/services/templates/logo.png" width="248" height="56" /></td>
  </tr>
  <tr>
    <td height="212"><p>Dear  Customer,</p>
      <p>INR '.$amount.' debited from your Dakshin Pay Account on '.date('d-m-Y h:i',strtotime($datetime)).' IST at 
        '.$m[outlet].' / DakshinPay.</p>
      <p>Transaction ID: #'.$val.'</p>
    <!--p>Avl Bal- INR 1532.67</p--></td>
  </tr>
  <tr>
    <td height="123" align="center"><p class="style1"><img src="https://www.dakshinpay.com/services/templates/logo_icon.png" width="145" height="137" style="opacity: .5;"/></p>
      <p class="style2">Please do not reply to this mail as this 
    is an automated mail service.</p></td>
  </tr>
</table>
</body>
</html>';

$mail->send();
