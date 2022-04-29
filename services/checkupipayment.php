<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_GET);
extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


function random19() {
  $number = "";
  for($i=0; $i<19; $i++) {
    $min = ($i == 0) ? 1:0;
    $number .= mt_rand($min,9);
  }
  return $number;
}

$data = file_get_contents("php://input");


 if (isset($data)) {

        $request = json_decode($data);

        $userid = $request->userid;
        $json = $request->json;
        $serviceid = $request->serviceid;

$deviceid = $request->deviceid;
$regid = $request->regid;

                }
   
   
               
$reg = $db->query("SELECT * FROM `register`  where guid = '".$userid."' ")->fetch();

$ser = $db->query("SELECT * FROM `services`  where guid = '".$_GET['serviceid']."' ")->fetch();

$set = $db->query ("SELECT * FROM `settings` where guid = '1' ")->fetch();


$parts = parse_url($json);
parse_str($parts['query'], $query);

$upi_id = $query[pa];

$name =  $query[pn];




/*$a1 = explode("upi://pay?pa=",$json);

$upi = explode("&pn=",$a1[1]);
//print_r($upi);
$upi_id = $upi[0];

//echo $upi[1];
$upiname = explode("&",$upi[1]);

//echo $upiname[0];exit;
$name =  $upiname[0]; */
    
$uniqueid = rand(1000,9999);
 
 
$checkupi = $db->query ("SELECT * FROM `upi_payments` where upi = '".$upi_id."' and displaystatus = 'Inactive' ")->rowCount();

if($upi_id !=''){    


if($checkupi == 0){    
    
//this will collect data from form
$upi = $upi_id; 
$name = str_replace("%20"," ","$name"); 
$number = $reg['mobile'];
$amount = 0;
$email = $reg['email'];
//$remarks = $_GET['remarks'];

$agentid = "DPY".random19(); //(your system unique id. that you can check in Zuel pay);
//end of data collection from form

//echo "Name ".$name;exit;

$sql = $db->query("INSERT INTO upi_payments (`pincode`,`userid`,`upi`,`name`,`email`,`mobile`,`amount`,`charges`,`total`,`remarks`,`status`,`date`,`datetime`,`agentid`,`response`) VALUES ('$reg[pincode]','$userid','$upi','$name','$email','$mobile','$amount','$set[charges]','$total','$remarks','Pending','$date','$datetime','$agentid','$json')");
     
$rech_id = $db->lastInsertId();				
    


//$insid = $db->lastInsertId();


if($sql){


$result =  $rech_id;

}else{ $result = array(
                    'status' => false,
                    'message' => 'Something went wrong,please try again'
                    ); }

}else{ 	  $result = array(
                    'status' => false,
                    'message' => 'UPI ID is blocked'
                    );
                    }
}else{ $result = array(
                    'status' => false,
                    'message' => 'No upi is found'
                    );
                    }
echo json_encode($result);

?>