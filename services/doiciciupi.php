<?php header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_GET);
extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

require 'phpmailler/PHPMailerAutoload.php';

$u = $db->query("SELECT * FROM `upi_payments`  where guid = '".$_GET['transaction']."' ")->fetch();


$reg = $db->query("SELECT * FROM `register`  where guid = '".$userid."' ")->fetch();

//$ser = $db->query("SELECT * FROM `services`  where guid = '".$u['serviceid']."' ")->fetch();



if($reg['approval_status'] == 'Approved' && $reg['account']=='Active'){
    

$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit'  ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback'  ")->fetch();

$tcr = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit'  ")->fetch();

$int = $db->query ("SELECT sum(interest) FROM `interest` where status = 'Paid' and userid = '".$userid."' ")->fetch();


$credit = ($reg['credit']+$tc[0]+$tcr[0])-$tb[0]-$int[0];

$balance = ($reg['credit']+$tc[0])-$tb[0]-$amount;

/* spent amount */

$b = $db->query ("SELECT sum(total) FROM `bills` where status = 'Pending' and userid = '".$userid."' ")->fetch();


$debt_unbilled = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit' and bill_status = '0'   ")->fetch();

$tc_unbilled = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback' and bill_status = '0' ")->fetch();


$totalspent = $b[0]+$debt_unbilled[0];

$creditbalance = $reg['credit']+$tc_unbilled[0]-$totalspent;
 /* end of spent */
$set = $db->query ("SELECT * FROM `settings` where guid = '1' ")->fetch();

$total = $amount+$set['charges'];

if($creditbalance >= $total){
    
if($message ==''){ $message = 'Payment to '.$total.' '; }

$reques_params = [
   "device-id"=> "510322510322510322510322",
    "mobile"=> "8099993132",
    "channel-code"=> "MICICI",
    "profile-id"=> "194372497",
    "seq-no"=> date('YmdHis'),
    "account-provider"=> "74",
    "use-default-acc"=> "D",
    "payee-va"=>"'.$u[upi].'",
    "payer-va"=> "DAKSHINBHARATH@icici",
    "amount"=> "'.$amount.'",
    "pre-approved"=> "P",
    "default-debit"=> "N",
    "default-credit"=> "N",
    "txn-type"=> "merchantToPersonPay",
    "remarks"=> "none",
    "mcc"=> "6012",
    "merchant-type"=> "ENTITY",
];
/*$reques_params = [
   "device-id"=> "410706410706410706410706",
    "mobile"=> "8499822444",
    "channel-code"=> "MICICI",
    "profile-id"=> "63377637",
    "seq-no"=> date('YmdHis'),
    "account-provider"=> "74",
    "use-default-acc"=> "D",
    "payee-va"=>"mark.cto@ybl",
    "payer-va"=> "rk.catchway@okicici",
    "amount"=> "10",
    "pre-approved"=> "P",
    "default-debit"=> "N",
    "default-credit"=> "N",
    "txn-type"=> "merchantToPersonPay",
    "remarks"=> "none",
    "mcc"=> "6012",
    "merchant-type"=> "ENTITY",
];*/
$apostData = json_encode($reques_params);
print_r("<<========apostData=========>>");
print_r($apostData);
$sessionKey = 1234567890123456; //hash('MD5', time(), true); //16 byte session key

$fp= fopen("keys/LiveCert.txt","r");
$pub_key_string=fread($fp,8192);
//fclose($fp);
openssl_get_publickey($pub_key_string);
openssl_public_encrypt($sessionKey,$encryptedKey,$pub_key_string); // RSA

$iv = 1234567890123456; //str_repeat("\0", 16);

$encryptedData = openssl_encrypt($apostData, 'aes-128-cbc', $sessionKey, OPENSSL_RAW_DATA, $iv); // AES

$request = [
    "requestId"=> "req_".time(),
    "encryptedKey"=> base64_encode($encryptedKey),
    "iv"=> base64_encode($iv),
    "encryptedData"=> base64_encode($encryptedData),
    "oaepHashingAlgorithm"=> "NONE",
    "service"=> "",
    "clientInfo"=> "",
    "optionalParam"=> ""
];

print_r("<<========request=========>>");
//print_r($request);
// echo "Time: ".date('Y-m-d H:i:s').PHP_EOL.PHP_EOL; echo "<br/>";
// echo "Session key: ".$sessionKey.PHP_EOL.PHP_EOL; echo "<br/>";
// echo "Base64 Session key: ".base64_encode($sessionKey).PHP_EOL.PHP_EOL; echo "<br/>";
// echo "Decrypted Request: ".$apostData.PHP_EOL.PHP_EOL; echo "<br/>";
// echo "encryptedKey: ".$request['encryptedKey'].PHP_EOL.PHP_EOL; echo "<br/>";
// echo "encryptedData: ".$request['encryptedData'].PHP_EOL.PHP_EOL; echo "<br/>";
// echo "iv: ".$request['iv'].PHP_EOL.PHP_EOL; echo "<br/>";

$apostData = json_encode($request);
print_r("<<========apostData=========>>");
print_r($apostData);
$httpUrl = "https://apibankingone.icicibank.com/api/v1/composite-payment";
print_r("<<========httpUrl=========>>");
print_r($httpUrl);
$headers = array(
    "cache-control: no-cache",
    "accept: application/json",
    "content-type: application/json",
    "apikey: 8gQJAZWDOa05lu8UgtR93kUHAflr6n1M ",
    "x-priority:1000"
);
print_r("<<========headers=========>>");
print_r($headers);
// $file = 'logFiles.txt';

// $log = "\n\n".'GUID - '.time()."================================================================\n";
// $log .= 'URL - '.$httpUrl."\n\n";
// $log .= 'HEADER - '.json_encode($headers)."\n\n";
// $log .= 'REQUEST - '.json_encode($reques_params)."\n\n";
// $log .= 'REQUEST ENCRYPTED - '.$apostData."\n\n";

// file_put_contents($file, $log, FILE_APPEND | LOCK_EX);



$acurl = curl_init();
curl_setopt_array($acurl, array(
    CURLOPT_URL => $httpUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 300,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $apostData,
    CURLOPT_HTTPHEADER => $headers,
));
 

$aresponse = curl_exec($acurl);
print_r("<<========aresponse=========>>");
print_r($aresponse);
$aerr = curl_error($acurl);
$httpcode = curl_getinfo($acurl, CURLINFO_HTTP_CODE);
print_r("<<========httpcode=========>>");
print_r($httpcode);

if ($aerr) {
    
    echo "cURL Error #:" . $aerr;
} else {
    
    $fp= fopen("keys/pvtkey.txt","r");
    $priv_key=fread($fp,8192);
    fclose($fp);
    $res = openssl_get_privatekey($priv_key, "");
    $data = json_decode($aresponse);
    openssl_private_decrypt(base64_decode($data->encryptedKey), $key, $priv_key);
    $encData = openssl_decrypt(base64_decode($data->encryptedData),"aes-128-cbc",$key,OPENSSL_PKCS1_PADDING);
    $newsource = substr($encData, 16);

    // $log = "\n\n".'GUID - '."================================================================\n";
    // $log .= 'URL - '.$httpUrl."\n\n";
    // $log .= 'RESPONSE - '.json_encode($aresponse)."\n\n";
    // $log .= 'REQUEST ENCRYPTED - '.json_encode($newsource)."\n\n";
    
    // file_put_contents($file, $log, FILE_APPEND | LOCK_EX);

    $output = json_decode($newsource);
    print_r("<<========output=========>>");
//print_r($output);
}

$arr = json_decode($output, true);

print_r($response);

if($arr['status'] == 'success'){

$day = date('d',strtotime($date));
$mon = date('m',strtotime($date));
$year = date('Y',strtotime($date));       
        
      			 	 	
$orderid = $day.$mon.$year;

  $bth = $db->query("SELECT * FROM transactions where status = 'Debit' ");
  $count = $bth->rowCount();
  //echo $count; exit;
  if($count > 0) {
    $sth = $db->query("SELECT MAX(guid) FROM transactions where status = 'Debit' ");
    $row = $sth->fetch();
    $dt=$row[0];
    $qry = $db->query("SELECT transid FROM transactions WHERE guid='$dt' and status = 'Debit' ");
    $rest = $qry->fetch();
        
    $d=substr($rest[0],13);
        $icc = $d+1;
    $val= $orderid."DPD00".$icc; 
    } else {
       $val= $orderid.'DPD001';
     } 

$sql = $db->query("UPDATE upi_payments SET transid = '" . $val . "' ,status = 'Debit',message = '".$arr['message']."',bank_ref ='".$arr['bank_ref']."' ,txstatus_desc = '".$arr['txstatus_desc']."',balance='".$arr['balance']."',charge = '".$arr['charge']."',charged_amount = '".$arr['charged_amount']."' , total = '".$total."',remarks = '$remarks',amount =  '$amount',charges = '".$set['charges']."',order_id = '".$arr['order_id']."',tlid =  '".$arr['tlid']."',paymentresponse =  '$response'  WHERE  guid = '".$transaction."' ");


if($arr['message'] =='Transaction Processing'){ 
    $status_message = 'Failed';
}else if($arr['message'] =='Transaction Successful'){
   
   $status_message = 'Success'; 
}else{ $status_message = 'Pending'; }

$postad = $db->query("INSERT INTO transactions (`fkey`,`type`,`pincode`,`transid`,`userid`,`merchant`,`merchantname`,`logo`,`paidby`,`customerno`,`amount`,`message`,`status`,`date`,`datetime`,`bill_status`,`sound_notification`,`service`,`provider`,`number`,`client_id`,`provider_id`,`upi`,`orderid`,`status_message`) VALUES ('$u[guid]','General','$reg[pincode]','$val','$userid','0','$u[name]','icon_upi4.png','$reg[name]','$reg[mobile]','$total','".$arr['message']."','Debit','$date','$datetime','0','0','UPI Payment','UPI Payment','$u[mobile]','".$arr['tlid']."','0','$u[upi]','".$arr['order_id']."','$status_message')");
		

$insid = $db->lastInsertId();


$result =  $transaction;

}else if($arr['status'] == 'failure'){

  
$sql = $db->query("UPDATE upi_payments SET status = 'Failed',message = '".$arr['message']."',bank_ref ='".$arr['bank_ref']."' ,txstatus_desc = '".$arr['txstatus_desc']."',balance='".$arr['balance']."',charge = '".$arr['charge']."',charged_amount = '".$arr['charged_amount']."', total = '".$total."',order_id = '".$arr['order_id']."',tlid =  '".$arr['tlid']."',paymentresponse =  '$response'  WHERE  guid = '".$transaction."' ");



$result =  $arr;
  
}else{
 $result = $arr;   
}
}else{ $result = "debit"; }
}else if($reg['approval_status'] == 'Approved' && $reg['account']=='Blocked'){

$result = "Blocked";
}else{  $result = "Inactive"; }
echo json_encode($result);

?>
