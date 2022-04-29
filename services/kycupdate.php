<?php  header("Access-Control-Allow-Origin: *");
ob_start();
error_reporting(0);
extract($_GET);
extract($_POST);
//print_r($_GET);exit;
$date = date('Y-m-d');
include_once 'config.php';



function compress_image($source_url, $destination_url, $quality) {

      $info = getimagesize($source_url);

          if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);

          elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);

          elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);

          imagejpeg($image, $destination_url, $quality);
          return $destination_url;

    
}

if($_POST['image']!='undefined') {
	        $img = $_POST['image'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid."selfie.jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET image = '" . $f . "',selfie =  '$_POST[image]'  WHERE  guid = '$userid' ");

            
}
//print_r($_POST['file']);exit;
if($_POST['pancard']!='undefined') {
	        $img = $_POST['pancard'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid."pancard.jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET pancard = '" . $f . "'  WHERE  guid = '$userid' ");

            
}
if($_POST['aadharfront']!='undefined') {
	        $img = $_POST['aadharfront'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid."aadharfront.jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET aadharfront = '" . $f . "'  WHERE  guid = '$userid' ");

            
}
if($_POST['aadharback']!='undefined') {
	        $img = $_POST['aadharback'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid."aadharback.jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET aadharback = '" . $f . "'  WHERE  guid = '$userid' ");

            
}

if($_POST['bank']!='undefined') {
	        $img = $_POST['bank'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid."bank_stmt.jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET bank_stmt = '" . $bank. "',bank = '" . $bank. "'  WHERE  guid = '$userid' ");

            
}
if($_POST['payslip']!='undefined') {
	        $img = $_POST['payslip'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid."pay_slip.jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET pay_slip = '" . $f . "'  WHERE  guid = '$userid' ");

            
}

$resource = $db->query("UPDATE register SET pan_name = '" . $panname . "',panno = '" . $panno . "',aadharno = '" . $aadharno . "'   WHERE  guid = '$userid'");


if($resource){
  
$response= "Success";         
    
} else {
    
    
$response= "Error";    
}

echo json_encode( $response);



?>