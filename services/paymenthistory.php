<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
date_default_timezone_set('Asia/Kolkata');
include_once 'config.php';

 
$usersList_array =array();
$user_array = array();
$note_array = array();

//echo "SELECT DISTINCT(DATE_FORMAT(date,'%Y-%m')) as date FROM `transactions` where userid = '" . $userid . "' and status!='Pending'";exit;
$sql = $db->query("SELECT DISTINCT(DATE_FORMAT(date,'%Y-%m')) as date FROM `transactions` where userid = '" . $userid . "' and status!='Pending' order by date desc");

$count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 

    $user_array['monthandyear'] = date('M Y',strtotime($row['date']));
    //$user_array['month'] = $row['date'];

    $user_array['transactions'] = array();


   $var = $db->query("SELECT * FROM `transactions` where userid = '" . $userid . "' and status!='Pending' and DATE_FORMAT(date,'%Y-%m') = '".$row['date']."' order by guid desc");
   
  
while($vrow = $var->fetch()){ 
        //$variants[] = $vrow;

        $note_array['guid']=$vrow['guid'];
        $note_array['merchantname']=$vrow['merchantname'];
        $note_array['paidby']=$vrow['paidby'];
        $note_array['mobile']=$vrow['mobile'];
        $note_array['amount']=$vrow['amount'];
        $note_array['message']=$vrow['message'];
        $note_array['status']=$vrow['status'];
        $note_array['date']=$vrow['date'];
        $note_array['transid']=$vrow['transid'];
        $note_array['number']=$vrow['number'];
        $note_array['type']=$vrow['type'];
        $note_array['logo']=$vrow['logo'];
        $note_array['status_message']=$vrow['status_message'];
        $note_array['service']=$vrow['service'];
        $note_array['fkey']=$vrow['fkey'];
        array_push($user_array['transactions'],$note_array);
 } 
 
     array_push($usersList_array,$user_array);


 } 
 
$jsonData = json_encode($usersList_array, JSON_PRETTY_PRINT);


echo $jsonData; 

     
}else{
    
     $response = array(
                    'status' => false,
                    'message' => 'No transactions found'
                    );
    echo json_encode($response);
}