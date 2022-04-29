<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";


$app = $db->query("SELECT * FROM `register` WHERE  guid = '".$_GET['tempuserid']."'  ")->fetch();

if($app['guid']!=''){
if($app['mobile_status'] =='Verified' && $app['status'] =='Approved' && $app['approval_status'] =='Approved' && $app['aadhar_status'] =='Verified' && $app['pan_status'] =='Verified'){
    
$result = 'Approved';    
}else if($app['mobile_status'] =='Verified' && $app['status'] =='Approved' && $app['aadhar_status'] =='Verified' && $app['pan_status'] =='Verified' && $app['approval_status'] =='Pending'){

$result = 'Approval Pending';    
}else if($app['mobile_status'] =='Verified' && $app['status'] =='Approved' && $app['aadhar_status'] =='Verified' && $app['pan_status'] =='Verified' && $app['approval_status'] =='Rejected'){

$result = 'Rejected'; 
}else if($app['mobile_status'] =='Verified' && $app['status'] =='Pending' && $app['aadhar_status'] =='Verified' && $app['pan_status'] =='Verified' && $app['approval_status'] =='Pending'){

$result = 'Employement'; 
}else if($app['mobile_status'] =='Verified' && $app['aadhar_status'] =='Pending' && $app['pan_status'] =='Pending'){

$result = 'Verified';    

}else if($app['mobile_status'] =='Pending' && $app['status'] =='Pending' && $app['approval_status'] =='Pending'){

$result = 'Register';    

}else{
    
  $result = 'Register';   
}
}else{
    
 $result = 'Register';  
 

}

echo json_encode($result);

//echo "0";exit;
?>