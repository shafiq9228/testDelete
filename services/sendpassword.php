<?php 

require 'phpmailler/PHPMailerAutoload.php';

  $mail = new PHPMailer;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPAuth=true;
  $mail->SMTPSecure='tls';
 $mail->Username='catchwaymailler@gmail.com';
  $mail->Password='Catchway@2020';
  $mail->setFrom('info@dakshinpay.com');
  $mail->addAddress($info[email]);
  $mail->addReplyTo('info@dakshinpay.com');
  $mail->isHTML(true);
  $mail->Subject='Request for password in Dakshinpay';
  $mail->Body='
  
  <html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta content="width=device-width" name="viewport" />
    <title> Dakshinpay </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <style>
    
        .body{
            font-family: "Open Sans", sans-serif;
        }
        .card-title{

            background-color:#7ace4f;
            color:#fff;
            padding:10px;
            margin-bottom:20px;

        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                padding: 8px;
                line-height: 1.42857143;
                vertical-align: top;
                border-top: 1px solid #ddd;
                font-size:16px;
            }
            
            .jumbotron {
    padding-top: 0px;
    padding-bottom: 30px;
    margin-bottom: 30px;
    color: inherit;
    background-color: #f1f1f199;
}
    </style>
    
</head>

<body>
    <div class="col-md-6 col-md-offset-3" style="width:700px;">
        <div class="jumbotron">
            <div class="container">
                <div  class="card-title">
                   <h1 style="float:left"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/White_check.svg/500px-White_check.svg.png" style="height:40px;">Your Password</h1>
                   <p style="float:right"></p>
                   <p style="clear:both;"></p>
                  
                  
                </div>
                
               <p style="font-size:20px;padding-left:20px;">Dear '.$info[name].', <br> Your  password in Dakshinpay is : <br>
                '.$info[password].'  </p>
               
        
        
        
        <p class="text-center" style="text-align:center;"><img src="https://www.dakshinpay.com/cw_admin/images/icon.png"  style="height:100px;"></p>
        
        <p class="text-center" style="font-size:12px;  text-align:center;">Copyright 2020 | https://dakshinpay.com | All Rights Reserved. </p>

            </div>
        </div>
    </div>

</body>

</html>
  
';

$mail->send();