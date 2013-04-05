<?php
include 'GenFileParts.php';

GenerateTop();

$sql = "SELECT * FROM Commit, Moshgiach WHERE CoMoKey = MoKey";

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

while($row = mysql_fetch_array($resultSet))
	{
	$dt = $row['CoDate'];
	$ml = $row['CoMeal'];
	$ky = $row['CoMoKey'];
	$sdKy = $row['CoSdKey'];
	$mo = $row['MoFName'] . " " . $row['MoLName'];
	echo "<a href='Navigator.php?page=GetDate&SdKey=" . $sdKy . "'>" . $dt . " " . $ml . " [" . $mo . "]</a>";
	echo "<br>";
	}
	
mysql_close($con);

GenerateBottom();
?>