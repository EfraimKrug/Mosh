<?php
// anchor tag from ListMoshgichim.php
include 'GenFileParts.php';

GenerateTop();
$mKey = $_GET["MoKey"]; 

$sql = "SELECT * FROM Moshgiach WHERE MoKey = " . $mKey;
$sqlGetCommit = "SELECT * FROM Commit WHERE CoMoKey = " . $mKey;
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
echo "<a href=\"DeleteMoshgiach.php?MoKey=" . $mKey . "\"><input type=\"submit\" value=\"Delete?\"/></a>";
echo "<a href=\"EditMoshgiach.php?MoKey=" . $mKey . "\"><input type=\"submit\" value=\"Edit?\"/></a><br><br>";

while($row = mysql_fetch_array($resultSet))
	{
	echo $row['MoFName'] . " " . $row['MoLName'] . " [" . $row['MoEMail'] . "]";
	echo "<br>";
	}

//Set up the query
$resultSet = mysql_query($sqlGetCommit);

while($row = mysql_fetch_array($resultSet))
	{
	echo $row['CoDate'] . " " . $row['CoMeal'];
	echo "<br>";
	}
	
mysql_close($con);

GenerateBottom();
?>