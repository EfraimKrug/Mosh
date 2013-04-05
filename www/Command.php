<?php

include 'GenFileParts.php';
include 'DB2.php';

/*
 * Command Object - accessed from Navigation Object
 * Navigation thru pages - every page implements IPage
 * PageChain is an array of IPage objects
 */
 
interface IPage
{
  function nextPage( $name, $args );
}

/*
 * PageChain - array of pages theoretically allowing forward
 * and backward navigation - but in this case there are browser
 * buttons for that - so it is overkill... but what the heck!
 *
 */
class PageChain
{
  private $_pages = array();

  /*
  * Add a page to the PageChain - this is necessary
  * for every page before the pages can be loaded
  */
  public function addPage( $pageName )
  {
    $this->_pages []= $pageName;
  }

  /*
  * Retrieve the page... 
  */
  public function getPage( $name, $args )
  {
    foreach( $this->_pages as $pageName )
    {
      if ( $pageName->nextPage( $name, $args ) )
        return;
    }
  }
}
/*
 * Each page needs an object - same name as the page - 
 * the object will do the database access (if necessary)
 * and return a record set - either one row, multiple
 * rows or empty... 
 * This object then writes out the html for the section of
 * the page requiring database access.
 * @param $args - empty here
 */
class AboutNowDB implements IPage
{
  public function nextPage( $name, $args )
  {
    if ( $name != 'AboutNowDB' ) return false;
	GenerateTop();
	$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
	$rs = $dbObj->getList("SD");

	while($row = mysql_fetch_array($rs))
		{
		echo "<a href='Navigator.php?page=GetDate&SdKey=" . $row['SdKey'] . "'>" . $row['SdDate'] . " " . $row['SdMeal'] . "</a><br>";
		}	
	$dbObj->close_DataBase();
	GenerateBottom();    
	return true;
  }
}

/*
 * GetDate - gets individual date given the date and meal
 * @param $args - 0- date/ 1-meal
 */
class GetDate implements IPage
{
  public function nextPage( $name, $args )
  {
    if ( $name != 'GetDate' ) return false;
	GenerateTop();
	$SdKey = $args[0];
	$sw=0;
	$sql = "SELECT m.MoFName, m.MoLName, m.MoEMail, s.SdDate, s.SdMeal " . 
			"FROM Moshgiach m, SchedDate s, Commit c " .
			"WHERE  m.MoKey = c.CoMoKey AND s.SdKey = c.CoSdKey;";
			
	$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
	$rsDate = $dbObj->getDateByKey($SdKey);
	$rowDate = mysql_fetch_array($rsDate);
	$SdDate = $rowDate['SdDate'];
	$SdMeal = $rowDate['SdMeal'];

	$sqlEmptyDates = "SELECT * FROM SchedDate WHERE " .
						"SdDate = '" . $SdDate . "' AND SdMeal = '" . $SdMeal . "' AND " .
						"SdKey NOT IN ( " .
						"SELECT CoSdKey FROM Commit);";
						
	$rs = $dbObj->getListbyDateMeal($SdDate, $SdMeal);
	while($row = mysql_fetch_array($rs))
	{
	
	echo "<a href='Navigator.php?page=EditCommit&CoSdKey=" . $row['CoSdKey'] . "&CoMoKey=" . $row['CoMoKey'] . "'>" . $SdDate . "(" . $SdMeal . ") Hashgacha by: " . $row['MoFName'] . " " . $row['MoLName'] . "</a><br>";	
//	echo "<a href='EditCommit.php?CoSdKey=" . $row['CoSdKey'] . "&CoMoKey=" . $row['CoMoKey'] . "'>" . $SdDate . "(" . $SdMeal . ") Hashgacha by: " . $row['MoFName'] . " " . $row['MoLName'] . "</a><br>";	
	$sw++;
	}
	$rsEmptyDates = $dbObj->getManyRows($sqlEmptyDates);
	while($ERow = mysql_fetch_array($rsEmptyDates))
	{
	echo "<a href='AddCommit.php?SdKey=" . $ERow['SdKey'] . "'>" . $SdDate . "(" . $SdMeal . ") No Hashgacha </a><br>";	
	$sw++;
	}
	$dbObj->close_DataBase();
	GenerateBottom();    
	return true;
	}
}

