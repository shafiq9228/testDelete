<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';



$sql = $db->query("SELECT cart.guid as guid,products.name as name,products.discount as discount,products.image1 as image,cart.quantity as quantity,cart.total as total,cart.price as price  FROM cart inner join products on products.guid = cart.product  WHERE refid='" .$userid. "'  order by guid asc");
	
$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
        $emparray[] = $row;

 } 
 
echo json_encode($emparray);
}else{ echo "error";exit; }