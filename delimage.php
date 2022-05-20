<?php 
	include 'conn.php';
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
	$path = 'uploads/'; // upload directory
	if(!empty($_POST['id']))
	{
		$id = $_POST['id'];
		
		$insert = $conn->query("DELETE FROM `images` WHERE `id` = '".$id."' ");
		if($insert){
			echo $id;
		}else{
			echo "error";
		}

	}


?>