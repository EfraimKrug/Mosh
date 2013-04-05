<?php

function GenerateTop(){

echo "<!DOCTYPE html>
<html>
<head>
<link rel=\"stylesheet\" href=\"./css/schedMash.css\">
<title>This is the stuff I know... </title>
<link rel=\"stylesheet\" type=\"text/css\" href=\".\css\SlidingMenu.css\">
<link rel=\"stylesheet\" type=\"text/css\" href=\".\css\ButtonMenu.css\">
<script type=\"text/javascript\" src=\".\js\jquery.js\" ></script>
<script type=\"text/javascript\">
function displayFooter(x){
	$(\"#footer\").text(x);
}
function clearFooter(x){
	$(\"#footer\").text(\"Click on the name to assign an event\");
}

</script>
<script type=\"text/javascript\"><!-- this jQuery runs the top menu -->
function changeColor(){
	$(\"#contentRight\").text(\"Boom!\");
	$(\"#contentRight\").css(\"background-color\",\"black\");
	$(\"#bottom\").text(\"The navigator object calls the command (or pager) object...\");
	}
$(document).ready(function(){

	$(\".button\" ).toggle(function(){
		var clas  = $(this).attr(\"class\" );
		$(\".\"+clas.replace('button ','')+\"_grad\" ).animate({opacity:'1',top:'50px'}, 500 );
		},
		function(){
		var clas  = $(this).attr(\"class\" );
		$(\".\"+clas.replace('button ','')+\"_grad\" ).animate({opacity:'0',top:'-300px'}, 500 );
	});
	
	$(\"#dropImage\").animate({
		left:'96px',
		top:'261px',
		opacity:'0'
		}, 25000, changeColor);

});

</script> 

</head>
<body>
<div id=\"wrapper\">
	<div id=\"header\"><!--  BEGIN DOCUMENT MENU ----------------->

	<div class=\"container\"> 
	<div class=\"column\">
	       <div class=\"button blue\">Event Dates</div>
				<div sw=0 class=\"blue_grad slider\">
					<a href=\"../Navigator.php?page=AddDate\">Add One</a>
					<a href=\"../Navigator.php?page=AboutNowDB\">List Them</a>
					<a href=\"../CleanDates.php\">Clean Date</a>
				</div> <!-- .slider -->  
	</div> <!-- column -->
	<div class=\"column\">
    <div class=\"button green\">Mashgichim</div>
				<div sw=0 class=\"green_grad slider\">
					<a href=\"../AddMoshgiach.php\">Add One</a>
					<a href=\"../Navigator.php?page=ListMoshgichim\">List Them</a>
				</div> <!-- .slider -->  
	</div> <!-- column -->
	<div class=\"column\">
		<div class=\"button orange\">Commit</div>
				<div sw=0 class=\"orange_grad slider\">
					<a href=\"../AddCommit.php\">Add One</a>
					<a href=\"../Navigator.php?page=ListCommit\">List Them</a>
				</div> <!-- .slider -->  
	</div> <!-- column -->
	
	<div class=\"column\">
			<div class=\"button violet\"> </div>
				<div sw=0 class=\"violet_grad slider\">
					<a href=\"#\">Violet Option one</a>
					<a href=\"#\">Violet Option two</a>
				</div> <!-- .slider -->
	</div> <!-- column -->
	<div class=\"column\">
			<div class=\"button pink\"> </div>
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
}


function GenerateBottom(){
echo "</div>
		<div id=\"contentRight\"><div id=\"dropImage\"><img src=\"../images/drop.png\"/></div></div>
	</div>
	<div id=\"footer\">I am now in the process of converting the pages to object oriented design patterns.</div>
	<div id=\"bottom\"><a href=\"printOut.php?file=command.php\">Want to see my command object file? huh?</a></div>
</div>
</body>
</html>";
}
?>
