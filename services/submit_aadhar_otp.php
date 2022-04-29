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

        $otp = $request->aadharotp;

                }

$reg = $db->query("SELECT * FROM `register`  where guid = '".$tempuserid."' ")->fetch();




$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://kyc-api.aadhaarkyc.io/api/v1/aadhaar-v2/submit-otp',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"client_id": "'.$reg['aadhar_client_id'].'",
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
    
    
    
    if($arr['data']['profile_image']!='') {
        
	        /*$img = $arr['data']['profile_image'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$tempuserid."aadharimage.jpg";
            $file = "../cw_admin/uploads/".$f;
            //$filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data); */
            
            
            
            // Obtain the original content (usually binary data)
$bin = base64_decode($arr['data']['profile_image']);

// Load GD resource from binary data
$im = imageCreateFromString($bin);

// Make sure that the GD library was able to load the image
// This is important, because you should not miss corrupted or unsupported images
if (!$im) {
  die('Base64 value is not a valid image');
}

// Specify the location where you want to save the image
//$img_file = '/files/images/filename.png';

$f = date("YmdshiA").$tempuserid."aadharimage.png";
$img_file = "../cw_admin/uploads/".$f;
// Save the GD resource as PNG in the best possible quality (no compression)
// This will strip any metadata or invalid contents (including, the PHP backdoor)
// To block any possible exploits, consider increasing the compression level
imagepng($im, $img_file, 0);

$sql = $db->query("UPDATE register SET aadhar_image = '" . $f . "'  WHERE  guid = '$tempuserid' ");

            
}


$address = $arr['data']['address']['house'].','.$arr['data']['address']['street'].' '.$arr['data']['address']['po'].','.$arr['data']['address']['dist'].','.$arr['data']['address']['state'];

$sql = $db->query("UPDATE register SET aadhar_status = 'Verified',aadhar_fullname = '".$arr['data']['full_name']."',dob = '".$arr['data']['dob']."',aadhar_dob ='".$arr['data']['dob']."' ,aadhar_gender = '".$arr['data']['gender']."',aadhar_zip='".$arr['data']['zip']."',care_of = '".$arr['data']['care_of']."',aadhar_address = '".$address."',aadhar_response =  '$response',gender = '".$arr['data']['gender']."'  WHERE  guid = '".$tempuserid."' ");



    $result  = array(
        'status'  => true,
        'message' =>'Aadhar verified'
        ); 
        
}else{
    
   $result  = array(
        'status'  => false,
        'message' =>'Aadhar verification failed',
        'otp'=>$otp
        );  
}
echo json_encode($result);

?>