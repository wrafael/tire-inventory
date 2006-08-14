<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `user` (
	`userid` int(11) auto_increment,
	`username` VARCHAR(255),
	`password` VARCHAR(255),
	`firstname` VARCHAR(255),
	`lastname` VARCHAR(255),
	`question` VARCHAR(255),
	`answer` VARCHAR(255),
	`groupid` int(11),
	`lastlogin` INT,
	`disabled` TINYINT, PRIMARY KEY  (`userid`));
*/

/**
* <b>User</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.0.1 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=User&attributeList=array+%28%0A++0+%3D%3E+%27username%27%2C%0A++1+%3D%3E+%27password%27%2C%0A++2+%3D%3E+%27firstname%27%2C%0A++3+%3D%3E+%27lastname%27%2C%0A++4+%3D%3E+%27question%27%2C%0A++5+%3D%3E+%27answer%27%2C%0A++6+%3D%3E+%27group%27%2C%0A++7+%3D%3E+%27lastlogin%27%2C%0A++8+%3D%3E+%27disabled%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27BELONGSTO%27%2C%0A++7+%3D%3E+%27INT%27%2C%0A++8+%3D%3E+%27TINYINT%27%2C%0A%29
*/
class User
{
	public $userId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $username;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $password;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $firstname;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $lastname;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $question;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $answer;
	
	/**
	 * @var INT(11)
	 */
	public $groupId;
	
	/**
	 * @var INT
	 */
	public $lastlogin;
	
	/**
	 * @var TINYINT
	 */
	public $disabled;
	
	public $pog_attribute_type = array(
		"userid" => array("NUMERIC", "INT"),
		"username" => array("TEXT", "VARCHAR", "255"),
		"password" => array("TEXT", "VARCHAR", "255"),
		"firstname" => array("TEXT", "VARCHAR", "255"),
		"lastname" => array("TEXT", "VARCHAR", "255"),
		"question" => array("TEXT", "VARCHAR", "255"),
		"answer" => array("TEXT", "VARCHAR", "255"),
		"groupid" => array("OBJECT", "BELONGSTO"),
		"lastlogin" => array("NUMERIC", "INT"),
		"disabled" => array("NUMERIC", "TINYINT"),
		);
	public $pog_query;
	
	function User($username='', $password='', $firstname='', $lastname='', $question='', $answer='', $lastlogin='', $disabled='')
	{
		$this->username = $username;
		$this->password = $password;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->question = $question;
		$this->answer = $answer;
		$this->lastlogin = $lastlogin;
		$this->disabled = $disabled;
	}
	
	
	/**
	* Gets object from database
	* @param integer $userId 
	* @return object $User
	*/
	function Get($userId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `user` where `userid`='".intval($userId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->userId = $Database->Result(0, "userid");
		$this->username = $Database->Unescape($Database->Result(0, "username"));
		$this->password = $Database->Unescape($Database->Result(0, "password"));
		$this->firstname = $Database->Unescape($Database->Result(0, "firstname"));
		$this->lastname = $Database->Unescape($Database->Result(0, "lastname"));
		$this->question = $Database->Unescape($Database->Result(0, "question"));
		$this->answer = $Database->Unescape($Database->Result(0, "answer"));
		$this->groupId = $Database->Result(0, "groupid");
		$this->lastlogin = $Database->Unescape($Database->Result(0, "lastlogin"));
		$this->disabled = $Database->Unescape($Database->Result(0, "disabled"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $userList
	*/
	static function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$userList = Array();
			$Database = new DatabaseConnection();
			$pog_query = "select userid from `user` where ";
			for ($i=0, $c=sizeof($fcv_array)-1; $i<$c; $i++)
			{
				$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$Database->Escape($fcv_array[$i][2])."' AND";
			}
			$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$Database->Escape($fcv_array[$i][2])."' order by userid asc $sqlLimit";
			$Database->Query($pog_query);
			for($i=0; $i < $Database->Rows(); $i++)
			{
				$user = new User();
				$user->Get($Database->Result($i, "userid"));
				$userList[] = $user;
			}
			if ($sortBy != '')
			{
				$f = '';
				$user = new User();
				if (isset($user->pog_attribute_type[strtolower($sortBy)]) && $user->pog_attribute_type[strtolower($sortBy)][0] == "NUMERIC")
				{
					$f = 'return $user1->'.$sortBy.' > $user2->'.$sortBy.';';
				}
				else if (isset($user->pog_attribute_type[strtolower($sortBy)]))
				{
					$f = 'return strcmp(strtolower($user1->'.$sortBy.'), strtolower($user2->'.$sortBy.'));';
				}
				usort($userList, create_function('$user1, $user2', $f));
				if (!$ascending)
				{
					$userList = array_reverse($userList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($userList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($userList, 0, $limit);
					}
				}
			}
			return $userList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $userId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select userid from `user` where `userid`='".$this->userId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `user` set 
			`username`='".$Database->Escape($this->username)."', 
			`password`='".$Database->Escape($this->password)."', 
			`firstname`='".$Database->Escape($this->firstname)."', 
			`lastname`='".$Database->Escape($this->lastname)."', 
			`question`='".$Database->Escape($this->question)."', 
			`answer`='".$Database->Escape($this->answer)."', 
			`groupid`='".$this->groupId."', 
			`lastlogin`='".$Database->Escape($this->lastlogin)."', 
			`disabled`='".$Database->Escape($this->disabled)."' where `userid`='".$this->userId."'";
		}
		else
		{
			$this->pog_query = "insert into `user` (`username`, `password`, `firstname`, `lastname`, `question`, `answer`, `groupid`, `lastlogin`, `disabled` ) values (
			'".$Database->Escape($this->username)."', 
			'".$Database->Escape($this->password)."', 
			'".$Database->Escape($this->firstname)."', 
			'".$Database->Escape($this->lastname)."', 
			'".$Database->Escape($this->question)."', 
			'".$Database->Escape($this->answer)."', 
			'".$this->groupId."', 
			'".$Database->Escape($this->lastlogin)."', 
			'".$Database->Escape($this->disabled)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->userId == "")
		{
			$this->userId = $Database->GetCurrentId();
		}
		return $this->userId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $userId
	*/
	function SaveNew()
	{
		$this->userId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `user` where `userid`='".$this->userId."'";
		return $Database->Query($this->pog_query);
	}
	
	
	/**
	* Associates the group object to this one
	* @return boolean
	*/
	function GetGroup()
	{
		$group = new group();
		return $group->Get($this->groupId);
	}
	
	
	/**
	* Associates the group object to this one
	* @return 
	*/
	function SetGroup(&$group)
	{
		$this->groupId = $group->groupId;
	}
}
?>