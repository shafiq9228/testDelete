<?php  header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
$date = date('Y-m-d');
include_once 'config.php';

$userid=$_GET['userid'];
$qty = $_GET['quantity'];
$guid = $_GET['guid'];

$sql123= "UPDATE cart SET quantity= '" . $qty . "',total = price * '$qty'  WHERE guid= '$guid' and refid = '$userid' ";
$resource123 = $db->query($sql123);


if($resource123){
  
$c = $db->query("SELECT sum(total)  FROM cart  WHERE refid='" .$userid. "'  order by guid asc")->fetch();    
echo json_encode($c[0]);exit;    
    
} else {
    
    
  echo 0;exit;  
    
}


?>