<?php
// Data Objects...

class SchedDate
{
  var $SdDate = "";
  var $SdMeal = "";
  var $SdKey = 0;
  
  function SchedDate($SdDate, $SdMeal, $SdKey)
  {
    $this->SdDate = $SdDate;
    $this->SdMeal = $SdMeal;
    $this->SdKey = $SdKey;
  }
}

class Moshgiach
{
  var $MoFName = "";
  var $MoLName = "";
  var $MoEMail = "";
  var $MoKey = 0;
  
  function Moshgiach($MoFName, $MoLName, $MoEMail, $MoKey)
  {
    $this->MoFName = $MoFName;
    $this->MoLName = $MoLName;
    $this->MoEMail = $MoEMail;
	$this->MoKey = $MoKey;
  }
}

class Commit
{
  var $CoDate = "";
  var $CoMeal = "";
  var $CoMoKey = 0;
  var $CoSdKey = 0;
  
  function Commit($CoDate, $CoMeal, $CoMoKey, $CoSdKey)
  {
    $this->CoDate = $CoDate;
    $this->CoMeal = $CoMeal;
    $this->CoMoKey = $CoMoKey;
    $this->CoSdKey = $CoSdKey;
  }
}

// Data Object Factories

class MoshgiachFactory
{
  function &create(&$record)
  {
    return new Moshgiach($record["MoFName"], $record["MoLName"], $record["MoEMail"], $record["MoKey"]);
  }
}

class SchedDateFactory
{
  function &create(&$record)
  {
    return new Person($record["SdDate"], $record["SdMeal"], $record["SdKey"]);
  }
}


class CommitFactory
{
  function &create(&$record)
  {
    return new Commit($record["CoDate"], $record["CoMeal"], $record["CoMoKey"], $record["CoSdKey"]);
  }
}

// database access...

class DB
{
  /*
   * @param $url: "localhost"
   * @param $user: "root"
   * @param $pwd: ""
   * @param $db: "MoshSched"
   */
   var $url = "";
   var $user = "";
   var $pwd = "";
   var $db = "";
   
  function DB($url, $user, $pwd, $db)
  {
    $this->url = $url;
    $this->user = $user;
    $this->pwd = $pwd;
	$this->db = $db;
  }

  function &DBSetup()
  {
  $con = mysql_connect($this->url,$this->user,$this->pwd);
  if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db($this->db, $con);
  }
  
  // returns an array of instances
  function &queryArray($sql, &$factory)
  {
    $queryID = mysql_query($sql);
    $ret = array();
    if ($queryID)
    {
      while ( $record = mysql_fetch_array($queryID) )
      {
        $ret[] = $factory->create($record);
      }
      mysql_free_result($queryID);
    }
    return $ret;
  }
  
  // Returns a single instance
  function &querySingle($sql, &$factory)
  {
    $queryID = mysql_query($sql);
    if ($queryID)
    {
      if ( $record = mysql_fetch_array($queryID) )
      {
        mysql_free_result($queryID);
        return $factory->create($record);
      }
    }
    return false;
  }
}


class MoshgiachDB
{
  function &findByID($MoKey)
  {
    return DB::querySingle("SELECT * FROM Moshgiach WHERE MoKey = $MoKey", new MoshgiachFactory());
  }

  function &findByName($MoFName, $MoLName)
  {
    return DB::querySingle("SELECT * FROM Moshgiach WHERE MoFName = $MoFName AND MoLName = $MoLName", new MoshgiachFactory());
  }
  
  function &findALL()
  {
    return DB::queryArray("SELECT * FROM Moshgiach", new MoshgiachFactory());
  }
}

class SchedDateDB
{
  function &findByID($SdKey)
  {
    return DB::querySingle("SELECT * FROM SchedDate WHERE SdKey = $SdKey", new SchedDateFactory());
  }

  function &findByDateMeal($SdDate, $SdMeal)
  {
    return DB::querySingle("SELECT * FROM Moshgiach WHERE SdDate = $SdDate AND SdMeal = $SdMeal", new SchedDateFactory());
  }
  
  function &findALL()
  {
    return DB::queryArray("SELECT * FROM SchedDate", new SchedDateFactory());
  }
 
  function &findALLFuture()
  {
    return DB::queryArray("SELECT * FROM SchedDate WHERE SdDate > CURRENT_DATE", new SchedDateFactory());
  }
}

class CommitDB
{
  function &findByID($CoKey)
  {
    return DB::querySingle("SELECT * FROM Commit WHERE CoKey = $CoKey", new CommitFactory());
  }

  function &findByDateMeal($CoDate, $CoMeal)
  {
    return DB::queryArray("SELECT * FROM Commit WHERE CoDate = $CoDate AND CoMeal = $CoMeal", new CommitFactory());
  }
  
  function &findALL()
  {
    return DB::queryArray("SELECT * FROM Commit", new CommitFactory());
  }
 
  function &findALLFuture()
  {
    return DB::queryArray("SELECT * FROM Commit WHERE CoDate > CURRENT_DATE", new CommitFactory());
  }
?>


