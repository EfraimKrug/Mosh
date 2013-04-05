
<?php
$sql = array("SELECT * FROM Moshgiach",
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
	echo $row['MoKey'] . " >>>>" . $row['MoFName'] . " " . $row['MoLName'] . " <" . $row['MoEMail'] . ">";
	echo "<br>";
	}
	
mysql_close($con);
?> 

