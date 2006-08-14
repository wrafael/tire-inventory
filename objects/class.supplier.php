<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `supplier` (
	`supplierid` int(11) auto_increment,
	`company` VARCHAR(255),
	`address1` VARCHAR(255),
	`address2` VARCHAR(255),
	`city` VARCHAR(255),
	`phone` VARCHAR(255),
	`contactname` VARCHAR(255),
	`contactno` VARCHAR(255),
	`deleted` VARCHAR(255), PRIMARY KEY  (`supplierid`));
*/

/**
* <b>Supplier</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 2.0.1 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Supplier&attributeList=array+%28%0A++0+%3D%3E+%27company%27%2C%0A++1+%3D%3E+%27address1%27%2C%0A++2+%3D%3E+%27address2%27%2C%0A++3+%3D%3E+%27city%27%2C%0A++4+%3D%3E+%27phone%27%2C%0A++5+%3D%3E+%27contactname%27%2C%0A++6+%3D%3E+%27contactno%27%2C%0A++7+%3D%3E+%27deleted%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++7+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
class Supplier
{
	public $supplierId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $company;
	
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
	public $phone;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $contactname;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $contactno;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $deleted;
	
	public $pog_attribute_type = array(
		"supplierid" => array("NUMERIC", "INT"),
		"company" => array("TEXT", "VARCHAR", "255"),
		"address1" => array("TEXT", "VARCHAR", "255"),
		"address2" => array("TEXT", "VARCHAR", "255"),
		"city" => array("TEXT", "VARCHAR", "255"),
		"phone" => array("TEXT", "VARCHAR", "255"),
		"contactname" => array("TEXT", "VARCHAR", "255"),
		"contactno" => array("TEXT", "VARCHAR", "255"),
		"deleted" => array("TEXT", "VARCHAR", "255"),
		);
	public $pog_query;
	
	function Supplier($company='', $address1='', $address2='', $city='', $phone='', $contactname='', $contactno='', $deleted='')
	{
		$this->company = $company;
		$this->address1 = $address1;
		$this->address2 = $address2;
		$this->city = $city;
		$this->phone = $phone;
		$this->contactname = $contactname;
		$this->contactno = $contactno;
		$this->deleted = $deleted;
	}
	
	
	/**
	* Gets object from database
	* @param integer $supplierId 
	* @return object $Supplier
	*/
	function Get($supplierId)
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select * from `supplier` where `supplierid`='".intval($supplierId)."' LIMIT 1";
		$Database->Query($this->pog_query);
		$this->supplierId = $Database->Result(0, "supplierid");
		$this->company = $Database->Unescape($Database->Result(0, "company"));
		$this->address1 = $Database->Unescape($Database->Result(0, "address1"));
		$this->address2 = $Database->Unescape($Database->Result(0, "address2"));
		$this->city = $Database->Unescape($Database->Result(0, "city"));
		$this->phone = $Database->Unescape($Database->Result(0, "phone"));
		$this->contactname = $Database->Unescape($Database->Result(0, "contactname"));
		$this->contactno = $Database->Unescape($Database->Result(0, "contactno"));
		$this->deleted = $Database->Unescape($Database->Result(0, "deleted"));
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $supplierList
	*/
	static function GetList($fcv_array, $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' && $sortBy == ''?"LIMIT $limit":'');
		if (sizeof($fcv_array) > 0)
		{
			$supplierList = Array();
			$Database = new DatabaseConnection();
			$pog_query = "select supplierid from `supplier` where ";
			for ($i=0, $c=sizeof($fcv_array)-1; $i<$c; $i++)
			{
				$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$Database->Escape($fcv_array[$i][2])."' AND";
			}
			$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$Database->Escape($fcv_array[$i][2])."' order by supplierid asc $sqlLimit";
			$Database->Query($pog_query);
			for($i=0; $i < $Database->Rows(); $i++)
			{
				$supplier = new Supplier();
				$supplier->Get($Database->Result($i, "supplierid"));
				$supplierList[] = $supplier;
			}
			if ($sortBy != '')
			{
				$f = '';
				$supplier = new Supplier();
				if (isset($supplier->pog_attribute_type[strtolower($sortBy)]) && $supplier->pog_attribute_type[strtolower($sortBy)][0] == "NUMERIC")
				{
					$f = 'return $supplier1->'.$sortBy.' > $supplier2->'.$sortBy.';';
				}
				else if (isset($supplier->pog_attribute_type[strtolower($sortBy)]))
				{
					$f = 'return strcmp(strtolower($supplier1->'.$sortBy.'), strtolower($supplier2->'.$sortBy.'));';
				}
				usort($supplierList, create_function('$supplier1, $supplier2', $f));
				if (!$ascending)
				{
					$supplierList = array_reverse($supplierList);
				}
				if ($limit != '')
				{
					$limitParts = explode(',', $limit);
					if (sizeof($limitParts) > 1)
					{
						return array_slice($supplierList, $limitParts[0], $limitParts[1]);
					}
					else
					{
						return array_slice($supplierList, 0, $limit);
					}
				}
			}
			return $supplierList;
		}
		return null;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $supplierId
	*/
	function Save()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "select supplierid from `supplier` where `supplierid`='".$this->supplierId."' LIMIT 1";
		$Database->Query($this->pog_query);
		if ($Database->Rows() > 0)
		{
			$this->pog_query = "update `supplier` set 
			`company`='".$Database->Escape($this->company)."', 
			`address1`='".$Database->Escape($this->address1)."', 
			`address2`='".$Database->Escape($this->address2)."', 
			`city`='".$Database->Escape($this->city)."', 
			`phone`='".$Database->Escape($this->phone)."', 
			`contactname`='".$Database->Escape($this->contactname)."', 
			`contactno`='".$Database->Escape($this->contactno)."', 
			`deleted`='".$Database->Escape($this->deleted)."' where `supplierid`='".$this->supplierId."'";
		}
		else
		{
			$this->pog_query = "insert into `supplier` (`company`, `address1`, `address2`, `city`, `phone`, `contactname`, `contactno`, `deleted` ) values (
			'".$Database->Escape($this->company)."', 
			'".$Database->Escape($this->address1)."', 
			'".$Database->Escape($this->address2)."', 
			'".$Database->Escape($this->city)."', 
			'".$Database->Escape($this->phone)."', 
			'".$Database->Escape($this->contactname)."', 
			'".$Database->Escape($this->contactno)."', 
			'".$Database->Escape($this->deleted)."' )";
		}
		$Database->InsertOrUpdate($this->pog_query);
		if ($this->supplierId == "")
		{
			$this->supplierId = $Database->GetCurrentId();
		}
		return $this->supplierId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $supplierId
	*/
	function SaveNew()
	{
		$this->supplierId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$Database = new DatabaseConnection();
		$this->pog_query = "delete from `supplier` where `supplierid`='".$this->supplierId."'";
		return $Database->Query($this->pog_query);
	}
}
?>