<?php  header("Access-Control-Allow-Origin: *");
include_once 'config.php';


$data = $db->query("DELETE FROM customer_notif WHERE guid = '".$_GET['guid']."'  ");
if($data) {
	echo json_encode("Message deleted");
}