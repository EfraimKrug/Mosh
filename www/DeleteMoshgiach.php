<?php
//form from GetMoshgiach.php
include 'GenFileParts.php';

GenerateTop();

$mKey = $_GET["MoKey"]; 

$sql = "DELETE FROM Moshgiach WHERE MoKey = '" . $mKey . "'";
//Connect to the database
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//Select the database
mysql_select_db("MoshSched", $con);
//Set up the query
mysql_query($sql);
echo "That moshgiach has been removed from our application records completely!";
mysql_close($con);

GenerateBottom();
header('Location: ./ListMoshgichim.php');
?>