<?php 

header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
date_default_timezone_set('Asia/Kolkata');

$date = date('Y-m-d');

$today = date('d-M-Y');

$fm = date('m-Y');
include_once 'config.php';

$user_id=$_GET['userid'];

$total_generated = $db->query("SELECT sum(total) as total,sum(waiveoff) as waiveoff FROM `bills`  where userid = '".$userid."' and status = 'Pending' ")->fetch();

$dt = $db->query("SELECT * FROM `bills`  where userid = '".$userid."' and status = 'Pending' order by guid desc ")->fetch();

//echo $dt[duedate];exit;
$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit' ")->fetch();

$tb_s = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit' and bill_status = '0' ")->fetch();


$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit' ")->fetch();

$tcb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback' and bill_status = '0' ")->fetch();

$b = $db->query("SELECT sum(interest) FROM `interest`  where userid = '".$userid."' and status = 'Pending' ")->fetch();

$bp = $db->query("SELECT sum(interest) FROM `interest`  where userid = '".$userid."' and status = 'Paid' ")->fetch();

$m = $db->query("SELECT * FROM `merchants`  where guid = '".$_GET['merchant']."' ")->fetch();

$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ")->fetch();



$int = $db->query ("SELECT sum(interest) FROM `interest` where status = 'Pending' and bill = '".$dt['guid']."' ")->fetch();

$total = $total_generated['total']+$int[0];
$nettotal = round($total_generated['total']+$int[0]-$total_generated['waiveoff']);
						

						
$billcredit = ($reg['credit']+$tc[0])-$tb[0]-$bp[0]+$tcb[0]; /* after bill credit balance */

$credit = $reg['credit']-$tb_s[0]+$tcb[0];   /* before bill credit balance */

$total = round($tb_s[0]-$tcb[0]);

$spent = abs($tc[0]-$tb[0]-$bp[0]+$tcb[0]);

$duedate = date('d-m-Y',strtotime($dt[duedate]));

$todate = date('d-m-Y',strtotime($dt[todate]));


$generated_spent = round($total_generated['total']+$int[0]-$total_generated['waiveoff']+$total);

if($dt['guid']!=''){
        
if($tb_s[0] > 0){
$unbilled =  $tb_s[0]+$nettotal; 
}else{ $unbilled = '0';}
    
 $resource = $db->query("SELECT $reg[credit] as balance,$nettotal as spent,$generated_spent as totalspent,'$duedate' as duedate,'$todate' as todate,'$today' as today,register.credit,register.name,register.mobile,register.email,register.image,$unbilled as unbilled,$dt[guid] as billid FROM `register`  WHERE register.guid = '" . $userid . "'   ");   

}else{
    

$resource = $db->query("SELECT $reg[credit] as balance,$total as spent,$total as totalspent,register.credit,'$today' as today,register.name,register.mobile,register.email,register.image,$total as unbilled FROM `register`  WHERE register.guid = '" . $userid . "'   ");   
     
}
$result=$resource->fetch();


echo json_encode($result);
?>
