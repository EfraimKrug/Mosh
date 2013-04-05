<!DOCTYPE html>
<html>
<body>

<?php
$sql 	[]= "SELECT m.MoFName, m.MoLName, m.MoEMail, s.SdDate, s.SdMeal " . 
		"FROM Moshgiach m, SchedDate s, Commit c " . 
		" WHERE m.MoKey = c.CoMoKey AND s.SdKey = c.CoSdKey";
//		AND s.SdDate = \"2013-03-01\" AND s.SdMeal = \"lunch\" ";
//	$sql	[]= "SELECT m.MoFName, m.MoLName, m.MoEMail, s.SdDate, s.SdMeal " . 
//			"FROM Moshgiach m, SchedDate s, Commit c " .
//			"WHERE  m.MoKey = c.CoMoKey AND s.SdKey = c.CoSdKey;";

//	$sql	[]= "SELECT MoFName, MoLName, MoEMail, SdDate, SdMeal " . 
//			"FROM Moshgiach m, SchedDate s, Commit c " .
//			"WHERE  m.MoKey = c.CoMoKey AND s.SdKey = c.CoSdKey";
//				
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
echo $sql[0];
mysql_select_db("MoshSched", $con);

$resultSet = mysql_query($sql[0]);
$countResult = mysql_num_rows($resultSet);
	//echo "<font size=14>$countResult</font><br>";
	//echo $sql[0];
while($row = mysql_fetch_array($resultSet))
{
	echo "<font size=10>" . $row['MoFName'] . ", " . $row['MoLName'] . $row['SdDate'] . $row['SdMeal'] . "</font><br>";
}
mysql_close($con);
?> 

</body>
</html>