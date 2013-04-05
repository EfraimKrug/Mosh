<?php
include 'GenFileParts.php';
GenerateTop();

$sql = array("SELECT * FROM SchedDate",
				);

//Connect to the database
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//Select the database
mysql_select_db("MoshSched", $con);
//Set up the query
$resultSet = mysql_query($sql[0]);

while($row = mysql_fetch_array($resultSet))
	{
	echo $row['SdKey'] . "<a href='#'>" . $row['SdDate'] . " " . $row['SdMeal'] . "</a>";
	echo "<br>";
	}
	
mysql_close($con);

GenerateBottom();
?>
