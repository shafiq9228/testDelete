<?php 

header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
date_default_timezone_set('Asia/Kolkata');

$date = date('Y-m-d');

$fm = date('m-Y');
include_once 'config.php';

$user_id=$_GET['userid'];

$dt = $db->query("SELECT * FROM `bills`  where userid = '".$userid."' and status = 'Pending' order by guid desc ")->fetch();


$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit' ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit' ")->fetch();

$b = $db->query("SELECT sum(interest) FROM `interest`  where userid = '".$userid."' and status = 'Pending' ")->fetch();

$m = $db->query("SELECT * FROM `merchants`  where guid = '".$_GET['merchant']."' ")->fetch();

$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ")->fetch();

$credit = ($reg['credit']+$tc[0])-$tb[0];

$total = $tb[0]+$b[0]-$tc[0];

$spent = abs($tc[0]-$tb[0]);

$duedate = '03-'.$fm;

echo $fm;exit;
if($dt['guid']!=''){
        
    
 $resource = $db->query("SELECT $credit as balance,$total as spent,$dt[duedate] as duedate,register.credit,register.name,register.mobile,register.email FROM `register`  WHERE register.guid = '" . $userid . "'   ");   

}else{
    
     $resource = $db->query("SELECT $credit as balance,$total as spent,$fm as duedate,register.credit,register.name,register.mobile,register.email FROM `register`  WHERE register.guid = '" . $userid . "'   ");   
     
}
$result=$resource->fetch();


echo json_encode($result);
?>
