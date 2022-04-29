<?php  header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_POST);

$datetime = date('Y-m-d h:i:s');

$data = file_get_contents("php://input");

    if (isset($data)) {

        $request = json_decode($data);

        $tempuserid = $request->tempuserid;

        $otp = $request->otp;

                }
  
  
      
 
$data = $db->query("SELECT * FROM register WHERE  guid = '".$_POST['tempuserid']."' AND otp = '".$_POST['otp']."'  ");

if($app = $data->fetch()) {
    
$postad = $db->query("UPDATE register SET mobile_status = 'Verified'  WHERE guid = '".$app['guid']."'");


$sth = $db->query("INSERT INTO user_logs (`userid`,`datetime`,`deviceid`,`regid`) VALUES ('".$app['guid']."','$datetime','".$app['deviceid']."','".$app['regid']."')");
   
//$result = 'Approveddelli'.$app['guid'];


 $result = array(
                    'status' => true,
                    'aadhar_status' => $app['aadhar_status'],
                    'pan_status' => $app['pan_status'],
                    'register_status' => $app['status'],
                    'approval_status' => $app['approval_status'],
                    'userid' => $app['guid']
                    );

//$response= "Verified";
}else {
    
$result = array(
                    'status' => false,
                    'message' => 'Invalid otp',
                    'otp'=>$_POST['otp']
                    );   
}

 echo json_encode($result);


?>