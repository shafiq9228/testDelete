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
  $mail->Subject='Bill generated,please clear the dues';
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
.style3 {color: #FFFFFF}
.style4 {
	font-size: 50px;
	font-weight: bold;
}
.style7 {font-size: 36px}
.style8 {color: #FFFFFF; font-size: 18px; }
.style9 {font-size: 14px}
-->

.bg{
    
 background: url("https://www.dakshinpay.com/services/templates/profile-bg.jpg");  
}
</style></head>

<body>
<table width="600" height="599" border="0" align="center" cellpadding="0" cellspacing="0" class="bg" style="background-size: cover; background-position:bottom;">
  <tr>
    <td height="108" align="center" bgcolor="#FFFFFF" style="border: 2px solid #4495ff;"><img src="https://www.dakshinpay.com/services/templates/dakshinpay_logo_small.png" width="130" height="128" /></td>
  </tr>
  <tr>
    <td height="324" align="center"><p>&nbsp;</p>
      <p><img src="https://www.dakshinpay.com/services/templates/bill.png" width="175" height="175" /></p>
      <h2 class="style3">Unpaid Payment Alert</h2>
      <p class="style3 style4" style="margin: 0;"><span class="style7">&#8377;</span>'.$nettotal.'*</p>
      <p class="style8">From '.date("d M",strtotime($bill[fromdate])).' to '.date("d M",strtotime($bill[todate])).'</p>
	  <br /><br />
	  <p class="style8">Last due date to pay was :  '.date('d M ,Y',strtotime($bill[duedate])).'</p>
      <p class="style3"><a href="https://www.dakshinpay.com/services/paymentrequest.php?paymentid='.$bill[guid].'" style="border-radius: 100px; padding:10px; width:150px; background:white; border: 0; font-weight:bold; color: #3babff; font-size: 20px;">PAY NOW</a></p>
      <p class="style3">&nbsp;</p></td>
  </tr>
  <tr>
    <td height="123" align="center"><p class="style1"><img src="https://www.dakshinpay.com/services/templates/logo_icon2.png" width="254" height="257" style="opacity: .3; position:absolute; bottom: -250px; margin-left: -287px;" /></p>
      <p class="style3 style9">A late payment fee of <span>&#8377;</span>70.00 has been charged to<br />your Dakshinpay account. Please clear your dues<br /> now to enjoy uninterrupted services.</p>
    <p class="style1">&nbsp;</p></td>
  </tr>
</table>
</body>
</html>';

$mail->send();
