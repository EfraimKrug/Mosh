w<!DOCTYPE html>
<html>
<body>

<?php

$sql = array(	"CREATE DATABASE MoshSched",
		"CREATE TABLE Moshgiach (	MoFName varchar(15), 
						MoLName varchar(15), 
						MoEMail varchar(25), 
						MoKey smallint NOT NULL AUTO_INCREMENT,
						PRIMARY KEY(MoKey))",

		"CREATE TABLE SchedDate (	SdDate date, 
						SdMeal varchar(10), 
						SdKey smallint NOT NULL AUTO_INCREMENT,
						PRIMARY KEY(SdKey))",

		"CREATE TABLE Commit (CoDate date, 
						CoMeal varchar(10), 
						CoMoKey smallint, 
						CoSdKey smallint,
						PRIMARY KEY(CoMoKey,CoSdKey))");

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("MoshSched", $con);
for($i=1;$i<count($sql);$i++)
{
if (mysql_query($sql[$i],$con))
  {
  echo $sql[$i] . "Successful<br>";
  }
else
  {
  echo "<br>Database Error: (" . $sql[$i] . ")" . mysql_error();
  }
}

mysql_close($con);
?> 

</body>
</html>