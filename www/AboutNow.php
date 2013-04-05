<?php
include 'GenFileParts.php';
GenerateTop();

$sql = "SELECT * FROM SchedDate WHERE SdDate > CURRENT_DATE";

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
		$dt = $row['SdDate'];
		$ml = $row['SdMeal'];
		echo "<a href='GetDate.php?param=SdDate>" . $dt . "|SdMeal>" . $ml . "'>" . $dt . " " . $ml . "</a>";
		echo "<br>";
	}
	
mysql_close($con);

GenerateBottom();
?>
