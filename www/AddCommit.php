<?php
//include 'GenFileParts.php';
include 'Command.php';
$ky = $_GET["SdKey"];

$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
$rs = $dbObj->getDateByKey($ky);
$row = mysql_fetch_array($rs);
$dt = $row["SdDate"];
$ml = $row["SdMeal"];

if($dt == "x"){
	$dt="";
	}
if($ml == "x"){
	$ml="";
	}
	
GenerateTop();

echo "<form action=\"../InsertCommit.php\" method=\"post\">";
echo "First Name: <input type=\"text\" name=\"fname\"><br>";
echo "Last Name: <input type=\"text\" name=\"lname\"><br>";
echo "Date: <input type=\"text\" name=\"date\" value=$dt><br>";
echo "Meal: <input type=\"text\" name=\"meal\" value=$ml><br>";
echo "<input type=\"hidden\" name=\"SdKey\" value=\"$ky\">";
echo "<input type=\"submit\">";
echo "</form>";

GenerateBottom();
?>
