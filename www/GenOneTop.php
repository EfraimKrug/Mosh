<?php
echo "<!DOCTYPE html>
<html>
<head>
<link rel=\"stylesheet\" href=\"./css/schedMash.css\">
<title>This is the stuff I know... </title>
<link rel=\"stylesheet\" type=\"text/css\" href=\".\css\SlidingMenu.css\">
<link rel=\"stylesheet\" type=\"text/css\" href=\".\css\ButtonMenu.css\">
<script type=\"text/javascript\" src=\".\js\jquery.js\" ></script>
<script type=\"text/javascript\"><!-- this jQuery runs the top menu -->
$(document).ready(function(){

	$(\".button\" ).toggle(function(){
		var clas  = $(this).attr(\"class\" );
		$(\".\"+clas.replace('button ','')+\"_grad\" ).animate({opacity:'1',top:'50px'}, 500 );
		},
		function(){
		var clas  = $(this).attr(\"class\" );
		$(\".\"+clas.replace('button ','')+\"_grad\" ).animate({opacity:'0',top:'-300px'}, 500 );
	});

});

</script> 

<script>
$(document).ready(function(){
//slider is 
	$(\".slider\").click(function() {
		 alert($(this).attr(\"sw\"));
		});
	});
	
//});
</script>
</head>
<body>
<div id=\"wrapper\">
	<div id=\"header\"><!--  BEGIN DOCUMENT MENU ----------------->

	<div class=\"container\"> 
	<div class=\"column\">
	       <div class=\"button blue\">Event Dates</div>
				<div sw=0 class=\"blue_grad slider\"><br>
					<a href=\"#\">About Now</a>
					<a href=\"#\">Blue Option two</a>
				</div> <!-- .slider -->  
	</div> <!-- column -->
	<div class=\"column\">
    <div class=\"button green\"> Menu Option </div>
				<div sw=0 class=\"green_grad slider\">
					<a href=\"#\">Green Option one</a>
					<a href=\"#\">Green Option two</a>
				</div> <!-- .slider -->  
	</div> <!-- column -->
	<div class=\"column\">
		<div class=\"button orange\"> Menu Option </div>
				<div sw=0 class=\"orange_grad slider\">
					<a href=\"#\">Orange Option one</a>
					<a href=\"#\">Orange Option two</a>
				</div> <!-- .slider -->  
	</div> <!-- column -->
	
	<div class=\"column\">
			<div class=\"button violet\"> Menu Option </div>
				<div sw=0 class=\"violet_grad slider\">
					<a href=\"#\">Violet Option one</a>
					<a href=\"#\">Violet Option two</a>
				</div> <!-- .slider -->
	</div> <!-- column -->
	<div class=\"column\">
			<div class=\"button pink\"> Menu Option </div>
				<div sw=0 class=\"pink_grad slider\">
					<a href=\"#\">Pink Option one</a>
					<a href=\"#\">Pink Option two</a>
				</div> <!-- .slider -->  
	</div> <!-- column -->
	</div> <!-- #container --> 

	</div><!--             END DOCUMENT MENU  ------------------>
	<div id=\"content\">
		<div id=\"contentLeft\"><!-- <img src=\"..\images\smokeyMe.gif\"/>-->content Left...</div>
		<div id=\"contentMain\">";
?>