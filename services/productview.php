<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
extract($_POST);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


//$sql = $db->query("SELECT acc_products.guid, acc_products.product_name,acc_products.image,acc_products.offer_price,acc_products.discount,brands.name as brand,models.name as model,types.name as type,acc_products.description ,cart.quantity FROM acc_products LEFT JOIN cart on acc_products.guid = cart.product and cart.refid = '".$userid."' LEFT JOIN brands on brands.guid = acc_products.brand_id INNER JOIN models on models.guid = acc_products.model_id INNER JOIN types on types.guid = acc_products.type_id  where acc_products.guid = '".$_GET['product']."'    ");




$sql = $db->query("SELECT products.guid, products.name,products.image1,products.image2,products.image3,products.image4,products.mrp,products.price,products.discount,brands.name as brand,models.name as model,category.name as catname,subcategory.name as subname,products.highlights,products.description,products.specifications,cart.quantity FROM products LEFT JOIN cart on products.guid = cart.product and cart.refid = '".$userid."' LEFT JOIN brands on brands.guid = products.brand LEFT JOIN models on models.guid = products.model LEFT JOIN category on category.guid = products.category  LEFT JOIN subcategory on subcategory.guid = products.subcategory where products.guid = '".$_GET['product']."' ");


$row = $sql->fetch();
//$emparray[] = $row;


 
echo json_encode($row);
