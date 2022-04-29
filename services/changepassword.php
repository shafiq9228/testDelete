<?php 
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
$date = date('Y-m-d');
include_once 'config.php';

$user_id=$_GET['user_id'];


$sql= "UPDATE register SET password= '" . $password . "' WHERE guid=$user_id";


$resource123 = $db->query($sql);


if($resource123){
    
echo 1;exit;    
    
} else {
    
    
  echo 0;exit;  
    
}


?>