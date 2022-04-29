<?php  header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
extract($_POST);
//print_r($_GET);exit;
$date = date('Y-m-d');
include_once 'config.php';


$resource = $db->query("UPDATE register SET city = '" . $city . "',area = '" . $area . "',address = '" . $address. "',pincode = '" . $pincode . "',relationship1 ='".$_POST['relationship1']."' ,ref_mobile1 = '".$_POST['ref_mobile1']."',ref_name1='".$_POST['ref_name1']."', relationship2 = '".$_POST['relationship2']."',ref_mobile2 = '".$_POST['ref_mobile2']."',ref_name2 = '".$_POST['ref_name2']."'   WHERE  guid = '$userid' ");


if($resource){
  
$response= "Success";         
    
} else {
    
    
$response= "Error";    
}

echo json_encode( $response);



?>