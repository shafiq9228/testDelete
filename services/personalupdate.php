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
//print_r($_POST['file']);exit;
if($_POST['image']!="" or $_POST['image']!=null) {
	        $img = $_POST['image'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $f = date("YmdshiA").$userid.".jpg";
            $file = "../cw_admin/uploads/".$f;
            $filename = compress_image($f, $file, 80);

            $success = file_put_contents($file, $data);
            
    $sql = $db->query("UPDATE register SET image = '" . $f . "'  WHERE  guid = '$userid' ");

            
}

$resource = $db->query("UPDATE register SET name = '" . $name . "',email = '" . $email . "',mobile = '" . $mobile . "',dob = '" .date('Y-m-d',strtotime($dob)) . "',gender = '" . $gender . "',address =  '" . $address. "'   WHERE  guid = '$userid' ");


if($resource){
  
$response= "Success";         
    
} else {
    
    
$response= "Error";    
}

echo json_encode( $response);



?>