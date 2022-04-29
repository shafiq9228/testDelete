<?php  header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
extract($_POST);

//end of data collection from form


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.pay2all.in/v1/plan/mobile',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'provider_id='.$provider_id.'&circle_id=25',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJmYWM5OTA4YzgxMDk1ZDQ1NzkxYTZkYmZiMTQxYTVlZGI2NzQwZDRiNGI2MWVmNTNhZWEwMzE0ZDI1NjhhM2M4NTcxN2Y5MGMyMmU5ZmE2In0.eyJhdWQiOiIxIiwianRpIjoiMmZhYzk5MDhjODEwOTVkNDU3OTFhNmRiZmIxNDFhNWVkYjY3NDBkNGI0YjYxZWY1M2FlYTAzMTRkMjU2OGEzYzg1NzE3ZjkwYzIyZTlmYTYiLCJpYXQiOjE2MTY2Njg3NjcsIm5iZiI6MTYxNjY2ODc2NywiZXhwIjoxNjQ4MjA0NzY3LCJzdWIiOiI0MzAiLCJzY29wZXMiOltdfQ.fZrhPWm4px5LZuhzKf5CUBJXzO0WLiVt-BiExkPfFgGmwvYYIs385HBBj2Yrn_L4TcNpjb11MoZsa51g9zi6Ta2zOu1wDGbMDW-Lk8fHBUj_EkpH_lGNJ0-IdzlnoDd7pyV7SBb_SmTP_EzY1hjhSk72nf1LXKmhygaPDhdmKEIQr5D7SedGDOkHrlyug7LaGU67N1UegeEOz5arrzXzuRsZM0b6qogzP0fwR0Dof8oD4Mx1OO44p1_0N2cKFLYJcKp1DHRiZcwMkXLEPDvVLKH_lB0CNPhxJ9q2qrV9VkPcTkfXn8Vq4whDshBqQR9QXZQ0OZ6ahjo0dDqB8uk0HNBhJGUdpuEhjdafnHeMO_UY7MxGwjmaFdkS6iu4jH_2ThlSJr77kZHGpXXcfWfKoO9GIFIWQKgVLpIPZlty1oN4tjkrpVlUmcKr61FDEzrbu_7sOzhxB-QrD9zCWMSogXS5rLhLAQiVWc_z6lSpKNSIOZUi-SIXxLFiq3Cr6hv_SCffwZf9kPN1uCXTdm6jr3FSRMzBMsUxysz_f5aPa0XEeM8TR5JzCLGCI5SqeyraWxs8cCaiKkRQ_E0BRSeX63awuGChInRCyVVy6K0h4CnT1UuUcSZk2yD5P9HjrUB237X0LkfzwCsM8nTRkKyl3jHCL6-HcIun9-36TeYYFcI'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

//echo $response;


$arr = json_decode($response, true);

//print_r($arr[data]['3G/4G']);exit;

echo json_encode($arr[data]);

