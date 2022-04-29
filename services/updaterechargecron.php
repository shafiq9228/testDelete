<?php ob_start();

ini_set('max_execution_time', -1); 

date_default_timezone_set('Asia/Kolkata');

require "config.php";
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');

$maxid = $db->query("SELECT  max(guid) FROM recharges where status = 'Pending' ")->fetch();

//echo $maxid[0];exit;
for($i=1;$i<=$maxid[0];$i++){
    

$row = $db->query("SELECT *  FROM recharges where  guid = '".$i."' and status = 'Pending' ")->fetch();



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.pay2all.in/v1/payment/status?client_id='.$row[client_id],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
 // CURLOPT_POSTFIELDS => 'client_id='.$row[client_id],
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJmYWM5OTA4YzgxMDk1ZDQ1NzkxYTZkYmZiMTQxYTVlZGI2NzQwZDRiNGI2MWVmNTNhZWEwMzE0ZDI1NjhhM2M4NTcxN2Y5MGMyMmU5ZmE2In0.eyJhdWQiOiIxIiwianRpIjoiMmZhYzk5MDhjODEwOTVkNDU3OTFhNmRiZmIxNDFhNWVkYjY3NDBkNGI0YjYxZWY1M2FlYTAzMTRkMjU2OGEzYzg1NzE3ZjkwYzIyZTlmYTYiLCJpYXQiOjE2MTY2Njg3NjcsIm5iZiI6MTYxNjY2ODc2NywiZXhwIjoxNjQ4MjA0NzY3LCJzdWIiOiI0MzAiLCJzY29wZXMiOltdfQ.fZrhPWm4px5LZuhzKf5CUBJXzO0WLiVt-BiExkPfFgGmwvYYIs385HBBj2Yrn_L4TcNpjb11MoZsa51g9zi6Ta2zOu1wDGbMDW-Lk8fHBUj_EkpH_lGNJ0-IdzlnoDd7pyV7SBb_SmTP_EzY1hjhSk72nf1LXKmhygaPDhdmKEIQr5D7SedGDOkHrlyug7LaGU67N1UegeEOz5arrzXzuRsZM0b6qogzP0fwR0Dof8oD4Mx1OO44p1_0N2cKFLYJcKp1DHRiZcwMkXLEPDvVLKH_lB0CNPhxJ9q2qrV9VkPcTkfXn8Vq4whDshBqQR9QXZQ0OZ6ahjo0dDqB8uk0HNBhJGUdpuEhjdafnHeMO_UY7MxGwjmaFdkS6iu4jH_2ThlSJr77kZHGpXXcfWfKoO9GIFIWQKgVLpIPZlty1oN4tjkrpVlUmcKr61FDEzrbu_7sOzhxB-QrD9zCWMSogXS5rLhLAQiVWc_z6lSpKNSIOZUi-SIXxLFiq3Cr6hv_SCffwZf9kPN1uCXTdm6jr3FSRMzBMsUxysz_f5aPa0XEeM8TR5JzCLGCI5SqeyraWxs8cCaiKkRQ_E0BRSeX63awuGChInRCyVVy6K0h4CnT1UuUcSZk2yD5P9HjrUB237X0LkfzwCsM8nTRkKyl3jHCL6-HcIun9-36TeYYFcI',
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$arr = json_decode($response, true);

//print_r($arr);exit;


$status_id = $arr['status_id']; 

//echo $response;
//echo "status:".$status_id;exit;

if($status_id == '0' || $status_id == '1'){
    
$day = date('d',strtotime($date));
$mon = date('m',strtotime($date));
$year = date('Y',strtotime($date));       
   // echo "hai";exit;    
      			 	 	
$orderid = $day.$mon.$year;
//echo "SELECT * FROM transactions where status = 'Debit' ";
  $bth = $db->query("SELECT * FROM transactions where status = 'Debit' ");
  $count = $bth->rowCount();
  //echo $count; exit;
  if($count > 0) {
    $sth = $db->query("SELECT MAX(guid) FROM transactions where status = 'Debit' ");
    $srow = $sth->fetch();
    $dt=$srow[0];
    $qry = $db->query("SELECT transid FROM transactions WHERE guid='$dt' and status = 'Debit' ");
    $rest = $qry->fetch();
        
    $d=substr($rest[0],13);
        $icc = $d+1;
    $val= $orderid."DPD00".$icc; 
    } else {
       $val= $orderid.'DPD001';
     }  
 

//echo "UPDATE recharges SET transid = '" . $val . "',message = '".$arr['message']."' ,status = 'Debit',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."'  WHERE  guid = '".$row['guid']."' ";exit;
$sql = $db->query("UPDATE recharges SET transid = '" . $val . "',message = '".$arr['message']."' ,status = 'Debit',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."' ,orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."'  WHERE  guid = '".$row['guid']."' ");


$postad = $db->query("UPDATE transactions SET transid = '" . $val . "',message = '".$arr['message']."',status = 'Debit',utr = '".$arr['utr']."',reportid ='".$arr['reportid']."',orderid = '".$arr['orderid']."',status_id='".$arr['status_id']."'  WHERE  client_id = '".$row['client_id']."' ");


		
		

}
 

}

echo "Bills generated";

?>