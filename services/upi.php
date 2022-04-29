<?php

$data = [
    "payerVa" => 'patel.gfg@ybl',  // production pe user's vpa
    "amount" => '10.00', // shoul be always 2 decimal
    "note" => 'testing',
    "collectByDate" => date('d/m/Y H:i A', strtotime('+1 day')),//now + 15min,
    "merchantId" => '510322', //will provide by bank,
    "subMerchantId" => '9599217614', // can send random number or merchantId
    "subMerchantName" => 'satyender', //can send test
    "merchantName" => 'Dakshinpay', //clients company name which will be displayed at user's upi app.
    'terminalId' => '5411',
    "merchantTranId" => 'MR'.time(), //should be unique every time.
    "billNumber" => 'BN'.time() //should be unique every time.mark.cto
];

$filepath=fopen("keys/merchantEncryption.pem","r"); // bank public cert path
$pub_key_string=fread($filepath,8192);
fclose($filepath);

openssl_get_publickey($pub_key_string);
openssl_public_encrypt(json_encode($data),$crypttext,$pub_key_string); // $crypttext is output

$encryptedRequest = json_encode(base64_encode($crypttext));  // $encryptedRequest final request which need to send to bank

$header = [
    'Content-type:text/plain'
];

$httpUrl = 'https://apibankingone.icicibank.com/api/MerchantAPI/UPI/v0/CollectPay2/510322';

$logfile = 'logs/ciblog.txt';  // folder need to be created but file will be created auto

$log = "\n\n".'GUID - '.time()."================================================================\n";
$log .= 'URL - '.$httpUrl."\n\n";
$log .= 'HEADER - '.json_encode($header)."\n\n";
$log .= 'REQUEST - '.json_encode($data)."\n\n";
$log .= 'REQUEST ENCRYPTED - '.json_encode($encryptedRequest)."\n\n";

file_put_contents($logfile, $log, FILE_APPEND | LOCK_EX);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $httpUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 60,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $encryptedRequest,
    CURLOPT_HTTPHEADER => $header
));

$raw_response = curl_exec($curl);
curl_close($curl);

//echo $raw_response;
$fp= fopen("keys/pvtkey.txt","r"); // it can be in any format
$priv_key_string=fread($fp,8192);
fclose($fp);
//echo $priv_key_string;
$private_key = openssl_get_privatekey($priv_key_string, "");

//print_r($private_key);
openssl_private_decrypt(base64_decode($raw_response), $response, $private_key); // $response will be output


$log = "\n\n".'GUID - '.time()."================================================================ \n";
$log .= 'URL - '.$httpUrl."\n\n";
$log .= 'RESPONSE - '.json_encode($raw_response)."\n\n";
$log .= 'RESPONSE DECRYPTED - '.$response."\n\n";

file_put_contents($logfile, $log, FILE_APPEND | LOCK_EX);

$output = json_decode($response);

//echo $output;exit;
print_r($output);

$array = (array) $output;

echo $array[success];
?>
