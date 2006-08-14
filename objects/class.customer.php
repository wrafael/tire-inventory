<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `customer` (
	`customerid` int(11) auto_increment,
	`company` VARCHAR(255),
	`firstname` VARCHAR(255),
	`lastname` VARCHAR(255),
	`address1` VARCHAR(255),
	`address2` VARCHAR(255),
	`city` VARCHAR(255),
	`mobile` VARCHAR(255),
	`landline` VARCHAR(255),
	`email` VARCHAR(255),
	`limit` Decimal(10,2),
	`available` Decimal(10,2),
	`deleted` TINYINT, PRIMARY KEY  (`customerid`));
*/

/**
* <b>Customer</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.0.1 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Customer&attributeList=array+%28%0A++0+%3D%3E+%27company%27%2C%0A++1+%3D%3E+%27firstname%27%2C%0A++2+%3D%3E+%27lastname%27%2C%0A++3+%3D%3E+%27address1%27%2C%0A++4+%3D%3E+%27address2%27%2C%0A++5+%3D%3E+%27city%27%2C%0A++6+%3D%3E+%27mobile%27%2C%0A++7+%3D%3E+%27landline%27%2C%0A++8+%3D%3E+%27email%27%2C%0A++9+%3D%3E+%27limit%27%2C%0A++10+%3D%3E+%27available%27%2C%0A++11+%3D%3E+%27deleted%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++7+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++8+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++9+%3D%3E+%27Decimal%2810%2C2%29%27%2C%0A++10+%3D%3E+%27Decimal%2810%2C2%29%27%2C%0A++11+%3D%3E+%27TINYINT%27%2C%0A%29
*/
class Customer
{
	public $customerId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $company;
	
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
	public $address1;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $address2;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $city;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $mobile;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $landline;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $email;
	
	/**
	 * @var Decimal(10,2)
	 */
	public $limit;
	
	/**
	 * @var Decimal(10,2)
	 */
	public $available;
	
	/**
	 * @var TINYINT
	 */
	public $deleted;
	
	public $pog_attribute_type = array(
		"customerid" => array("NUMERIC", "INT"),
		"company" => array("TEXT", "VARCHAR", "255"),
		"firstname" => array("TEXT", "VARCHAR", "255"),
		"lastname" => array("TEXT", "VARCHAR", "255"),
		"address1" => array("TEXT", "VARCHAR", "255"),
		"address2" => array("TEXT", "VARCHAR", "255"),
		"city" => array("TEXT", "VARCHAR", "255"),
		"mobile" => array("TEXT", "VARCHAR", "255"),
		"landline" => array("TEXT", "VARCHAR", "255"),
		"email" => array("TEXT", "VARCHAR", "255"),
		"limit" => array("NUMERIC", "DECIMAL", "10,2"),
		"available" => array("NUMERIC", "DECIMAL", "10,2"),
		"deleted" => array("NUMERIC", "TINYINT"),
		);
	public $pog_query;
	
