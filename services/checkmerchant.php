<?php  header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_POST);

extract($_GET);
 
$data = $db->query("SELECT * FROM merchants WHERE  mobile = '".$mobile."' and status = 'Active' ");

if($info = $data->fetch()) {
    
$response = $info['guid'];
}
else {
  
 $response = "0";         
}

 echo json_encode( $response);


?>