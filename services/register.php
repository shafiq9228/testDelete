<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_GET);

 
extract($_POST);     
  
$user_id = 'DP'; //example from session variable
$cur_date = date('dmyHi'); //timestamp ticket submitted
$reg_num = '#'.$user_id.'-'. $cur_date;

$data = $db->query("SELECT * FROM register WHERE   guid = '".$tempuserid."'   ");

if($info = $data->fetch()) {
    


$data1 = $db->query("UPDATE register SET pan_name = '".$_GET['pan_name']."',emp_status = '".$_GET['emp_status']."',name = '".$_GET['name']."',email = '".$_GET['email']."' ,gender = '".$_GET['gender']."',pincode = '".$_GET['pincode']."',dob = '".$_GET['dob']."',city = 'Hyderabad',address = '".$_GET['address']."',status = 'Approved',reg_num = '$reg_num' WHERE guid = '".$info['guid']."'");


    
$response = $info['guid'];

}else {
//	echo "Error";
 $response= "Error";         
}

 echo json_encode( $response);


?>