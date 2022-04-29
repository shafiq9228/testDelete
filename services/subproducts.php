<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';

//$c = $db->query("SELECT *  FROM subcategory where category = '".$category."' order by guid asc ")->fetch();

//$sql = $db->query("SELECT *  FROM products where category = '".$category."' order by guid asc ");
//$sql = $db->query("SELECT products.guid, products.name as name,products.image as image,products.units as units,products.mrp as mrp,products.price as price,products.discount as discount,cart.quantity as quantity  FROM products LEFT JOIN cart on products.guid = cart.product and cart.refid = '".$userid."' where products.category = '".$category."'  order by products.guid asc ");

if($areaid =='' || $areaid == null || $areaid ==0){

$sql = $db->query("SELECT products.guid, products.name as name,products.subcategory as subcategory,products.image as image,products.units as units,products.mrp as mrp,products.price as price,products.discount as discount,cart.quantity as quantity,products.status  FROM products LEFT JOIN cart on products.guid = cart.product and cart.refid = '".$userid."' where products.subcategory = '".$subcategory."'  order by products.guid asc ");

}else{
    
    $sql = $db->query("SELECT products.guid, products.name as name,products.subcategory as subcategory,products.image as image,products.units as units,products.mrp as mrp,products.price as price,products.discount as discount,cart.quantity as quantity,product_areas.area,products.status  FROM products LEFT JOIN cart on products.guid = cart.product and cart.refid = '".$userid."' INNER JOIN product_areas on product_areas.product_id = products.guid   where products.subcategory = '".$subcategory."' and  product_areas.area = '$areaid'  order by products.guid asc ");
    
    
}
$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
        $emparray[] = $row;

 } 
 
echo json_encode($emparray);
}