<?php
include 'GenFileParts.php';
include 'DB2.php';

GenerateTop();

$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
$rs = $dbObj->getListSchedDate();

while($row = mysql_fetch_array($rs))
	{
	$dt = $row['SdDate'];
	$ml = $row['SdMeal'];
	echo "<a href='GetDate.php?SdDate=" . $dt . "&SdMeal=" . $ml . "'>" . $dt . " " . $ml . "</a><br>";
	}
	
$dbObj->close_DataBase();

GenerateBottom();
?>
