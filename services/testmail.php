<?php 

 $to='suresh.m@catchway.in';
  $subject = "Thank You for registering in ZEROZONE";
  $from = "ZEROZONE <info@zerozone.com>";
  $headers.= 'MIME-Version: 1.0' . "\r\n";
  $headers.= 'Bcc: suresh.m@catchway.in' . "\r\n";
  $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers.= "From: ".$from;
  $message.=' <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
          Has been debited from your Dakshin Pay Account ('.$reg[mobile].') to '.$m[outlet].' . Your transaction ID is #'.$val.'. </p></td>
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
</html>
  
';
$des = str_replace("^^","'",$message);
echo $des;exit;
mail($to,$subject,$des,$headers); ?>