<?php 


 $api_token = "EXyGufRYEL3Bij2ZReG2HILolaLjmchoVvUrmqTANdBpSlcukf3oadhjzSC2"; // api_token token will in (https://www.pay2all.in/developers/recharge-api-doc) 
        $ch = curl_init();
        $url = "https://www.pay2all.in/web-api/get-balance?api_token=$api_token";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
        
        $arr = json_decode($response, true);

//print_r($arr);
//$json_decode = json_decode($response,true);


$status = $arr['balance']; 

echo "Balance :".$status; 

/*$api_token = "EXyGufRYEL3Bij2ZReG2HILolaLjmchoVvUrmqTANdBpSlcukf3oadhjzSC2"; // api_token token will in (https://www.pay2all.in/developers/recharge-api-doc) 
        $ch = curl_init();
        $url = "ttps://www.pay2all.in/web-api/get-provider?api_token=$api_token";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
        
       $arr = json_decode($response, true);

print_r($arr); */
//$json_decode = json_decode($response,true);


