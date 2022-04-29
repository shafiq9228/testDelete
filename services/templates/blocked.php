<?php //require '../phpmailler/PHPMailerAutoload.php';


  $$mail = new PHPMailer;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPAuth=true;
  $mail->SMTPSecure='tls';
  $mail->Username='catchwaymailler@gmail.com';
  $mail->Password='Catchway@2020';
  $mail->setFrom('customercare@dakshinpay.com');
  $mail->addAddress($info[email]);
  $mail->addReplyTo('customercare@dakshinpay.com');
  $mail->isHTML(true);
  $mail->Subject='Your DAKSHINPAY account has been blocked';
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
.style3 {color: #FFFFFF}
-->

.bg{
    
 background: url("https://www.dakshinpay.com/services/templates/grey-bg.jpg");  
}
</style>
</head>

<body>
<table width="600" height="599" border="0" align="center" cellpadding="0" cellspacing="0" class="bg" style=" background-size: cover; background-position:bottom;">
  <tr>
    <td height="108" align="center" bgcolor="#FFFFFF" style="border: 2px solid #535353;"><img src="https://www.dakshinpay.com/services/templates/dakshinpay_logo_small.png" width="130" height="128" /></td>
  </tr>
  <tr>
    <td height="324" align="center"><p>&nbsp;</p>
      <p><img src="blocked.png" width="175" height="175" /></p>
      <h2 class="style3">Account Blocked </h2>
      <p class="style3">Since you are failed to clear your previous dues, </p>
      <p class="style3">we are sorry to inform that you account has been blocked. </p>
      <p class="style3">Your account will be activated once the payment is received by Dakshinpay. </p>
      <p class="style3">&nbsp;</p></td>
  </tr>
  <tr>
    <td height="123" align="center"><p class="style1"><img src="https://www.dakshinpay.com/services/templates/logo_icon2.png" width="254" height="257" style="opacity: .3;" /></p>
    <p class="style1">&nbsp;</p></td>
  </tr>
</table>
</body>
</html>';

$mail->send();


?>