	function Customer($company='', $firstname='', $lastname='', $address1='', $address2='', $city='', $mobile='', $landline='', $email='', $limit='', $available='', $deleted='')
	{
		$this->company = $company;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->address1 = $address1;
		$this->address2 = $address2;
		$this->city = $city;
		$this->mobile = $mobile;
		$this->landline = $landline;
		$this->email = $email;
		$this->limit = $limit;
		$this->available = $available;
		$this->deleted = $deleted;
	}
	
	
	/**
	* Gets object from database
	* @param integer $customerId 
	* @return object $Customer
	*/
	function Get($customerId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `customer` where `customerid`='".intval($customerId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->customerId = $Database->Result(0, "customerid");
		$this->company = $Database->Unescape($Database->Result(0, "company"));
		$this->firstname = $Database->Unescape($Database->Result(0, "firstname"));
		$this->lastname = $Database->Unescape($Database->Result(0, "lastname"));
		$this->address1 = $Database->Unescape($Database->Result(0, "address1"));
		$this->address2 = $Database->Unescape($Database->Result(0, "address2"));
		$this->city = $Database->Unescape($Database->Result(0, "city"));
		$this->mobile = $Database->Unescape($Database->Result(0, "mobile"));
		$this->landline = $Database->Unescape($Database->Result(0, "landline"));
		$this->email = $Database->Unescape($Database->Result(0, "email"));
		$this->limit = $Database->Unescape($Database->Result(0, "limit"));
		$this->available = $Database->Unescape($Database->Result(0, "available"));
		$this->deleted = $Database->Unescape($Database->Result(0, "deleted"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $customerList
	*/
	static function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$customerList = Array();
			$Database = new DatabaseConnection();
			$pog_query = "select customerid from `customer` where ";
			for ($i=0, $c=sizeof($fcv_array)-1; $i<$c; $i++)
			{
				$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$Database->Escape($fcv_array[$i][2])."' AND";
			}
			$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$Database->Escape($fcv_array[$i][2])."' order by customerid asc $sqlLimit";
			$Database->Query($pog_query);
			for($i=0; $i < $Database->Rows(); $i++)
			{
				$customer = new Customer();
				$customer->Get($Database->Result($i, "customerid"));
				$customerList[] = $customer;
			}
			if ($sortBy != '')
			{
				$f = '';
				$customer = new Customer();
				if (isset($customer->pog_attribute_type[strtolower($sortBy)]) && $customer->pog_attribute_type[strtolower($sortBy)][0] == "NUMERIC")
				{
					$f = 'return $customer1->'.$sortBy.' > $customer2->'.$sortBy.';';
				}
				else if (isset($customer->pog_attribute_type[strtolower($sortBy)]))
				{
					$f = 'return strcmp(strtolower($customer1->'.$sortBy.'), strtolower($customer2->'.$sortBy.'));';
				}
				usort($customerList, create_function('$customer1, $customer2', $f));
				if (!$ascending)
				{
					$customerList = array_reverse($customerList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($customerList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($customerList, 0, $limit);
					}
				}
			}
			return $customerList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $customerId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select customerid from `customer` where `customerid`='".$this->customerId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `customer` set 
			`company`='".$Database->Escape($this->company)."', 
			`firstname`='".$Database->Escape($this->firstname)."', 
			`lastname`='".$Database->Escape($this->lastname)."', 
			`address1`='".$Database->Escape($this->address1)."', 
			`address2`='".$Database->Escape($this->address2)."', 
			`city`='".$Database->Escape($this->city)."', 
			`mobile`='".$Database->Escape($this->mobile)."', 
			`landline`='".$Database->Escape($this->landline)."', 
			`email`='".$Database->Escape($this->email)."', 
			`limit`='".$Database->Escape($this->limit)."', 
			`available`='".$Database->Escape($this->available)."', 
			`deleted`='".$Database->Escape($this->deleted)."' where `customerid`='".$this->customerId."'";
		}
		else
		{
			$this->pog_query = "insert into `customer` (`company`, `firstname`, `lastname`, `address1`, `address2`, `city`, `mobile`, `landline`, `email`, `limit`, `available`, `deleted` ) values (
			'".$Database->Escape($this->company)."', 
			'".$Database->Escape($this->firstname)."', 
			'".$Database->Escape($this->lastname)."', 
			'".$Database->Escape($this->address1)."', 
			'".$Database->Escape($this->address2)."', 
			'".$Database->Escape($this->city)."', 
			'".$Database->Escape($this->mobile)."', 
			'".$Database->Escape($this->landline)."', 
			'".$Database->Escape($this->email)."', 
			'".$Database->Escape($this->limit)."', 
			'".$Database->Escape($this->available)."', 
			'".$Database->Escape($this->deleted)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->customerId == "")
		{
			$this->customerId = $Database->GetCurrentId();
		}
		return $this->customerId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $customerId
	*/
	function SaveNew()
	{
		$this->customerId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `customer` where `customerid`='".$this->customerId."'";
		return $Database->Query($this->pog_query);
	}
}
?>