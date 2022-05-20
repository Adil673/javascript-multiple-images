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
    	body
  font-family sans-serif

.columns
  margin 0 auto
  background lightgrey
  width 800px
  padding 20px

.card
  width 32%
  display inline-block
  margin-right 1.2%
  height 120px
  font-size 50px
  background deeppink
  border 3px solid deeppink
  box-sizing border-box
  color white
  line-height 120px
  vertical-align middle
  text-align center
  
  &:last-child
    margin-right 0
  
  &:nth-child(2)
    background dodgerblue
    border-color dodgerblue
  
  &:nth-child(3)
    background darkturquoise
    border-color darkturquoise
  
  &.dragging
    opacity 0.5
    
  &.over
    border 3px dashed black
 
 [draggable]
   user-select none


    </style>
  </head>
  <body>

  	<h1>Drag &amp; Drop</h1>

	<div class="columns">
	  <div class="card" data-id="3" draggable="true">A</div>
	  <div class="card" data-id="4" draggable="true">B</div>
	  <div class="card" data-id="5" draggable="true">C</div>
	</div>

	<script type="text/javascript">

		const position = [];
		// position.push("Kiwi");

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
		  console.log(dragSource.getAttribute('data-id'));
		}

		function handleDragOver (evt) {
		  evt.dataTransfer.dropEffect = 'move';
		  evt.preventDefault();
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
		    console.log(this);
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


