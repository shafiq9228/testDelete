<?php header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
//print_r($_GET);exit;
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$datetime=date('Y-m-d H:i:s');
include_once 'config.php';

          $user_id=$_GET['user_id'];
          $tempcartid=$_GET['tempcartid'];
	        //$use_id = BOKID; //example from session variable
			$cur_date = date('dmyHi'); //timestamp ticket submitted
			$reg_num = 'BRO'.$user_id.'_'. $cur_date;

        $address_id=$_GET['address_id'];
		 
$dc = $db->query("SELECT * FROM `delivery_charges` WHERE guid = '1' ")->fetch();



$add = $db->query("SELECT * FROM `address_list` WHERE  userid = '" . $user_id . "' and  guid  = '" . $address_id . "' ")->fetch();	
	
//$loc = $db->query("SELECT * FROM `locations` WHERE  guid  = '" . $_GET['areaid'] . "' ")->fetch();	

$chk = $db->query("SELECT sum(total),count(*) FROM `cart` WHERE   refid = '" . $user_id . "'   ")->fetch();	 

$delivery = $dc['price']; 

$total = $chk['0']+$delivery;

$sth = $db->query("INSERT INTO `orders`(`orderid`,`userid`,`address_id`,`name` ,`mobile` ,`address`,`items`,`sub_total`,`vat`,`shipping`,`total`,`odr_status`,`status`,`date`,`dateandtime`,`location`,`latitude`,`longitude`) VALUES ('" . $reg_num . "','" . $user_id . "','$address_id','" . $add['name'] . "','" . $add['mobile'] . "','" . $add['address'] . "','" . $chk['1'] . "','" . $chk['0'] . "','0','".$delivery."','" . $total . "','Pending','Pending','$date','$datetime','" . $add['location'] . "','" . $add['latitude'] . "','" . $add['longitude'] . "')");
	
		 $insert_id = $db->lastInsertId();
		 
    
    

	 if($sth==true){ 		 
			 
		  
                $c_th = $db->query("SELECT * FROM `cart` WHERE `refid`='".$_GET['user_id']."' and  refid !='0'  ");
              while($c_row = $c_th->fetch()) {
                
                  $ot_th = $db->query("INSERT INTO `order_items`(`od_id`, `orderid`,`userid`, `product`, `quantity`,`units`,`price`, `total`, `order_status`,`status`, `date`) VALUES ('$insert_id', '$orderid','$_GET[user_id]', '".$c_row['product']."','".$c_row['quantity']."', '".$c_row['units']."', '".$c_row['price']."', '".$c_row['total']."', 'Pending','Pending', '$date')");  
                  
                }
            
		  $response = $insert_id;
		 }else{
		  
		  $response = "Error";   
		 }
		 
echo json_encode($response);exit;
