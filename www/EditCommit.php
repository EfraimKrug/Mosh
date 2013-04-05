<?php
//from AboutNow.php - anchor tag
include 'GenFileParts.php';
GenerateTop();

$CoMoKey = $_GET["CoMoKey"];
$CoSdKey = $_GET["CoSdKey"];

$sql = "SELECT * FROM Commit WHERE CoMoKey = '" . $CoMoKey . "' AND CoSdKey = '" . $CoSdKey . "'";
//echo $sql;
//Connect to the database
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//Select the database
mysql_select_db("MoshSched", $con);
//Set up the query
$resultSet = mysql_query($sql);
$row = mysql_fetch_array($resultSet);
$CoMeal = $row['CoMeal'];
$CoDate = $row['CoDate'];

$sql = "SELECT * FROM Moshgiach WHERE MoKey = " . $CoMoKey;
$resultSet = mysql_query($sql);
$countResult = mysql_num_rows($resultSet);

if($countResult > 0){
	$row = mysql_fetch_array($resultSet);
	$MoFName = $row['MoFName'];
	$MoLName = $row['MoLName'];
	$MoEMail = $row['MoEMail'];
	
	echo "<form action=\"../InsertCommit.php?delete=true\" method=\"post\">";
	echo "First Name: <input type=\"text\" name=\"fname\" value=" . $MoFName . "><br>";
	echo "Last Name: <input type=\"text\" name=\"lname\"  value=" . $MoLName . "><br>";
	echo "Date: " . $CoDate . "<br>";
	echo "Meal: " . $CoMeal . "<br>";
	echo "<input type=\"hidden\" name=\"SdKey\" value=\"$CoSdKey\">";
	echo "<input type=\"submit\">";
	echo "</form>";
	}
else {
	echo "Still not committed!";
	}
	

mysql_close($con);

GenerateBottom();
?>
