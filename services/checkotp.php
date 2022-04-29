<?php  header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_POST);

$data = file_get_contents("php://input");

    if (isset($data)) {

        $request = json_decode($data);

        $tempuserid = $request->tempuserid;

        $otp = $request->otp;

                }
  
  
      
 
$data = $db->query("SELECT * FROM register WHERE  guid = '".$_POST['tempuserid']."' AND otp = '".$_POST['otp']."'  ");

if($app = $data->fetch()) {
    
$postad = $db->query("UPDATE register SET mobile_status = 'Verified'  WHERE guid = '".$app['guid']."'");


if($app['status'] =='Approved' && $app['approval_status'] =='Approved'){
    
$result = 'Approveddelli'.$app['guid'];

}else if($app['status'] =='Approved' && $app['approval_status'] =='Pending'){

$result = 'Approval Pending';    
}else if($app['status'] =='Approved' && $app['approval_status'] =='Rejected'){

$result = 'Rejected';   
}else if($app['status'] =='Pending' && $app['approval_status'] =='Pending'){

$result = 'Verifieddelli'.$app['guid'];    

}
//$response= "Verified";
}
else {
  
 $result= "Error";         
}

 echo json_encode($result);


?>