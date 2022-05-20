<?php  

	error_reporting(0);
	
     if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        $allowedExtensions = array("xls","xlsx");
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		
        if(in_array($ext, $allowedExtensions)) {
				// Uploaded file
               $file = "uploads/".$_FILES['file']['name'];
               $isUploaded = copy($_FILES['file']['tmp_name'], $file);
			   // check uploaded file
               if($isUploaded) {
					// Include PHPExcel files and database configuration file
                    include("conn.php");
					require_once __DIR__ . '/lib2/vendor/autoload.php';
                    include(__DIR__ .'/lib2/vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');
                    try {
                        // load uploaded file
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                    } catch (Exception $e) {
                         die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
                    }
                    
                    // Specify the excel sheet index
                    $sheet = $objPHPExcel->getSheet(0);
                    $total_rows = $sheet->getHighestRow();
					$highestColumn      = $sheet->getHighestColumn();	
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);		
					
					//	loop over the rows
					for ($row = 1; $row <= $total_rows; ++ $row) {
						for ($col = 0; $col < $highestColumnIndex; ++ $col) {
							$cell = $sheet->getCellByColumnAndRow($col, $row);
							$val = $cell->getValue();
							$records[$row][$col] = $val;
						}
					}
					$html="";
					foreach($records as $key => $row){
						// HTML content to render on webpage
						// echo $key;	
						
						if ($key == 1) {
							# code...
						}else{
							$html.="<tr>";
							$name = isset($row[0]) ? $row[0] : '';
							$age = isset($row[1]) ? $row[1] : '';
							$gender = isset($row[2]) ? $row[2] : '';
							$phone = isset($row[3]) ? $row[3] : '';
							$city = isset($row[4]) ? $row[4] : '';
							$date = isset($row[5]) ? $row[5] : '';
							$html.="<td>".$name."</td>";
							$html.="<td>".$age."</td>";
							$html.="<td>".$gender."</td>";
							$html.="<td>".$phone."</td>";
							$html.="<td>".$city."</td>";
							$html.="<td>".$date."</td>";
							$html.="</tr>";
							// echo gettype($age);die();
							// if (gettype($name) == string ) {
							// 	echo "string";
							// 	if (gettype($age) == numbers ) {
							// 		echo "nuber";
							// 		if (gettype($gender) == 'string' ) {
							// 			if (gettype($phone) == 'string' ) {
							// 				if (gettype($city) == 'string' ) {
							// 					if (gettype($date) == 'string' ) {
													
							// 					}	
							// 				}
							// 			}	
							// 		}	
							// 	}	
							// }


							// Insert into database
							$query = "INSERT INTO data (name,age,gender,phone,city,date) 
									values('".$name."','".$age."','".$gender."','".$phone."','".$city."','".$date."')";
							// $mysqli->query($query);	
							$result = $conn->query($query);	
						}
						
					}
					$html.="";
					echo $html;
				
                    unlink($file);
                } else {
                    echo '<span class="msg">File not uploaded!</span>';
                }
        } else {
            echo '<span class="msg">Please upload excel sheet.</span>';
        }
    } else {
        echo '<span class="msg">Please upload excel file.</span>';
    }
?>