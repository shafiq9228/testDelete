<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_GET);
extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

$data = file_get_contents("php://input");

    if (isset($data)) {

        $request = json_decode($data);

        $tempuserid = $request->tempuserid;

        $otp = $request->otp;

                }

$reg = $db->query("SELECT * FROM `register`  where guid = '".$tempuserid."' ")->fetch();




$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://kyc-api.aadhaarkyc.io/api/v1/income/epfo/passbook/submit-otp',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"client_id": "'.$reg['pf_client_id'].'",
	"otp": "'.$otp.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTYzMjgxMTc0MiwianRpIjoiMWY4NjZhNGItOTk1ZC00MzEwLTk2ZTktZGIyMzdmNTQxMDZhIiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmRha3NoaW5wYXlAYWFkaGFhcmFwaS5pbyIsIm5iZiI6MTYzMjgxMTc0MiwiZXhwIjoxOTQ4MTcxNzQyLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.FcDB-nQcrXEvEw0gTj3N7jiVXIx8Dz_AICfU_lvBK9U'
  ),
));



$response = curl_exec($curl);

curl_close($curl);
//echo $response;


$arr = json_decode($response, true);

//echo $response;

if($arr['success'] == true){    
    
    
  
$sql = $db->query("UPDATE register SET pf_status = 'Verified'  WHERE  guid = '".$tempuserid."' ");



    $result  = array(
        'status'  => true,
        'message' =>'PF no is verified'
        ); 
        
}else{
    
   $result  = array(
        'status'  => false,
        'message' =>'PFno verification failed',
        'error_message'=>$arr['message'],
        'client_id'=>$reg['pf_client_id'],
        'otp'=>$otp
        );  
}
echo json_encode($result);

?>