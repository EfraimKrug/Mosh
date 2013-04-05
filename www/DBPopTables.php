<!DOCTYPE html>
<html>
<body>

<?php

$sql = array(	"INSERT INTO Moshgiach 	(MoFName, MoLName, MoEMail) 
								VALUES	('Efraim', 'Krug', 'EfraimMKrug@GMail.com')",
				"INSERT INTO SchedDate 	(SdDate, SdMeal)
								VALUES	('2013-2-8', 'dinner')"
				);

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("MoshSched", $con);
for($i=0;$i<count($sql);$i++)
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