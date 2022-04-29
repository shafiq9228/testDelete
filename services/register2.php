<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_POST);

 
      
      
$data = $db->query("SELECT * FROM register WHERE   guid = '".$tempuserid."'   ");

if($info = $data->fetch()) {
    
    
    
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
            
    $sql = $db->query("UPDATE register SET image = '" . $f . "'  WHERE  guid = '".$info['guid']."' ");

            
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
            
    $sql = $db->query("UPDATE register SET pancard = '" . $f . "'  WHERE  guid = '".$info['guid']."'");

            
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
            
    $sql = $db->query("UPDATE register SET aadharfront = '" . $f . "'  WHERE  guid = '".$info['guid']."' ");

            
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
            
    $sql = $db->query("UPDATE register SET aadharback = '" . $f . "'  WHERE  guid = '".$info['guid']."'");

            
}

if($_POST['bank']!='undefined') {
	        $img = $_POST['bank'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid."bank.jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET bank_stmt = '" . $f. "',bank = '" . $bank. "'  WHERE  guid = '".$info['guid']."' ");

            
}
if($_POST['payslip']!='undefined') {
	        $img = $_POST['payslip'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid."payslip.jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET pay_slip = '" . $f . "'  WHERE  guid = '".$info['guid']."' ");

            
}
//$data1 = $db->query("UPDATE register SET panno ='".$_POST['panno']."' ,pan_name= '".$_POST['pan_name']."',emp_status = '".$_POST['emp_status']."' WHERE guid = '".$info['guid']."'");


    
$response = $info['guid'];

}else {
//	echo "Error";
 $response= "Error";         
}

 echo json_encode( $response);


?>