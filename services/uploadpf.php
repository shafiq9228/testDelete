<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require "config.php";

extract($_POST);

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
        $errors = [];
        $path = 'test/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];

        $all_files = count($_FILES['files']['tmp_name']);  
            $file_tmp = $_FILES['files']['tmp_name'][0];
            $file_type = $_FILES['files']['type'][0];
            $file_size = $_FILES['files']['size'][0];
            $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][0])));
            $file_name = uniqid().".".$file_ext;
            $file = $path . $file_name;
            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file);
            }
        if ($errors) print_r($errors);
    }
} */


 $filename=stripslashes($_FILES['file']['name']);
	
				
	$uploadfile = move_uploaded_file($_FILES['file']['tmp_name'],"test/".$filename);
			
	  if($uploadfile){
	      
	      echo "uploaded";
	      
		} else {
		    
			$image='';	
			
		}	