<?php
//from AboutNow.php - anchor tag
/*
 * GetDate - gets a specific date/meal lookup
 * and the moshgichim committed to those meals
 */
include 'GenFileParts.php';
GenerateTop();
// get parameters from previous a tag
$SdDate = $_GET["SdDate"];
$SdMeal = $_GET["SdMeal"];
$sql = "SELECT * FROM SchedDate WHERE SdDate = '" . $SdDate . "' AND SdMeal = '" . $SdMeal . "'";
//Connect & select database 
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("MoshSched", $con);

// Get record set - possible multirows for date/meal
// some date/meals may be assigned(get editDate), some not (get addDate)
$resultSetSD = mysql_query($sql);
$countResult = mysql_num_rows($resultSetSD);

//loop thru date/meals
while($rowSD = mysql_fetch_array($resultSetSD))
{
	//get moshgiach committed
	$rowSDKey = $rowSD['SdKey'];
	$sql = "SELECT * FROM Commit WHERE CoSdKey = " . $rowSDKey;
	$resultSet = mysql_query($sql);
	$resultSetCount = mysql_num_rows($resultSet);
	if($resultSetCount > 0){ // there is a commit
		$row = mysql_fetch_array($resultSet);		//get commit
		$CoSdKey = $row['CoSdKey'];					//store keys
		$CoMoKey = $row['CoMoKey'];
		$sql = "SELECT * FROM Moshgiach WHERE MoKey = " . $row['CoMoKey'];		// get moshgiach
		$resultSet = mysql_query($sql);
		$row = mysql_fetch_array($resultSet);
		$MFName = $row['MoFName'];
		$MLName = $row['MoLName'];
		$MEMail = $row['MoEMail'];

		echo "<a href='EditCommit.php?CoSdKey=" . $CoSdKey . "&CoMoKey=" . $CoMoKey . "'>" . 
				$SdDate . "(" . $SdMeal . ") " . $MFName . " " . $MLName . " " . 
				$MEMail . "</a><br>";
		}
	else {
		echo "<a href='AddCommit.php?SdDate=" . $SdDate . 
				"&SdMeal=" . $SdMeal . "&SdKey=" . $rowSDKey . "'>" . $SdDate . " " . 
				$SdMeal . " is still not committed!</a><br>";
		}
}	

mysql_close($con);

GenerateBottom();
?>
