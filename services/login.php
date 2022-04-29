<?php  header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_POST);

 $data = file_get_contents("php://input");

    if (isset($data)) {

        $request = json_decode($data);

        $username = $request->username;

        $password = $request->password;

                }
  
  
      $username = stripslashes($username);

      $password = stripslashes($password);
      
      
$data = $db->query("SELECT * FROM register WHERE  (email='".$username."' OR mobile = '".$username."' ) AND password='".$password."' AND status='Approved' and mobile_status = 'Verified' and approval_status = 'Approved' ");
if($info = $data->fetch()) {
$data1 = $db->query("UPDATE register SET deviceid='".$_GET['deviceid']."' , regid='".$_GET['regid']."' WHERE guid='".$info['guid']."'");

//$resource = $db->query("UPDATE cart SET loginid = '" . $info['guid'] . "' WHERE tempcartid= '".$tempcartid."' AND loginid=0"); 
    
    
$response = $info['guid'];

 
	     //$response= "Your Login success";
}
else {
//	echo "Error";
 $response= "Your Login Mobile or Password is invalid";         
}

 echo json_encode( $response);


?>