<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


$sql = $db->query("SELECT guid,merchantname,paidby,mobile,amount,message,status,DATE_FORMAT(datetime,'%d-%m-%Y') as date,transid  FROM transactions  where userid = '" . $userid . "' and merchant = '" . $merchant . "' and status = 'Debit' order by guid desc limit 0,5");
	
$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
        $emparray[] = $row;

 } 
 
echo json_encode($emparray);
}else{ echo "error";exit; }