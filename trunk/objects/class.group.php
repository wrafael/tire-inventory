<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `group` (
	`groupid` int(11) auto_increment,
	`name` VARCHAR(255),
	`desc` VARCHAR(255), PRIMARY KEY  (`groupid`));
*/

/**
* <b>Group</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.0.1 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Group&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27desc%27%2C%0A++2+%3D%3E+%27user%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27HASMANY%27%2C%0A%29
*/
class Group
{
	public $groupId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $desc;
	
	/**
	 * @var private array of user objects
	 */
	private $_userList;
	
	public $pog_attribute_type = array(
		"groupid" => array("NUMERIC", "INT"),
		"name" => array("TEXT", "VARCHAR", "255"),
		"desc" => array("TEXT", "VARCHAR", "255"),
		"_userlist" => array("OBJECT", "HASMANY"),
		);
	public $pog_query;
	
	function Group($name='', $desc='')
	{
		$this->name = $name;
		$this->desc = $desc;
		$this->_userList = array();
	}
	
	
	/**
	* Gets object from database
	* @param integer $groupId 
	* @return object $Group
	*/
	function Get($groupId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `group` where `groupid`='".intval($groupId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->groupId = $Database->Result(0, "groupid");
		$this->name = $Database->Unescape($Database->Result(0, "name"));
		$this->desc = $Database->Unescape($Database->Result(0, "desc"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $groupList
	*/
	static function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$groupList = Array();
			$Database = new DatabaseConnection();
			$pog_query = "select groupid from `group` where ";
			for ($i=0, $c=sizeof($fcv_array)-1; $i<$c; $i++)
			{
				$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$Database->Escape($fcv_array[$i][2])."' AND";
			}
			$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$Database->Escape($fcv_array[$i][2])."' order by groupid asc $sqlLimit";
			$Database->Query($pog_query);
			for($i=0; $i < $Database->Rows(); $i++)
			{
				$group = new Group();
				$group->Get($Database->Result($i, "groupid"));
				$groupList[] = $group;
			}
			if ($sortBy != '')
			{
				$f = '';
				$group = new Group();
				if (isset($group->pog_attribute_type[strtolower($sortBy)]) && $group->pog_attribute_type[strtolower($sortBy)][0] == "NUMERIC")
				{
					$f = 'return $group1->'.$sortBy.' > $group2->'.$sortBy.';';
				}
				else if (isset($group->pog_attribute_type[strtolower($sortBy)]))
				{
					$f = 'return strcmp(strtolower($group1->'.$sortBy.'), strtolower($group2->'.$sortBy.'));';
				}
				usort($groupList, create_function('$group1, $group2', $f));
				if (!$ascending)
				{
					$groupList = array_reverse($groupList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($groupList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($groupList, 0, $limit);
					}
				}
			}
			return $groupList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $groupId
	*/
	function Save($deep = true)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select groupid from `group` where `groupid`='".$this->groupId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `group` set 
			`name`='".$Database->Escape($this->name)."', 
			`desc`='".$Database->Escape($this->desc)."'where `groupid`='".$this->groupId."'";
		}
		else
		{
			$this->pog_query = "insert into `group` (`name`, `desc`) values (
			'".$Database->Escape($this->name)."', 
			'".$Database->Escape($this->desc)."')";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->groupId == "")
		{
			$this->groupId = $Database->GetCurrentId();
		}
		if ($deep)
		{
			$userList = $this->GetUserList();
			foreach ($this->_userList as $user)
			{
				$user->Save($deep);
			}
		}
		return $this->groupId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $groupId
	*/
	function SaveNew()
	{
		$this->groupId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete($deep = false)
	{
		if ($deep)
		{
			$userList = $this->GetUserList();
			foreach ($userList as $user)
			{
				$user->Delete($deep);
			}
		}
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `group` where `groupid`='".$this->groupId."'";
		return $Database->Query($this->pog_query);
	}
	
	
	/**
	* Gets a list of user objects associated to this one
	* @return boolean
	*/
	function GetUserList()
	{
		$user = new user();
		$this->_userList = array_merge($this->_userList, $user->GetList(array(array("groupId", "=", $this->groupId))));
		return $this->_userList;
	}
	
	
	/**
	* Associates the user object to this one
	* @return 
	*/
	function AddUser(&$user)
	{
		$this->_userList[] =& $user;
		$user->groupId = $this->groupId;
	}
}
?>