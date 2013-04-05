<!DOCTYPE html>
<html>
<body>

<?php
include 'GenFileParts.php';
GenerateTop();
$dateRequest = $_POST['date'];
$mealRequest = $_POST['meal'];
$sql = "INSERT INTO SchedDate 	(SdDate, SdMeal) " .
						"VALUES	('$dateRequest', '$mealRequest')";

$sqlCheck = "SELECT * FROM Moshgiach " . 
			"WHERE MoFName = \"$_POST[fname]\" AND MoLName = \"$_POST[lname]\";";

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("MoshSched", $con);

/*
 * First get the moshgiach key - for the commit
 */
$rs = mysql_query($sqlCheck);
$sw = 0;
if($row = mysql_fetch_array($rs))
	{
		$mKey = $row['MoKey'];
		$sw = 1; //Moshgiach is found...
	}

/*
 * Now store the date - and get the date key
 */
if (mysql_query($sql,$con))
  {
	$dKey = mysql_insert_id($con);
  }
else
  {
  echo "<br>Database Error: (" . $sql . ")" . mysql_error();
  }
/*
 * Now I have all the data for the commit - store it if the moshgiach is real!
 */
 if($sw > 0){
 //store commit
	$sql = 	"INSERT INTO Commit (CoDate, CoMeal, CoMoKey, CoSdKey) " .
			"VALUES ('$dateRequest', '$mealRequest', '$mKey', '$dKey')";
	mysql_query($sql, $con);
	}
mysql_close($con);
GenerateBottom();
?> 

</body>
</html>