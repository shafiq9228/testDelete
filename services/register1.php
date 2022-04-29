<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_GET);

 
extract($_POST);     
      
$data = $db->query("SELECT * FROM register WHERE   guid = '".$tempuserid."'   ");

if($info = $data->fetch()) {
    


$data1 = $db->query("UPDATE register SET panno ='".$_GET['panno']."' ,pan_name= '".$_GET['pan_name']."',emp_status = '".$_GET['emp_status']."',name= '".$_GET['name']."',email = '".$_GET['email']."' ,gender = '".$_GET['gender']."',pincode = '".$_GET['pincode']."',dob = '".$_GET['dob']."',city = 'Hyderabad',address = '".$_GET['address']."',aadharno = '".$_GET['aadharno']."' WHERE guid = '".$info['guid']."'");


    
$response = $info['guid'];

}else {
//	echo "Error";
 $response= "Error";         
}

 echo json_encode( $response);


?>