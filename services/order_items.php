<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';

$sql = $db->query("SELECT order_items.guid as guid,products.guid as pid,products.name as name,TRUNCATE(order_items.price,2) as price,TRUNCATE(order_items.total,2) as total,order_items.quantity as quantity,products.image1,order_items.units as units  FROM order_items inner join products on products.guid = order_items.product WHERE order_items.userid='" .$_GET['user_id']. "' and od_id = '" .$_GET['orderid']. "' order by guid asc");
	
$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
        $emparray[] = $row;

 } 
 
echo json_encode($emparray);
}else{ echo "error";exit; }