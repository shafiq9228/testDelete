<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


$sql = $db->query("SELECT *  FROM cities   order by name asc");
	
$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
    
   $chk = $db->query("SELECT *  FROM areas where city = '".$row['city']."'   ")->rowCount();
 if($count > 0){
        $emparray[] = $row;

 } }
 
echo json_encode($emparray);
}else{ echo "error";exit; }