class EditCommit implements IPage
{
  public function nextPage( $name, $args )
  {
    if ( $name != 'EditCommit' ) return false;
	GenerateTop();

	$CoMoKey = $args[1];
	$CoSdKey = $args[0];

	$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
	$commitRS = $dbObj->getCommitByKey($CoSdKey, $CoMoKey);

	$row = $dbObj->getNextArray($commitRS);
	$CoMeal = $row['CoMeal'];
	$CoDate = $row['CoDate'];

	$moshgiachRS = $dbObj->getMoshgiachByKey($CoMoKey);
	$countResult = $dbObj->getCount($moshgiachRS);

	if($countResult > 0){
		$row = $dbObj->getNextArray($moshgiachRS);
		$MoFName = $row['MoFName'];
		$MoLName = $row['MoLName'];
		$MoEMail = $row['MoEMail'];
		$MoKey = $row['MoKey'];		
		
		echo "<form action=\"../Navigator.php?page=InsertCommit\" method=\"post\">";
		echo "First Name: <input type=\"text\" name=\"fname\" value=" . $MoFName . "><br>";
		echo "Last Name: <input type=\"text\" name=\"lname\"  value=" . $MoLName . "><br>";
		echo "Date: " . $CoDate . "<br>";
		echo "Meal: " . $CoMeal . "<br>";
		echo "<input type=\"hidden\" name=\"date\" value=\"$CoDate\">";
		echo "<input type=\"hidden\" name=\"meal\" value=\"$CoMeal\">";
		echo "<input type=\"hidden\" name=\"SdKey\" value=\"$CoSdKey\">";
		echo "<input type=\"hidden\" name=\"MoKey\" value=\"$MoKey\">";
		echo "<input type=\"submit\">";
		echo "</form>";
		}
	else {
		echo "Still not committed!";
		}
	
	$dbObj->close_DataBase();
	GenerateBottom();    
	return true;
	}
}

class InsertCommit implements IPage
{
  public function nextPage( $name, $args )
  {
    if ( $name != 'InsertCommit' ) return false;
	GenerateTop();
	$oldDate = $args[0];
	$oldMeal = $args[1];
	$oldFName = $args[2];
	$oldLName = $args[3];
	$oldSDKey = $args[4];
	$oldMOKey = $args[5];

	$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
	$commitRS = $dbObj->getCommitByKey($oldSDKey, $oldMOKey);

	$moshgiachRS = $dbObj->getMoshgiachByKey($oldMOKey);

		/* Business Logic: Deal with date/ if none - update the date table */
		$resultDate = $dbObj->getDateByDateMeal($oldDate, $oldMeal);
		$countDate = $dbObj->getCount($resultDate);
		if($countDate < 1){
			echo "Inside if... $oldDate, $oldMeal";
			$dbObj->insertDate($oldDate, $oldMeal);
			/* find the assigned date key */
			$resultDate = $dbObj->getDateByDateMeal($oldDate, $oldMeal);
			}
		echo "<br>Processing moshgiach... $oldFName, $oldLName";
		/* Business Logic: Deal with moshgiach / if none - crash and burn */
		$resultMoshgiach = $dbObj->getMoshgiachByName($oldFName, $oldLName);
		$countMoshgiach = $dbObj->getCount($resultMoshgiach);
		if($countMoshgiach < 1){
			echo "Please enter the moshgiach first...";
			//echo $countMoshgiach;
			
			//header('Location: ./AddMoshgiach.php');
			}
		else {
			echo "<br>Result: " . $countMoshgiach;
			//$row = $dbObj->getNextArray($resultMoshgiach);
			//$mKey = $row['MoKey'];

			//$row = $dbObj->getNextArray($resultDate);
			//$dKey = $row['SdKey'];
			//only one commit per date/meal row
			$dbObj->deleteCommit($oldSDKey);
			$dbObj->insertCommit($oldDate, $oldMeal, $oldMOKey, $oldSDKey);
			}
	$dbObj->close_DataBase();
	GenerateBottom();    
	return true;
	}
}


