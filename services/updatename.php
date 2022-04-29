<?php  header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
extract($_POST);

//print_r($_GET);exit;
$date = date('Y-m-d');
include_once 'config.php';



$resource = $db->query("UPDATE register SET name = '" . $name . "' WHERE  guid = '$userid' ");


if($resource){
  
$response= "Success";         
    
} else {
    
    
$response= "Error";    
}

echo json_encode( $response);



?>