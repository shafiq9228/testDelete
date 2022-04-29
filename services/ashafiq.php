<?php
 
      $data = array(
                "query1" => "parameter1 ",
                "text" => "Hi, Message from android example"
              );
 
       $url = "https://androidtraininginstitute.com/dakshinpay/api/verifyotp/";
 
       $ch = curl_init ($url);
       curl_setopt ($ch, CURLOPT_POST, true);
       curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
 
       $response = curl_exec ($ch);
       if(!response){
               die("Error: "" . curl_error($ch) . "" - Code: " . curl_errno($ch));
         }
 
       curl_close($crl);
 
?>