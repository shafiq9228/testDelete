<?php 


$message="Your Dakshinpay account has been blocked. Kindly clear your dues to reactivate your Dakshinpay account by using  https://www.dakshinpay.com/services/paymentrequest.php?paymentid=$row[0] for any assistance, please reach out to us at customercare@dakshinpay.com";
$sms=str_replace(" ","%20","$message"); 


 
//$url = "http://145.239.206.220/smsapi/index.jsp?username=dakshin&pwd=pradeep&msisdn=$info[mobile]&msg=$sms&senderid=DAKNPY&pe_id=1001724022979357639";

$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$reg[mobile]&text=$sms&coding=0&pe_id=1001724022979357639&template_id=1007349383456586393";

//include "regemail.php";

get_blockdata($url);


	
  $bmail = new PHPMailer;
  $bmail->Host = 'smtp.gmail.com';
  $bmail->Port = 587;
  $bmail->SMTPAuth=true;
  $bmail->SMTPSecure='tls';
  $bmail->Username='catchwaymailler@gmail.com';
  $bmail->Password='Catchway@2020';
  $bmail->setFrom('customercare@dakshinpay.com');
  $bmail->addAddress($reg[email]);
  $bmail->addReplyTo('customercare@dakshinpay.com');
  $bmail->isHTML(true);
  $bmail->Subject='Sorry to inform you that your account has been blocked';
  
  $bmail->Body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>Acount Blocked</title>
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
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background: #f3f3f3;"><div align="center"><img src="https://dakshinpay.com/cw_admin/templates/images/logo-new.png" height="100" style="object-fit:contain; width: 300px;" /></div>
	</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" align="center" style="min-width: 100%; 
   background: #032553;  border-radius: 10px; ">

      <tr>
        <td align="center" style="padding-top: 20px;"><img src="https://dakshinpay.com/cw_admin/templates/images/blocked.png"  height="100"  style="object-fit:contain;" /></td>
      </tr>
      <tr>
        <td align="center" class="late" style="padding-bottom: 30px;">Acount Blocked</td>
      </tr>
      
      <tr >
        <td align="center" style="padding-bottom: 20px;"><span class="due" >Since you failed to clear your previous dues, we are sorry to <br> inform you that your account has been blocked. Your account <br> will be activated once the payment is received by DakshinPAY</span></td>
      </tr>
	  
	   <tr >
        <td align="center" style="padding-bottom: 20px;"><span class="due" >Clear your dues now.</span></td>
      </tr>
	  
      <tr style="background: #032553;">
	  
        <td height="60" align="center" valign="middle" style="padding-bottom: 30px; padding-top:10px; " mc:edit="tm8-05">
		
            <multiline> 
               <div align="center"><br />
                    <a href="https://www.dakshinpay.com/services/paymentrequest.php?paymentid='.$row[guid].'" class="btn" >Pay Now</a></div>
          </multiline> 
		  <!--<img src="https://dakshinpay.com/cw_admin/templates/images/fp.png"  height="100"  style="object-fit:contain; position: absolute; left: 15%; margin-top: -65px; width: 15%;" />-->
		         </td>
		  
		    
      </tr>
	  
	  
      
     
	  
    </table>
    </td>
  </tr>
</table>
</body>
</html>';

$bmail->send();
