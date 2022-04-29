<?php ob_start();

ini_set('max_execution_time', -1); 

date_default_timezone_set('Asia/Kolkata');

require "config.php";
$date = date('Y-m-d');

/*$api_token = "EXyGufRYEL3Bij2ZReG2HILolaLjmchoVvUrmqTANdBpSlcukf3oadhjzSC2"; // api_token token will in (https://www.pay2all.in/developers/recharge-api-doc) 
        $ch = curl_init();
        $url = "https://www.pay2all.in/web-api/get-provider?api_token=$api_token";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
       //echo $response;
        
       $arr = json_decode($response, true);
      // print_r($arr['providers'][0]['provider_name']);
//echo count($arr['providers']);

for($i=0;$i<=count($arr['providers']);$i++){
    
 
$postad = $db->query("INSERT INTO providers (`provider_id`,`provider_name`,`provider_code`,`service`,`provider_image`,`status`,`date`) VALUES ('".$arr['providers'][$i]['provider_id']."','".$arr['providers'][$i]['provider_name']."','".$arr['providers'][$i]['provider_code']."','".$arr['providers'][$i]['service']."','".$arr['providers'][$i]['provider_image']."','".$arr['providers'][$i]['status']."','$date')");


}
*/

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.pay2all.in/v1/app/providers',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJmYWM5OTA4YzgxMDk1ZDQ1NzkxYTZkYmZiMTQxYTVlZGI2NzQwZDRiNGI2MWVmNTNhZWEwMzE0ZDI1NjhhM2M4NTcxN2Y5MGMyMmU5ZmE2In0.eyJhdWQiOiIxIiwianRpIjoiMmZhYzk5MDhjODEwOTVkNDU3OTFhNmRiZmIxNDFhNWVkYjY3NDBkNGI0YjYxZWY1M2FlYTAzMTRkMjU2OGEzYzg1NzE3ZjkwYzIyZTlmYTYiLCJpYXQiOjE2MTY2Njg3NjcsIm5iZiI6MTYxNjY2ODc2NywiZXhwIjoxNjQ4MjA0NzY3LCJzdWIiOiI0MzAiLCJzY29wZXMiOltdfQ.fZrhPWm4px5LZuhzKf5CUBJXzO0WLiVt-BiExkPfFgGmwvYYIs385HBBj2Yrn_L4TcNpjb11MoZsa51g9zi6Ta2zOu1wDGbMDW-Lk8fHBUj_EkpH_lGNJ0-IdzlnoDd7pyV7SBb_SmTP_EzY1hjhSk72nf1LXKmhygaPDhdmKEIQr5D7SedGDOkHrlyug7LaGU67N1UegeEOz5arrzXzuRsZM0b6qogzP0fwR0Dof8oD4Mx1OO44p1_0N2cKFLYJcKp1DHRiZcwMkXLEPDvVLKH_lB0CNPhxJ9q2qrV9VkPcTkfXn8Vq4whDshBqQR9QXZQ0OZ6ahjo0dDqB8uk0HNBhJGUdpuEhjdafnHeMO_UY7MxGwjmaFdkS6iu4jH_2ThlSJr77kZHGpXXcfWfKoO9GIFIWQKgVLpIPZlty1oN4tjkrpVlUmcKr61FDEzrbu_7sOzhxB-QrD9zCWMSogXS5rLhLAQiVWc_z6lSpKNSIOZUi-SIXxLFiq3Cr6hv_SCffwZf9kPN1uCXTdm6jr3FSRMzBMsUxysz_f5aPa0XEeM8TR5JzCLGCI5SqeyraWxs8cCaiKkRQ_E0BRSeX63awuGChInRCyVVy6K0h4CnT1UuUcSZk2yD5P9HjrUB237X0LkfzwCsM8nTRkKyl3jHCL6-HcIun9-36TeYYFcI',
    'Cookie: XSRF-TOKEN=eyJpdiI6IlpxK3JDTElhVzVwc0dReU1EemZFcWc9PSIsInZhbHVlIjoiclhNbGJRKzlld0Qxa3BVMk85cmk4UEUyOENVUGdEMCtxYng2VjNEbG80NDMyQXN1ZElZNnNsalNMVkdsN3oySHBtN0twaUk0V1RGMzdJUXdQRTQ4YnZPZk8yOFwva3Rpd29ZbHFzQVdoSUV4MmNpOWk3QWQ4dTJcLyt3dllQNmxGOCIsIm1hYyI6IjY3NjVkNzMyZjdlMTJjMjkyNjY0NjIzZmViYTEyYmE0Zjg4OGQ4N2M3ODIwYmFhOGNlNjA4ZWRlMTlkNDVmN2YifQ%3D%3D; pay2all_session=eyJpdiI6ImRtVkxIZUxVdWpRaEduK1BOalErc3c9PSIsInZhbHVlIjoiaGFvalYzTDFXdXUwK016MVpDa2c2bWIwRlY2Rm5WSmVNdjc0Tit4T2N4NEUxbVI1Um9SXC8yakxFNHhCV3FiUUE2akFyTVZ6TDNjME5naks2YlVubEpzY2lMcjM5bnNUeERBaGlFaUI0d1JjY3A5N1NGVjB1MFVJM1RGWkVmS3M1IiwibWFjIjoiMjZlZWMzNzkwZWJlMDI4ZDQzMDNhNTYyZmIyYzgxZDcwMjViNzQzYWQwNmVhYzc3Mzg1MTE5Y2Q5YmIwMWUxYiJ9'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$arr = json_decode($response, true);

//print_r($arr);

//print_r($arr['services'][0]);

for($i=0;$i<=count($arr['providers']);$i++){
    
 
//$postad = $db->query("INSERT INTO services (`id`,`service_name`,`description`,`icon`,`url`,`company_id`,`active`,`type`) VALUES ('".$arr['services'][$i]['id']."','".$arr['services'][$i]['service_name']."','".$arr['services'][$i]['description']."','".$arr['services'][$i]['icon']."','".$arr['services'][$i]['url']."','".$arr['services'][$i]['company_id']."','".$arr['services'][$i]['active']."','".$arr['services'][$i]['type']."')");


$postad = $db->query("INSERT INTO providers (`id`,`provider_name`,`service_id`,`description`,`status`,`icon`) VALUES ('".$arr['providers'][$i]['id']."','".$arr['providers'][$i]['provider_name']."','".$arr['providers'][$i]['service_id']."','".$arr['providers'][$i]['description']."','".$arr['providers'][$i]['status']."','".$arr['providers'][$i]['icon']."')");


}
echo "success";