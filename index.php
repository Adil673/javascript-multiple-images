<?php 
	include 'conn.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Hello, world!</title>
    <style type="text/css">
    	
    	html * {
		  box-sizing: border-box;
		}

		p {
		  margin: 0;
		}

		.upload {
		  &__box {
		    padding: 40px;
		  }
		  &__inputfile {
		    width: .1px;
		    height: .1px;
		    opacity: 0;
		    overflow: hidden;
		    position: absolute;
		    z-index: -1;
		  }
		  
		  &__btn {
		    display: inline-block;
		    font-weight: 600;
		    color: #fff;
		    text-align: center;
		    min-width: 116px;
		    padding: 5px;
		    transition: all .3s ease;
		    cursor: pointer;
		    border: 2px solid;
		    background-color: #4045ba;
		    border-color: #4045ba;
		    border-radius: 10px;
		    line-height: 26px;
		    font-size: 14px;
		    
		    &:hover {
		      background-color: unset;
		      color: #4045ba;
		      transition: all .3s ease;
		    }
		    
		    &-box {
		      margin-bottom: 10px;
		    }
		  }
		  
		  &__img {
		    &-wrap {
		      display: flex;
		      flex-wrap: wrap;
		      margin: 0 -10px;
		    }
		    
		    &-box {
		      width: 200px;
		      padding: 0 10px;
		      margin-bottom: 12px;
		    }
		    
		    &-close {
		        width: 24px;
		        height: 24px;
		        border-radius: 50%;
		        background-color: rgba(0, 0, 0, 0.5);
		        position: absolute;
		        top: 10px;
		        right: 10px;
		        text-align: center;
		        line-height: 24px;
		        z-index: 1;
		        cursor: pointer;

		        &:after {
		          content: '\2716';
		          font-size: 14px;
		          color: white;
		        }
		      }
		  }
		}

		.img-bg {
		  background-repeat: no-repeat;
		  background-position: center;
		  background-size: cover;
		  /*position: relative;*/
		  /*padding-bottom: 100%;*/
		   width: 150px;
    	height: 150px;
		}

    </style>
  </head>
  <body>

  	<div class="upload__box">
	  <div class="upload__btn-box">
	    <form id="myform" method="post" enctype="multipart/form-data" >
	    	<label class="upload__btn">
		      <p>Upload images</p>
		      <input type="file" id="myfile" name="file" data-max_length="20" class="upload__inputfile">
		    </label>
		    <div class="alert1"></div>
	    </form>
	  </div>
	  <div class="upload__img-wrap">
	  	<div class='upload__img-box d-flex columns'>
	  		<?php 

	  			$sql = "SELECT * FROM `images` WHERE status = '1'  ORDER BY position ASC ";
				$result = $conn->query($sql);

	  			if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
				    // echo "id: " . $row["id"]. " - Name: " . $row["name"];
				    ?>
				    	<div draggable="true" data-id="<?= $row["position"] ?>" data-sid="<?= $row["id"] ?>" style='background-image: url("uploads/<?= $row["name"] ?>");margin: 16px;' class='img-bg card'>
				  			<div class='upload__img-close'><i onclick="delimage(<?= $row["id"] ?>)" id="img_<?= $row["id"] ?>" class="fa fa-times-circle-o" aria-hidden="true" style="color: white;font-size: 24px;position: relative;float: right;" ></i></div>
				  		</div>
				    <?php
				  }
				} 
	  		?>
	  		
	  	</div>
	  </div>

	  <div class="upload__btn-box">
	    <form id="excleupload" method="post" enctype="multipart/form-data" >
	    	<label class="upload__btn">
		      <p>Upload Excel File</p>
		      <input type="file" id="excle" name="file" class="upload__inputfile1">
		    </label>
		    <div class="alerts"></div>
		    <table border='1' width="1000" align="center" id="mytable">
		    	<tr>
		    		<td>Name</td>
		    		<td>Age</td>
		    		<td>Gender</td>
		    		<td>Phone</td>
		    		<td>City</td>
		    		<td>date</td>
		    	</tr>
	    		<?php 

		  			$sql1 = "SELECT * FROM `data` ORDER BY id ASC ";
					$result1 = $conn->query($sql1);

		  			if ($result1->num_rows > 0) {
					  // output data of each row
					  while($row1 = $result1->fetch_assoc()) {
					    // echo "id: " . $row1["id"]. " - Name: " . $row1["name"];
					    ?>

					    <tr>
				    		<td><?= $row1["name"] ?></td>
				    		<td><?= $row1["age"] ?></td>
				    		<td><?= $row1["gender"] ?></td>
				    		<td><?= $row1["phone"] ?></td>
				    		<td><?= $row1["city"] ?></td>
				    		<td><?= $row1["date"] ?></td>
				    	</tr>
					    <?php
					  }
					} 
		  		?>
		    </table>
	    </form>
	  </div>
	</div>



	<script type="text/javascript">

		$(document).ready(function (e) {

		$('#myfile').on('change', function() 
 		{
 			$( "#myform" ).submit();
 		});

			
		$("#myform").on('submit',(function(e) {
		  e.preventDefault();
		  $.ajax({
		        url: "ajaxupload.php",
			    type: "POST",
			    data:  new FormData(this),
			    contentType: false,
		        cache: false,
		   		processData:false,
		   		beforeSend : function()
		   		{
		    		$("#err").fadeOut();
		   		},
		   		success: function(data)
		      	{
				    if(data=='error')
				    {
				     // invalid file format.
				     $("#err").html("Invalid File !").fadeIn();
				     $(".alert1").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Holy guacamole!</strong>Try Again<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); 
				    	$("#excleupload")[0].reset(); 
				    }
				    else
				    {
				    	const obj = JSON.parse(data);
				    	$(".alert1").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Holy guacamole!</strong>successfully inserted<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); 
				    	$("#excleupload")[0].reset(); 
				    	$('.upload__img-box').append("<div style='background-image: url(uploads/"+obj.path+");margin: 16px;' class='img-bg'><div class='upload__img-close'><i onclick='delimage("+obj.id+")'' id='img_"+obj.id+"' class='fa fa-times-circle-o' aria-hidden='true' style='color: white;font-size: 24px;position: relative;float: right;' ></i></div></div>");
				    	$("#myform")[0].reset(); 
				    }
		      	},
		     	error: function(e) 
			    {
			    	$("#err").html(e).fadeIn();
			    }          
		  });

		 }));
		});

		$('#excle').on('change', function() 
 		{
 			$( "#excleupload" ).submit();
 		});

 		$("#excleupload").on('submit',(function(e) {
		  e.preventDefault();
		  $.ajax({
		        url: "excelUpload2.php",
			    type: "POST",
			    data:  new FormData(this),
			    contentType: false,
		        cache: false,
		   		processData:false,
		   		beforeSend : function()
		   		{
		    		$("#err").fadeOut();
		   		},
		   		success: function(data)
		      	{
				    if(data=='error')
				    {
				     // invalid file format.
				     $("#err").html("Invalid File !").fadeIn();
				     $(".alerts").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Holy guacamole!</strong> Error Try again.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); 
				    }
				    else
				    {
				    	// const obj = JSON.parse(data);
				    	// $('.upload__img-box').append("<div style='background-image: url(uploads/"+obj.path+");margin: 16px;' class='img-bg'><div class='upload__img-close'><i onclick='delimage("+obj.id+")'' id='img_"+obj.id+"' class='fa fa-times-circle-o' aria-hidden='true' style='color: white;font-size: 24px;position: relative;float: right;' ></i></div></div>");
				    	$('#mytable').append(data);
				    	$(".alerts").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Holy guacamole!</strong>successfully inserted<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); 
				    	$("#excleupload")[0].reset(); 
				    }
		      	},
		     	error: function(e) 
			    {
			    	$("#err").html(e).fadeIn();
			    }          
		  });

		 }));

		function delimage(id){
			$.ajax({
			    url: "delimage.php",
			    type: "POST",
			    data:  {
			    	id : id
			    },
				beforeSend : function()
				{
					$("#err").fadeOut();
				},
				success: function(data)
			  	{
				    if(data=='error')
				    {
				     // invalid file format.
				     $("#err").html("Invalid File !").fadeIn();
				    }
				    else
				    {
				     $('#img_'+data).parent().parent().remove();
				    }
			  	},
			 	error: function(e) 
			    {
			    	$("#err").html(e).fadeIn();
			    }          
			});
		}

		var columns = document.querySelectorAll('.card');
		var draggingClass = 'dragging';
		var dragSource;

		Array.prototype.forEach.call(columns, function (col) {
		  col.addEventListener('dragstart', handleDragStart, false);
		  col.addEventListener('dragenter', handleDragEnter, false)
		  col.addEventListener('dragover', handleDragOver, false);
		  col.addEventListener('dragleave', handleDragLeave, false);
		  col.addEventListener('drop', handleDrop, false);
		  col.addEventListener('dragend', handleDragEnd, false);
		});

		function handleDragStart (evt) {
		  dragSource = this;
		  evt.target.classList.add(draggingClass);
		  evt.dataTransfer.effectAllowed = 'move';
		  evt.dataTransfer.setData('text/html', this.innerHTML);
		}

		function handleDragOver (evt) {
		  evt.dataTransfer.dropEffect = 'move';
		  evt.preventDefault();
		  console.log(dragSource.getAttribute('data-id'));
		}

		function handleDragEnter (evt) {
		  this.classList.add('over');
		}

		function handleDragLeave (evt) {
		  this.classList.remove('over');

		}

		function handleDrop (evt) {
		  evt.stopPropagation();
		  
		  if (dragSource !== this) {
		    dragSource.innerHTML = this.innerHTML;
		    this.innerHTML = evt.dataTransfer.getData('text/html');
		    
		  	var after = this.getAttribute('data-id');
		  	var safter = this.getAttribute('data-sid');
		  	var before = dragSource.getAttribute('data-id');
		  	var sbefore = dragSource.getAttribute('data-sid');
		  	console.log('after :'+after+' before= :'+before);
		  	$.ajax({
			    url: "positionupdate.php",
			    type: "POST",
			    data:  {
			    	after : after,
			    	safter : safter,
			    	before : before,
			    	sbefore : sbefore,
			    },
				beforeSend : function()
				{
					$("#err").fadeOut();
				},
				success: function(data)
			  	{
				    if(data=='error')
				    {
				     // invalid file format.
				     $("#err").html("Invalid File !").fadeIn();
				    }
				    else
				    {
				     	location.reload();
				    }
			  	},
			 	error: function(e) 
			    {
			    	$("#err").html(e).fadeIn();
			    }          
			});
		  }
		  
		  evt.preventDefault();
		}

		function handleDragEnd (evt) {
		  Array.prototype.forEach.call(columns, function (col) {
		    ['over', 'dragging'].forEach(function (className) {
		      col.classList.remove(className);
		    });
		  });
		}

	</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


