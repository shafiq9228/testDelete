<?php header("Access-Control-Allow-Origin: *");
require "config.php";
 $sql = $db->query("SELECT * FROM `address_list`  where userid = '".$_GET['userid']."' ORDER BY guid asc limit 0,5");
 $count = $sql->rowCount();
 if($count > 0){
while($row = $sql->fetch()){ 
        $emparray[] = $row;

 } 
 
$result = json_encode($emparray);
}else{ $result = "Error"; }

echo $result;exit;

?>