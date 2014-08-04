<?php require_once 'core/init.php'; 
$user = new User();
echo ' File upload';
if(!$user->isLoggedIn()) {
	echo 'Only members can acess this page';
	exit;
}
if(isset($_FILES['file'])){
	$file = $_FILES['file'];
	
	//File properties
	$file_name = $file['name'];
	$file_tmp = $file['tmp_name'];
	$file_size = $file['size'];
	$file_error = $file['error'];
	
	//Work out file extension
	$file_ext = explode('.', $file_name);
	$file_ext = strtolower(end($file_ext));
	
	$allowed = array('txt', 'jpg', 'png','pdf',	'docx', 'doc', 'xlsx','pdf', 'pptx'); 
	
	if(in_array($file_ext, $allowed)){
		echo 'array allowed<br/>';
		if($file_error === 0) {
			echo 'no file error<br/>';
			if($file_size <= 2097152) {
				echo 'file size OK<br/>';
				
				$file_name_new = uniqid('',true) . '.' . $file_ext;
				$file_destination = 'uploads/' . $file_name_new;
				
				if (function_exists('move_uploaded_file')) { 
    				echo "move_uploaded_file function is available.<br />\n"; 
					} else { 
 					echo "move_uploaded_file function is not available.<br />\n"; 
					} 

				
				if(move_uploaded_file($file_tmp, $file_destination)) {
					echo $file_destination;
				}else{
				echo 'Error:4 move uploded file wrong';
				}
			}else{
			echo 'Error: 3 file size';
			}
		}else{
		 echo 'Error: 2 if file error === 0';
		}
	}else {
		echo'Error: 1 if in array';
	}
}else{
echo 'Error: if not set';	
}
?>