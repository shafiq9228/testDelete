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

        $aadharno = $request->aadharno;

                }

$reg = $db->query("SELECT * FROM `register`  where guid = '".$tempuserid."' ")->fetch();

$chk = $db->query("SELECT * FROM `register`  where aadharno = '$aadharno' and aadhar_status = 'Verified' ")->rowCount();

if($chk == 0){
    
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://kyc-api.aadhaarkyc.io/api/v1/aadhaar-v2/generate-otp',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"id_number":  "'.$aadharno.'"
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
    
    
    $sql = $db->query("UPDATE register SET aadhar_client_id = '".$arr[data][client_id]."',aadhar_status = 'Pending',aadharno = '$aadharno'  WHERE  guid = '".$tempuserid."' ");


    $result  = array(
        'status'  => true,
        'client_id'=>$arr[data][client_id],
        'message' =>'OTP sent to your registered mobile no'
        ); 
        
}else{
    
   $result  = array(
        'status'  => false,
        'aadharno'=>$aadharno,
        'message' =>$arr['message']
        );  
}

}else{
    
   $result  = array(
        'status'  => false,
        'message' =>'Aadhar no is already used'
        );    
    
}
echo json_encode($result);

?>