<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_GET);
extract($_POST);

$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


$data = file_get_contents("php://input");

    if (isset($data)) {

        $request = json_decode($data);

        $tempuserid = $request->tempuserid;

        $pan_fullname = $request->pan_fullname;
        $dob = $request->dob;

                }

//$reg = $db->query("SELECT * FROM `register`  where guid = '".$tempuserid."' ")->fetch();


  
    
    
$sql = $db->query("UPDATE register SET pan_fullname = '".$pan_fullname."' WHERE  guid = '".$tempuserid."' ");

if($sql){
    $result  = array(
        'status'  => true,
        'message' =>'Pancard is verified'
        ); 
        
}else{
    
   $result  = array(
        'status'  => false,
        'message' =>'Something went wrong'
        );  
}
echo json_encode($result);

?>