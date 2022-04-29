<?php
$url = "https://apibankingone.icicibank.com/api/v1/composite-payment";   
$ch = curl_init();   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
curl_setopt($ch, CURLOPT_URL, $url);   
$res = curl_exec($ch);   
echo $res;  

?>