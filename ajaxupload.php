<?php 
	include 'conn.php';
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
	$path = 'uploads/'; // upload directory
	if(!empty($_FILES['file']))
	{
		$img = $_FILES['file']['name'];
		$tmp = $_FILES['file']['tmp_name'];
		// get uploaded file's extension
		$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
		// can upload same image using rand function
		$final_image = rand(1000,1000000).$img;
		// check's valid format
		if(in_array($ext, $valid_extensions)) 
		{ 
			$path = $path.strtolower($final_image); 
			if(move_uploaded_file($tmp,$path)) 
			{
				
				//insert form data in the database
				$insert = $conn->query("INSERT images (name,position) VALUES ('".$final_image."','1')");

				if ($insert) {

					$sql = "SELECT * FROM `images` ORDER BY id DESC LIMIT 1";
					$result = $conn->query($sql);

		  			if ($result->num_rows > 0) {
					  // output data of each row
					  $row = $result->fetch_assoc();
					  $id = $row["id"];

					  $update = $conn->query("UPDATE `images` SET `position`='".$id."' WHERE  `id`='".$id."' ");

					  $path = $row["name"];

					  $array = array('id'=> $id, 'path' => $path );
					  // print_r($array);
					  echo (json_encode($array));

					} 
					
				}else{
					echo "error";
				}
			}
		} 
		else 
		{
		echo 'invalid';
		}

	}


?>