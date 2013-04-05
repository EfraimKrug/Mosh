<?php
/*
 * Database access object- 
 * @return - record set - either 1 row, many rows, or empty
 * @param -
 */
interface DataBase_Interface
{
	public function getList($type);
	public function getSingleSchedDate($SdKey);
	public function getListSchedDate();
	public function getListbyDateMeal($SdDate, $SdMeal);
//	public function setSchedDate($SchedDate);
//	public function deleteSchedDate($SdKey);

//	public function getSingleMoshgiach($MoKey);
//	public function getListMoshgiach();
//	public function setMoshgiach($Moshgiach);
//	public function deleteMoshgiach($MoKey);

//	public function getSingleCommit($CoKey);
//	public function getListCommit();
//	public function setCommit($Commit);
//	public function deleteCommit($CoKey);	
}


class DataBase_Access implements DataBase_Interface
{
	/*
	 * Open the database connection and sign in...
	 */
	function DataBase_Access($url, $user, $pwd, $db)
	{
		$this->url = $url;
		$this->user = $user;
		$this->pwd = $pwd;
		$this->db = $db;
		$this->con = mysql_connect($this->url,$this->user,$this->pwd);
		
		if (!$this->con)
			{
			die('Could not connect: ' . mysql_error());
			}
		mysql_select_db($this->db, $this->con);
	}
	
	/*
	 * Close the database
	 */
	public function close_DataBase()
	{
		mysql_close($this->con);
	}
	
	/*
	 * Specific database sql statements 
	 * @return recordset
	 */
	public function getListSchedDate()
	{
		try 
		{
		$sql = "SELECT * FROM SchedDate WHERE SdDate > CURRENT_DATE ORDER BY SdDate ASC";		
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}
	
	/*
	 * Generic list table request
	 * @param $type = {"SD", "M", "C"}
	 * @return recordset
	 */
	public function getList($type)
	{
		try 
		{
		if($type == "SD"){
			$sql = "SELECT * FROM SchedDate WHERE SdDate > CURRENT_DATE ORDER BY SdDate ASC";		
			} else if($type == "M") {
			$sql = "SELECT * FROM Moshgiach";
			} else if($type == "C") {
			$sql = "SELECT * FROM Commit, Moshgiach WHERE CoMoKey = MoKey";
			}
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}
	
	/*
	 * @return - could be multiple records, one record or empty
	 */
	public function getSingleSchedDate($SdKey)
	{
		try 
		{
		$sql = "SELECT * FROM SchedDate WHERE SdKey = " . $SdKey;		
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}

	public function getListbyDateMeal($SdDate, $SdMeal)
	{
		try 
		{
		$sql = "SELECT m.MoFName, m.MoLName, m.MoEMail, s.SdDate, s.SdMeal, c.CoMoKey, c.CoSdKey " . 
			"FROM Moshgiach m, SchedDate s, Commit c " .
			"WHERE  m.MoKey = c.CoMoKey AND s.SdKey = c.CoSdKey " .
			"AND s.SdDate = \"" . $SdDate . "\" AND s.SdMeal = \"" . $SdMeal . "\";";
		//echo $sql;
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}

	public function getDateByKey($SdKey)
	{
	
		try 
		{
		$sql = "SELECT * FROM SchedDate " . 
			"WHERE SdKey = " . $SdKey . ";";
		
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}

	public function getDateByDateMeal($SdDate, $SdMeal)
	{
	
		try 
		{
		$sql = "SELECT * FROM SchedDate " . 
			"WHERE SdDate = '" . $SdDate . "' AND SdMeal = '" . $SdMeal . "';";
		
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}

	public function insertDate($SdDate, $SdMeal)
	{
	
		try 
		{
		$sql = "INSERT INTO SchedDate (SdDate, SdMeal) VALUES ('$SdDate', '$SdMeal')";		
		mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return;	
	}

	public function insertCommit($CoSdDate, $CoSdMeal, $CoMoKey, $CoSdKey)
	{
	
		try 
		{
		$sql = "INSERT INTO Commit (CoDate, CoMeal, CoMoKey, CoSdKey) VALUES ('$CoSdDate', '$CoSdMeal', '$CoMoKey', '$CoSdKey')";		
		echo $sql;
		mysql_query($sql);
		
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return;	
	}

	public function deleteCommit($CoSdKey)
	{
	
		try 
		{
		$sql = "DELETE FROM Commit WHERE CoSdKey = " . $CoSdKey;
		mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return;
	}

	public function getCommitByKey($SdKey, $MoKey)
	{
	
		try 
		{
		$sql = "SELECT * FROM Commit " . 
			"WHERE CoSdKey = " . $SdKey . " AND CoMoKey = " . $MoKey;
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}

	public function getCommitByMoKey($MoKey)
	{
	
		try 
		{
		$sql = "SELECT * FROM Commit " . 
			"WHERE CoSdKey = " . $MoKey;
		
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}

	public function getMoshgiachByKey($MoKey)
	{
	
		try 
		{
		$sql = "SELECT * FROM Moshgiach " . 
			"WHERE MoKey = " . $MoKey . ";";
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}

	public function getMoshgiachByName($MoFName, $MoLName)
	{
	
		try 
		{
		$sql = "SELECT * FROM Moshgiach " . 
			"WHERE MoFName = '" . $MoFName . "' AND MoLName = '" . $MoLName . "';";
		//echo $sql;
		
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		//echo "getMoshgiachByName: " . $MoFName . " " . $MoLName;
		return $resultSet;		
	}
	
	public function getManyRows($sql)
	{
		try 
		{		
		$resultSet = mysql_query($sql);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $resultSet;		
	}

	public function getCount($rs)
	{
		try 
		{		
			$count = mysql_num_rows($rs);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $count;		
	}

	public function getNextArray($rs)
	{
		try 
		{		
		$row = mysql_fetch_array($rs);
		} 
		catch(Exception $e)
		{
			throw new DataBaseException('DataBase Problems... ', $e);
		}
		return $row;		
	}
	
}

class DataBase_Object_Factory
{
	private static $_instance;
 
	public function __construct()
	{
	}
 
	/**
	 * Set the factory instance
	 * @param DataBase_Object_Factory $f
	 */
	public static function setFactory(DataBase_Object_Factory $f)
	{
		self::$_instance = $f;
	}
 
	/**
	 * Get a factory instance. 
	 * @return DataBase_Object_Factory
	 */
	public static function getFactory()
	{
		if(!self::$_instance)
			self::$_instance = new self;
 
		return self::$_instance;
	}
 
	/**
	 * 
	 * @return implementation of DataBase_Interface
	 */
	public function getDataBase_Access()
	{
		return new DataBase_Access("Localhost", "root", "", "MoshSched");
	}
}

class DataBaseException extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function customFunction() {
        echo "A custom function for this type of exception\n";
    }
}

?>

