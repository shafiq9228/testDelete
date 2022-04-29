<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_GET);

 
      
      
$data = $db->query("SELECT * FROM register WHERE   guid = '".$tempuserid."'    ");

if($info = $data->fetch()) {
    
$data1 = $db->query("UPDATE register SET pincode ='".$_GET['pincode']."' ,city = '".$_GET['city']."',area='".$_GET['area']."', address = '".$_GET['hno']."',status = 'Approved' WHERE guid = '".$info['guid']."'");


    
$response = $info['guid'];

}else {
//	echo "Error";
 $response= "Error";         
}

 echo json_encode( $response);


?>