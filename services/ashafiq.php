<?php
 
      $data = array(
                "query1" => "parameter1 ",
                "text" => "Hi, Message from android example"
              );
 
       $url = "https://dakshinpay.com/testDelete/services/aservice.php";
 
       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
       $response = curl_exec($ch);
       if(!response){
               die("Error: "" . curl_error($ch) . "" - Code: " . curl_errno($ch));
         } else {
             echo $response;
         }
 
       curl_close($crl);
 
?>