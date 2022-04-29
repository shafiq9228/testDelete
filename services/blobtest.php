<?php  header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
extract($_POST);
//print_r($_GET);exit;
$date = date('Y-m-d');
include_once 'config.php';

$chk = $db->query("SELECT *  FROM register where guid = '1' ")->fetch();

$value = 'something from somewhere';

//setcookie("TestCookie", $value, time()+3600);  /* expire in 1 hour */

$cookie_name = "Mobile";
$cookie_value = '888';

setcookie($cookie_name, $cookie_value, time()+3600); // 86400 = 1 day

//echo $_COOKIE['$cookie_name'];exit;
echo $_COOKIE[mobile];
?>
<object data="data:application/pdf;base64,<?php echo base64_encode($chk['bank_stmt']) ?>" type="application/pdf" style="height:200px;width:60%"></object>


