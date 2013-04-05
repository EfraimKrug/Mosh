
<?php
include 'GenFileParts.php';

GenerateTop();
$sql = "INSERT INTO Moshgiach (MoFName, MoLName, MoEMail) VALUES('$_POST[fname]', '$_POST[lname]', '$_POST[email]')";
$sqlCheckMoshgiach = "Select * FROM Moshgiach WHERE MoFName = \"" . $_POST["fname"] . "\" AND MoLName = \"" . $_POST["lname"] . "\"";

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

/*echo $sql;
echo $sqlCheckMoshgiach;
*/
mysql_select_db("MoshSched", $con);
$resultMoshgiach = mysql_query($sqlCheckMoshgiach, $con);
$countMoshgiach = mysql_num_rows($resultMoshgiach);

if($countMoshgiach > 0){
	echo "No - we already have that moshgiach!";
	}

/*mysql_select_db("MoshSched", $con);*/
mysql_query($sql,$con);
echo "We have successfully added that moshgiach!";
GenerateBottom();
mysql_close($con);
?> 

