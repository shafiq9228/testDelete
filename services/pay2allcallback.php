<?php include_once 'config.php';
date_default_timezone_set('Asia/Kolkata'); 

$status_id=$_REQUEST['status_id'];
$utr=$_REQUEST['utr'];

$report_id=$_REQUEST['report_id'];

$client_id=$_REQUEST['client_id'];

$number=$_REQUEST['number'];

$message=$_REQUEST['message'];


$response=json_encode($_REQUEST);


$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


$resource = $db->query("INSERT IGNORE INTO `pay2allcallback`(`status_id`,`utr`,`report_id`, `client_id`,`number`,`message`,`response`) VALUES ('$status_id', '$utr', '$report_id','$client_id','$number','$message','$response' )");



if($status_id == '0' || $status_id == '1'){ //success


$day = date('d',strtotime($date));
$mon = date('m',strtotime($date));
$year = date('Y',strtotime($date));       
        
      			 	 	
$orderid = $day.$mon.$year;

  $bth = $db->query("SELECT * FROM transactions where status = 'Debit' ");
  $count = $bth->rowCount();
  //echo $count; exit;
  if($count > 0) {
    $sth = $db->query("SELECT MAX(guid) FROM transactions where status = 'Debit' ");
    $row = $sth->fetch();
    $dt=$row[0];
    $qry = $db->query("SELECT transid FROM transactions WHERE guid='$dt' and status = 'Debit' ");
    $rest = $qry->fetch();
        
    $d=substr($rest[0],13);
        $icc = $d+1;
    $val = $orderid."DPD00".$icc; 
    } else {
    $val = $orderid.'DPD001';
     } 

$sql = $db->query("UPDATE recharges SET transid = '" . $val . "',message = '".$message."',status = 'Debit',utr = '".$utr."',reportid = '".$report_id."', status_id='".$status_id."'  WHERE  client_id = '".$client_id."' ");


$postad = $db->query("UPDATE transactions SET transid = '" . $val . "',message = '".$message."',status = 'Debit',utr = '".$utr."',reportid ='".$report_id."' ,status_id = '".$status_id."',status_message = 'Success' WHERE  client_id = '".$client_id."' ");	

}else{
    
    
$day = date('d',strtotime($date));
$mon = date('m',strtotime($date));
$year = date('Y',strtotime($date));       
        
      			 	 	
$orderid = $day.$mon.$year;

  $bth = $db->query("SELECT * FROM transactions where status = 'Debit' ");
  $count = $bth->rowCount();
  //echo $count; exit;
  if($count > 0) {
    $sth = $db->query("SELECT MAX(guid) FROM transactions where status = 'Debit' ");
    $row = $sth->fetch();
    $dt=$row[0];
    $qry = $db->query("SELECT transid FROM transactions WHERE guid='$dt' and status = 'Debit' ");
    $rest = $qry->fetch();
        
    $d=substr($rest[0],13);
        $icc = $d+1;
    $val = $orderid."DPD00".$icc; 
    } else {
    $val = $orderid.'DPD001';
     } 

$sql = $db->query("UPDATE recharges SET transid = '" . $val . "',message = '".$message."',status = 'Failed',utr = '".$utr."',reportid = '".$report_id."', status_id='".$status_id."'  WHERE  client_id = '".$client_id."' ");


$postad = $db->query("UPDATE transactions SET transid = '" . $val . "',message = '".$message."',status = 'Failed',utr = '".$utr."',reportid ='".$report_id."' ,status_id = '".$status_id."',status_message = 'Failed' WHERE  client_id = '".$client_id."' ");
    
    
}
