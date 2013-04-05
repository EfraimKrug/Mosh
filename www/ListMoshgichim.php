<?php
include 'GenFileParts.php';

GenerateTop();

$sql = "SELECT * FROM Moshgiach";

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
echo "<table>";
$i = 0;
while($row = mysql_fetch_array($resultSet))
	{
	if($i==0){
		echo "<tr>";
		}
	$j = $i % 2;
	if(($i>0)&&($j<1)){
		echo "</tr><tr>";
		}
	$em = $row['MoEMail'];
	echo "<td><a href=\"./GetMoshgiach.php?MoKey=" . 
			$row['MoKey'] . "\" ><p class=\"footerChange\" onMouseOver=displayFooter('$em') onMouseOut=clearFooter()>" .
			$row['MoFName'] . " " . $row['MoLName'] . "<!-- [" . 
			$row['MoEMail'] . "]--></p></a></td>";
	$i++;
	}
echo "</tr></table>";
mysql_close($con);

GenerateBottom();
?>