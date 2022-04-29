<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


$sql = $db->query("SELECT *  FROM brands where vehicle = '".$_GET['vehicle']."'   order by guid asc");
	
$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
        $emparray[] = $row;

 } 
 
echo json_encode($emparray);
}else{ echo "error";exit; }