<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_POST);

$data = file_get_contents("php://input");

if (isset($data)) {
$request = json_decode($data);
$username = $request->username;
}

$username = stripslashes($username);

$data = $db->query("SELECT * FROM register WHERE  email='".$username."' ");
if($info = $data->fetch()) {
    
include "sendpassword.php";  
    
    
    
$response[] = $info['guid'];
echo json_encode($response);exit;
} else {
 $response[] = 0;
 echo json_encode($response);exit;
    
}




