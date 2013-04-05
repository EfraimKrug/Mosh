 <?php
//form from GetMoshgiach.php
include 'GenFileParts.php';

GenerateTop();

$mKey = $_GET["MoKey"]; 
$mFName = $_POST["MoFName"]; 
$mLName = $_POST["MoLName"]; 
$mEMail = $_POST["MoEMail"]; 

$sql = "UPDATE Moshgiach SET MoFName = '" . $mFName . "', " .
		"MoLName ='" . $mLName . "', MoEMail='" . $mEMail . "' WHERE MoKey = " . $mKey . ";";
//Connect to the database
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//Select the database
mysql_select_db("MoshSched", $con);
mysql_query($sql);
echo "$mFName has been successfully updated!";
mysql_close($con);
GenerateBottom();
?>