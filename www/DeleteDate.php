<!DOCTYPE html>
<html>
<body>

<?php
include 'GenFileParts.php';
GenerateTop();
$dateRequest = $_POST['date'];
$sql = "DELETE FROM SchedDate " . 
		"WHERE SdDate < '$dateRequest'";
		
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("MoshSched", $con);

mysql_query($sql,$con);
$sql = "DELETE FROM Commit " . 
		"WHERE CoDate < '$dateRequest'";
mysql_query($sql,$con);
echo "That should have taken care of that!";
mysql_close($con);
GenerateBottom();
?> 

</body>
</html>