<?php
echo "1";
$url = "https://www.javatpoint.com/";   
$ch = curl_init();   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
curl_setopt($ch, CURLOPT_URL, $url);   
$res = curl_exec($ch);   
echo $res;  

?>