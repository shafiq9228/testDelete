<?php  header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_POST);


extract($_GET);

  
      
 
$data = $db->query("SELECT * FROM register WHERE  guid = '".$tempuserid."'   ");

if($app = $data->fetch()) {
    
$postad = $db->query("UPDATE register SET status = 'Approved'  WHERE guid = '".$app['guid']."'");


    
$result = array(
                    'status' => true,
                    'userid' => $app['guid'],
                    'message' => 'Kyc completed'
                    );

//$response= "Verified";
}else {
    
$result = array(
                    'status' => false,
                    'message' => 'Something went wrong'
                    );   
}

 echo json_encode($result);


?>