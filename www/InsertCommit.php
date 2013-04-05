<?php
/* 
 * insertCommit is called from edit... always delete the old commit
 * record and insert a new one
 */
include 'GenFileParts.php';
GenerateTop();

$oldDate = $_POST["date"];
$oldMeal = $_POST["meal"];
$oldFName = $_POST["fname"];
$oldLName = $_POST["lname"];
$oldSDKey = $_POST["SdKey"];
//echo $oldSDKey;

$sqlSelectDate = "Select * FROM SchedDate WHERE SdDate = \"" . $oldDate	. "\" AND SdMeal = \"" . $oldMeal . "\"";
$sqlAddDate = "INSERT INTO SchedDate (SdDate, SdMeal) VALUES ('$oldDate', '$oldMeal')";
$sqlSelectMoshgiach = "Select * FROM Moshgiach WHERE MoFName = \"" . $oldFName . "\" AND MoLName = \"" . $oldLName . "\"";

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("MoshSched", $con);

/* Business Logic: Deal with date/ if none - update the date table */
$resultDate = mysql_query($sqlSelectDate, $con);
$countDate = mysql_num_rows($resultDate);
if($countDate < 1){
	mysql_query($sqlAddDate, $con);
	/* find the assigned date key */
	$resultDate = mysql_query($sqlSelectDate, $con);
	//echo "<br>added date";
	}
echo "<br>Processing moshgiach...";
/* Business Logic: Deal with moshgiach / if none - crash and burn */
$resultMoshgiach = mysql_query($sqlSelectMoshgiach, $con);
$countMoshgiach = mysql_num_rows($resultMoshgiach);
if($countMoshgiach < 1){
	echo "Please enter the moshgiach first...";
	header('Location: ./AddMoshgiach.php');
	}
else {
	$row = mysql_fetch_array($resultMoshgiach);
	$mKey = $row['MoKey'];
	$fn = $row['MoFName'];

	$row = mysql_fetch_array($resultDate);
	$dKey = $row['SdKey'];
	
	//echo "New: " . $fn . "(" . $mKey . "/" . $dKey . ")";
	
	$sqlInsertCommit = "INSERT INTO Commit 	(CoDate, CoMeal, CoMoKey, CoSdKey) 
							VALUES		('" . $oldDate ."', '". $oldMeal ."', '" . $mKey . "', '" . $oldSDKey . "')";

	//only one commit per date/meal row
	$sqlDeleteCommit = "DELETE FROM Commit WHERE CoSdKey = " . $oldSDKey;
	mysql_query($sqlDeleteCommit);

	mysql_query($sqlInsertCommit, $con);
	//echo "<br>inserted: " . $sqlInsertCommit; 
	}

mysql_close($con);
generateBottom();
//header('Location: ./html/SchedMash.html');
?> 

