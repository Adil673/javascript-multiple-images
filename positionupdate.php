<?php  

	include 'conn.php';
     if(!empty($_POST['after']) && !empty($_POST['before']) ) {

     	$after = $_POST['after'];
     	$safter = $_POST['safter'];
     	$before = $_POST['before'];
     	$sbefore = $_POST['sbefore'];

     	
     	// echo "UPDATE `images` SET `position`='".$before."' WHERE  `position`='".$after."' ";
     	$update = $conn->query("UPDATE `images` SET `position`='".$before."' WHERE  `position`='".$after."' ");
     	if ($update) {
     		// echo "UPDATE `images` SET `position`='".$after."' WHERE  `id`='".$sbefore."' ";
     		$conn->query("UPDATE `images` SET `position`='".$after."' WHERE  `id`='".$sbefore."' ");
     		echo "okay";
     	}else{
     		echo "error";
     	}


    } else {
        echo '<span class="msg">Please upload excel file.</span>';
    }
?>