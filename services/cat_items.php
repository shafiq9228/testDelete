<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


$sql = $db->query("SELECT products.guid as guid,products.pname as itemname,restaurents.rname as rest_name,products.price,products.description,products.image,main_category.name as category,products.type as itemtype,main_category.guid as categoryguid FROM products inner join restaurents on restaurents.guid = products.cid inner join main_category on main_category.guid = products.menuid WHERE cid='" .$_GET['restaurant']. "'  order by guid desc");
$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
    
    //$sql12 = $db->query("SELECT *  FROM main_category  WHERE guid='" .$row['menuid']. "' order by name asc");
    
    
        $emparray[] = $row;

 } 
 
echo json_encode($emparray);
}else{ echo "error";exit; }