class ListMoshgichim implements IPage
{
  public function nextPage( $name, $args )
  {
    if ( $name != 'ListMoshgichim' ) return false;
	GenerateTop();
	$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
	$rs = $dbObj->getList("M");
	echo "<table>";
	$i = 0;
	while($row = mysql_fetch_array($rs))
		{
		if($i==0){
			echo "<tr>";
			}
		$j = $i % 2;
		if(($i>0)&&($j<1)){
			echo "</tr><tr>";
			}
		$em = $row['MoEMail'];
		echo "<td><a href='Navigator.php?page=GetMoshgiach&MoKey=" . 
				$row['MoKey'] . "'><p class=\"footerChange\" onMouseOver=displayFooter('$em') onMouseOut=clearFooter()>" .
				$row['MoFName'] . " " . $row['MoLName'] . "</p></a></td>";
		$i++;
		}
	echo "</tr></table>";	
	$dbObj->close_DataBase();
	GenerateBottom();    
	return true;
	}
}

class ListCommit implements IPage
{
  public function nextPage( $name, $args )
  {
    if ( $name != 'ListCommit' ) return false;
	GenerateTop();
	$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
	$rs = $dbObj->getList("C");

		while($row = mysql_fetch_array($rs))
			{
			$dt = $row['CoDate'];
			$ml = $row['CoMeal'];
			$ky = $row['CoMoKey'];
			$sdKy = $row['CoSdKey'];
			$mo = $row['MoFName'] . " " . $row['MoLName'];
			echo "<a href='Navigator.php?page=GetDate&SdKey=" . $sdKy . "'>" . $dt . " " . $ml . " [" . $mo . "]</a>";
			echo "<br>";
			}
			
	$dbObj->close_DataBase();
	GenerateBottom();    
	return true;
	}
}

class GetMoshgiach implements IPage
{
  public function nextPage( $name, $args )
  {
    if ( $name != 'GetMoshgiach' ) return false;
	GenerateTop();
	$mKey = $args[0]; 

	$dbObj = DataBase_Object_Factory::getFactory()->getDataBase_Access();
	$resultSet = $dbObj->getMoshgiachByKey($mKey);

	echo "<a href=\"DeleteMoshgiach.php?MoKey=" . $mKey . "\"><input type=\"submit\" value=\"Delete?\"/></a>";
	echo "<a href=\"EditMoshgiach.php?MoKey=" . $mKey . "\"><input type=\"submit\" value=\"Edit?\"/></a><br><br>";

	while($row = mysql_fetch_array($resultSet))
		{
		echo $row['MoFName'] . " " . $row['MoLName'] . " [" . $row['MoEMail'] . "]";
		echo "<br>";
		}

	//Set up the query
	$commitRS = $dbObj->getCommitByMoKey($mKey);

	while($row = mysql_fetch_array($commitRS))
		{
		echo $row['CoDate'] . " " . $row['CoMeal'];
		echo "<br>";
		}
	
	$dbObj->close_DataBase();
	GenerateBottom();    
	return true;
	}
}

class AddDate implements IPage
{
  public function nextPage( $name, $args )
  {
    if ( $name != 'AddDate' ) return false;
	GenerateTop();

	echo "<form action=\"../InsertDate.php\" method=\"post\">";
	echo "New Date (ccyy-mm-dd): <input type=\"text\" name=\"date\"><br>";
	echo "Meal: <input type=\"text\" name=\"meal\"><br>";
	echo "Moshgiach First Name (or blank): <input type=\"text\" name=\"fname\"><br>";
	echo "Moshgiach Last Name (or blank): <input type=\"text\" name=\"lname\"><br>";
	echo "<input type=\"submit\">";
	echo "</form>";

	GenerateBottom();    
	return true;
	}
}

?>
