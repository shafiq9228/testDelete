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
  $mail->Subject='Late fee charged';
  $mail->Body='<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>Latu Fee Charged</title>
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
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background: #f3f3f3;"><div align="center"><img src="https://dakshinpay.com/cw_admin/templates/images/logo-new.png" height="100" style="object-fit:contain; width: 300px;" /></div>
	</td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" align="center" style="min-width: 100%; background: #032553;  border-radius: 10px; ">

      <tr>
        <td align="center" style="padding-top: 20px;"><img src="https://dakshinpay.com/cw_admin/templates/images/rupee-icon.png"  height="100" style="object-fit:contain;" /></td>
      </tr>
      <tr>
        <td align="center" class="late">Late Fee Charged</td>
      </tr>
      <tr>
        <td align="center" class="rate"><i class="fa fa-inr" aria-hidden="true"></i> '.$interest.'</td>
      </tr>
      <tr >
        <td align="center" style="padding-bottom: 20px;"><span class="due" >From '.date("d M",strtotime($row[fromdate])).' to '.date("d M",strtotime($row[todate])).'</span></td>
      </tr>
	  
	  
	  
      <tr style="background: #032553;">
	  
        <td height="60" align="center" valign="middle" style="padding-bottom: 30px; padding-top:30px; " mc:edit="tm8-05"><span class="due">Last date to pay : '.date('d M Y',strtotime($row[duedate])).'</span><br />
            <multiline> 
              <div align="center"><br />
                    <a href="https://www.dakshinpay.com/services/paymentrequest.php?paymentid='.$row[guid].'" class="btn" >Pay Now</a></div>
          </multiline> 
		 <br><br>
		<span class="due">* Total outstanding amount <i class="fa fa-inr" aria-hidden="true"></i> '.$total.'</span>
		         </td>
		  
		    
      </tr>
	  
	  
      
     
	  
    </table>
    </td>
  </tr>
</table>
</body>
</html>';

$mail->send();
