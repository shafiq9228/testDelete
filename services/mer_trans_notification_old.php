<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
//print_r($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');
extract($_GET);


define( 'VENDOR_ACCESS_KEY', 'AAAAlaChzUM:APA91bHQI6cjupe1gmq06zAGUcxWdQyD-zo1EbrP1OtWR7LxG7FwQrLn21mRoCveVbxoUrmaiGZBfqK7yPFEBQ8qnuuPrOeIDabo40SBwYLXfULKyjIaV1fCf1rPas9aT3v_67Fc38h1' );

function get_merdata($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

$notif = "Received Rs. $amount from $reg[name] on ".date('d-m-Y h:i',strtotime($datetime))." ";


$info =  $db->query("SELECT * FROM `merchants` where guid = '$merchant' ")->fetch();
 
 
$message="Dear Merchant- You have received a payment of Rs.$amount against a transactions DAKSHINPAY Merchant .Your transaction ID is $val .";
$sms=str_replace(" ","%20","$message"); 


 
//$url = "http://145.239.206.220/smsapi/index.jsp?username=dakshin&pwd=pradeep&msisdn=$info[mobile]&msg=$sms&senderid=DAKNPY&pe_id=1001724022979357639";

$url = "https://49.50.67.32/smsapi/httpapi.jsp?username=dakshin&password=54321&from=DAKNPY&to=$info[mobile]&text=$sms&coding=0&pe_id=1001724022979357639";

get_merdata($url);

 

	
    $singleID = $info['regid']; 
    $fcmMsg = array(
    	'body' => "Received Rs. $amount from $reg[name]",
    	'title' => "Transaction Status",
    	'sound' => "default",
        'color' => "#203E78" 
    );
    $fcmFields = array(
    	'to' => $singleID,
        'priority' => 'high',
    	'notification' => $fcmMsg
    );
    $headers = array(
    	'Authorization: key=' . VENDOR_ACCESS_KEY,
    	'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    $result = curl_exec($ch );
    //curl_close( $ch );
    
 
  $vmail = new PHPMailer;
  $vmail->Host = 'smtp.gmail.com';
  $vmail->Port = 587;
  $vmail->SMTPAuth=true;
  $vmail->SMTPSecure='tls';
  $vmail->Username='catchwaymailler@gmail.com';
  $vmail->Password='Catchway@2020';
  $vmail->setFrom('customercare@dakshinpay.com');
  $vmail->addAddress($info[email]);
  $vmail->addReplyTo('customercare@dakshinpay.com');
  $vmail->isHTML(true);
  $vmail->Subject='Received new payment of '.$amount.'';
  $vmail->Body='
  
  <html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta content="width=device-width" name="viewport" />
    <title> Dakshin Pay </title>

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
                   <h1 style="float:left"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/White_check.svg/500px-White_check.svg.png" style="height:40px;">Payment received</h1>
                   <p style="float:right"></p>
                   <p style="clear:both;"></p>
                  
                  
                </div>
                
               <p style="font-size:20px;padding-left:20px;">Dear '.$info[name].', <br>  <br>
               Rs.'.$amount.' has been credited to your Dakshinpay account from ( '.$reg[mobile].' ) Dakshinpay account . Your transaction ID is '.$val.' </p>
               
        
        
        
        <p class="text-center" style="text-align:center;"><img src="https://dakshinpay.com/cw_admin/templates/images/logo-new.png"  style="height:100px;"></p>
        
        <p class="text-center" style="font-size:12px;  text-align:center;">Please mail us for quiries customercare@dakshinpay.com </p>

            </div>
        </div>
    </div>

</body>

</html>
  
';

$vmail->send();

$postad = $db->query("INSERT INTO merchant_notif(`transid`,`userid`,`message`,`date`,`datetime`,`status`) VALUES ('$insid','$merchant','$notif','$date','$datetime','0')");
		



?>