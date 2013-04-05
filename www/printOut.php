<?php
//from printing out more interesting code...
include 'GenFileParts.php';
GenerateTop();

$fileName = "./" . $_GET["file"];
/*
echo $fileName;
$file = fopen($fileName, "r");
while(!feof($file)){
	echo fgets($file) . "<br>";
	}
fclose($file);
*/
$file = fopen($fileName, "r");
$fileO = fopen("junk.htm", "w+");
fwrite($fileO, "<html><head></head><body>");
while(!feof($file)){
	$line = fgets($file);
	fwrite($fileO, preg_replace( "/</", "<ww**", $line) . "<br>");
	//fwrite($fileO, $line . "<br>");
	}
fwrite($fileO, "</body></html>");
fclose($fileO);
fclose($file);
echo "<iframe src=\"junk.htm\" width=\"480\" height=\"280\">";
echo "</iframe>";
GenerateBottom();
?>
