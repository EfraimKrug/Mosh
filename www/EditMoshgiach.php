<?php
//form from GetMoshgiach.php
include 'GenFileParts.php';

GenerateTop();

$mKey = $_GET["MoKey"]; 

$sql = "SELECT * FROM Moshgiach WHERE MoKey = " . $mKey . ";";
//Connect to the database
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//Select the database
mysql_select_db("MoshSched", $con);
$resultSet = mysql_query($sql);
//echo $sql;
$row = mysql_fetch_array($resultSet);
	
echo "<form action=\"../UpdateMoshgiach.php?MoKey=" . $mKey . "\" method=\"post\"> " .
	"First Name: <input type=\"text\" name=\"MoFName\" value=" . $row['MoFName'] . "><br> " . 
	"Last Name: <input type=\"text\" name=\"MoLName\" value=" . $row['MoLName'] . "><br>" .
	"Email: <input type=\"text\" name=\"MoEMail\" value=" . $row['MoEMail'] . "><br>" .
	"<input type=\"submit\">" .
	"</form>";
mysql_close($con);

GenerateBottom();
?>