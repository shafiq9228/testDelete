<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
include_once 'config.php';


$sql = $db->query("SELECT guid,merchantname,paidby,mobile,amount,message,status,DATE_FORMAT(datetime,'%d %b %Y') as date,transid,number,type,number,logo,status_message,service,fkey FROM transactions  where userid = '" . $userid . "' and status!='Pending' order by guid desc limit 0,15");
	
$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
        $emparray[] = $row;

 } 
 
echo json_encode($emparray);
}else{ echo "error";exit; }