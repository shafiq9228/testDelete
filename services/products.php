<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
extract($_POST);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


$sql = $db->query("SELECT products.guid, products.name,products.image1,products.price,products.discount,brands.name as brand,models.name as model FROM products LEFT JOIN cart on products.guid = cart.product and cart.refid = '".$userid."' LEFT JOIN brands on brands.guid = products.brand LEFT JOIN models on models.guid = products.model where brands.vehicle = '".$_GET['category']."'   order by products.guid asc ");

//$sql = $db->query("SELECT acc_products.guid, acc_products.product_name,acc_products.image,acc_products.offer_price,acc_products.discount,acc_products.brand_id,acc_products.model_id,acc_products.type_id,brands.name as brand,models.name as model,types.name as type FROM acc_products LEFT JOIN cart on acc_products.guid = cart.product and cart.refid = '".$userid."' INNER JOIN brands on brands.guid = acc_products.brand_id INNER JOIN models on models.guid = acc_products.model_id INNER JOIN types on types.guid = acc_products.type_id  where brands.vehicle = '".$_GET['category']."'   order by acc_products.guid asc ");


$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
        $emparray[] = $row;

 } 
 
echo json_encode($emparray);
}