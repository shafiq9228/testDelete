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
  $mail->Subject='Thank you for your payment of Rs. '.$amount.' against your DAKSHINPAY statement';
  $mail->Body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>DakshinPay</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.style3 {color: #FFFFFF}
.style4 {
	font-size: 50px;
	font-weight: bold;
}
.style7 {font-size: 36px}
.style9 {font-size: 14px}
.style10 {font-size: 24px}
-->

.bg{
    
 background: url("https://www.dakshinpay.com/services/templates/profile-bg.jpg");  
}
table {
    width: 600px;
}
@media (min-width: 300px) and (max-width: 767px) {
  table {
    width: 100%;
  }
}
</style></head>

<body>
<table height="599" border="0" align="center" cellpadding="0" cellspacing="0" class="bg" style=" background-size: cover; background-position:bottom;">
  <tr>
    <td height="108" align="center" bgcolor="#FFFFFF" style="border: 2px solid #4495ff;"><img src="https://www.dakshinpay.com/services/templates/dakshinpay_logo_small.png" width="130" height="128" /></td>
  </tr>
  <tr>
    <td height="324" align="center"><p>&nbsp;</p>
      <p>
	  	<img src="https://www.dakshinpay.com/services/templates/check1.png" width="175" height="175" />
	  </p>
      <p class="style3 style4" style="margin: 0;"><span class="style7">&#8377;</span>'.$amount.'*</p>
      <p class="style3">We have received a payment for your Dakshinpay dues.<br />Keep using Dakshinpay for hassle free shopping.</p>
	  <br />
  </tr>
  <tr>
    <td style="padding: 30px 30px;">
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
		  	<br /><br />
          </td>
        </tr>
      </table>
      </tr>
</table>
</body>
</html>';

$mail->send();
