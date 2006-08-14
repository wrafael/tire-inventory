<?php
require('smarty/libs/Smarty.class.php');
require_once('includes/Session.php');
require_once('configuration.php');
require_once('objects/class.database.php');
$smarty = new Smarty();
$smarty->template_dir = '.';
$smarty->compile_dir = 'smarty/templates_c';
$smarty->assign('company', $configuration['company']);
$smarty->assign('address', $configuration['address']);
$smarty->assign('devurl', $configuration['devurl']);
$smarty->assign('developer', $configuration['developer']);
$cmd = @$_REQUEST['cmd'];
$tsk = @$_REQUEST['tsk'];
// catch user requests
switch($cmd){
  // user logs in
  case 'login': // user logs in
		$smarty->assign('title', "Tire Inventory | User Login");
		if (@$_POST['username'] != ''){	  
		  require_once('objects/class.user.php');
		  $user = new User();  
			$userlist = $user->GetList(array(array('username','=',@$_REQUEST['username'])));
			if(count($userlist) > 0){
			   $user = $userlist[0];
			}
			else{
			  $smarty->assign('message', 'Username not found.');
        $smarty->display('templates/login.tpl');	  
	  		exit;
			}
		}
		if($user->password != @$_POST['password']){
		  $smarty->assign('title', "Tire Inventory | User Login");
		  $smarty->assign('message','Password mismatch');
      $smarty->display('templates/login.tpl');	  
			exit;
		}
		if($user->disabled == 1){
		  $smarty->assign('title', "Tire Inventory | User Login");
		  $smarty->assign('message','Username Denied.');
      $smarty->display('templates/login.tpl');	  
			exit;
		}
		require_once('includes/Session.php');
		$session = new Session();
		$session->set('currentuserid',$user->userId);
		DisplayDefaultData();
		$smarty->assign('lastlogin',$user->lastlogin);
		$user->lastlogin = time();
		$user->save();
		$smarty->assign('title', "Tire Inventory | Main");
		$smarty->assign('motd', 'Good Day '.$user->firstname.'!');
		$smarty->assign('message', 'message of the day');
		$smarty->display('templates/index.tpl');
		break;	
	// user logs out
	case 'logout': // user logs out
	  $session = new Session();
	  $session->destroy();
		$smarty->assign('title', "Tire Inventory | User Login");
	  $smarty->display('templates/login.tpl');
	  break;
	// user related commands
	case 'user':
	  DisplayDefaultData();
	  if(isLogin()){
			switch($tsk){
				case 'edituser':
					$grpilist = array();
					$grpnlist = array();
					GetSelectContent('group', $grpilist, $grpnlist);
					$smarty->assign('grpilist',$grpilist);
					$smarty->assign('grpnlist',$grpnlist);
					require_once('objects/class.user.php');
					$user = new User();
					$user->Get(@$_REQUEST['uid']);
					$smarty->assign('userid',$user->userId);
					$smarty->assign('username',$user->username);
					$smarty->assign('password',$user->password);
					$smarty->assign('firstname',$user->firstname);
					$smarty->assign('lastname',$user->lastname);
					$smarty->assign('question',$user->question);
					$smarty->assign('answer',$user->answer);
					$smarty->assign('groupid',$user->groupId);
					$smarty->assign('title', "Tire Inventory | Edit User");
					$smarty->display('templates/edituser.tpl');
					break;
			} // end switch($tsk)
		} // end if(isLogin())
	  break;
	case 'setup':
	  DisplayDefaultData();
	  if(isLogin()){
			switch($tsk){
			  case 'addcustomer':
					$smarty->assign('title', "Tire Inventory | New Customer");
				  $smarty->display('templates/addcustomer.tpl');
		      break;
				case 'savecustomer':
				  require_once('objects/class.customer.php');
					if(@$_REQUEST['submit'] == 'Add Customer'){
					  $customer = new Customer();
						$customer->company = @$_REQUEST['company'];
						$customer->firstname = @$_REQUEST['firstname'];
						$customer->lastname = @$_REQUEST['lastname'];
						$customer->address1 = @$_REQUEST['address1'];
						$customer->address2 = @$_REQUEST['address2'];
						$customer->city = @$_REQUEST['city'];
						$customer->mobile = @$_REQUEST['mobile'];
						$customer->landline = @$_REQUEST['landline'];
						$customer->email = @$_REQUEST['email'];
						$customer->limit = @$_REQUEST['limit'];
						$customer->available = @$_REQUEST['limit'];
						$customer->deleted = 0;
						$custid = $customer->save();
						if($custid){
							$smarty->assign('motd', 'CUSTOMER ADDED');
							$smarty->assign('message', $customer->firstname.' '.$customer->lastname.' was successfully added into the database.');
						}
						else{
							$smarty->assign('error', 'ERROR ADDING '.@$_REQUEST['firstname'].' '.@$_REQUEST['lastname']);
							$smarty->assign('message', 'An error has occured while adding data, adding customer failed.');
						}
					}
					else{
						$smarty->assign('error', 'ERROR ADDING CUSTOMER');
						$smarty->assign('message', 'An error has occured while adding data, no data found.');
					}
					$smarty->assign('title','Tire Inventory | Add Customer');
					$smarty->display('templates/index.tpl');
				  break;
				case 'managecustomers':
				  require_once('objects/class.customer.php');
					$customer = new Customer();
					$custlist = $customer->GetList(array(array('customerId','>',0),array('deleted','=',0)));
					if(count($custlist)>0){
					  $customers = array();
					  foreach($custlist as $customer){
						  array_push($customers, array(
							  'customerid' => $customer->customerId,
								'company' => $customer->company,
								'firstname' => $customer->firstname,
								'lastname' => $customer->lastname,
								'mobile' => $customer->mobile,
								'landline' => $customer->landline,
								'limit' => $customer->limit,
								'available' => $customer->available,
								'deleted' => $customer->deleted)
							);
						}
						$smarty->assign('customers',$customers);
					}
					else{
					  $smarty->assign('motd', 'Customer Table Empty');
						$smarty->assign('message', 'No customers found in the database.');
					}
					$smarty->display('templates/managecustomers.tpl');
				  break;
				case 'addsupplier':
					$smarty->assign('title', "Tire Inventory | New Supplier");
				  $smarty->display('templates/addsupplier.tpl');
		      break;
				case 'managesuppliers':
				  require_once('objects/class.supplier.php');
					$supplier = new Supplier();
					$supplist = $supplier->GetList(array(array('supplierId','>',0),array('deleted','=',0)));
					if(count($supplist)>0){
					  $suppliers = array();
					  foreach($supplist as $supplier){
						  array_push($suppliers, array(
							  'supplierid' => $supplier->supplierId,
								'company' => $supplier->company,
								'address1' => $supplier->address1,
								'address2' => $supplier->address2,
								'city' => $supplier->city,
								'phone' => $supplier->phone,
								'contactname' => $supplier->contactname,
								'contactno' => $supplier->contactno,
								'deleted' => $supplier->deleted)
							);
						}
						$smarty->assign('suppliers',$suppliers);
					}
					else{
					  $smarty->assign('motd', 'Suppliers Table Empty');
						$smarty->assign('message', 'No suppliers found in the database.');
					}
					$smarty->display('templates/managesuppliers.tpl');
				  break;
				case 'savesupplier':
				  print "save supplier";
				  break;
			} //end switch(tstk)
		} // end if
	  break;
	// admin tasks
	case 'admin':
	  DisplayDefaultData();
	  if(isLogin()){
  	  switch($tsk){
			  // add new user
	  	  case 'adduser': 
					$grpilist = array();
					$grpnlist = array();
					GetSelectContent('group', $grpilist, $grpnlist);
					$smarty->assign('grpilist',$grpilist);
					$smarty->assign('grpnlist',$grpnlist);
		      $smarty->assign('title', "Tire Inventory | Add New User");
					$smarty->display('templates/adduser.tpl');
		  	  break;
				// delete user
				case 'deluser':
				  require_once('objects/class.user.php');
				  if(@$_REQUEST['uid']){
            $user = new User();
						$user->Get(@$_REQUEST['uid']);
						$user->disabled = 1;
						$userid = $user->save();	
					}
					if($userid){
					  $smarty->assign('motd','DELETE USER');
						$smarty->assign('message',$user->username.' was successfully deleted.');
					}
					else{
					  $smarty->assign('error','AN ERROR OCCOURED');
						$smarty->assign('message','An Error occoured while deleting '.$user->username);
					}
					$smarty->assign('title', "Tire Inventory | Delete User");
					$smarty->display('templates/index.tpl');
				  break;
				// save added user
				case 'saveuser':
				  require_once('objects/class.user.php');
  				if(@$_REQUEST['submit'] == 'Add User'){
						$user = new User();
						$userlist = $user->GetList(array(array('username','=',@$_REQUEST['username'])));
						if(count($userlist) > 0){
						  $smarty->assign('error', 'Error adding username'.@$_REQUEST['username']);
							$smarty->assign('message', 'A user with the same name already exists.');
						}
						else{
						  $user->username = @$_REQUEST['username'];
						  $user->password = @$_REQUEST['password'];
						  $user->firstname = @$_REQUEST['firstname'];
						  $user->lastname = @$_REQUEST['lastname'];
						  $user->question = @$_REQUEST['question'];
						  $user->answer = @$_REQUEST['answer'];
						  $user->groupId = @$_REQUEST['groupid'];
							$user->disabled = 0;
							$user->lastlogin = 0;
							$userid = $user->save();
							if($userid){
						    $smarty->assign('motd', 'User added '.@$_REQUEST['username']);
							  $smarty->assign('message', $user->firstname.' '.$user->lastname.' was successfully added into the database.');
							}
							else{
						    $smarty->assign('error', 'Error adding '.@$_REQUEST['username']);
							  $smarty->assign('message', 'An error has occured while adding data, adding user failed.');
							}
						}
					}
					elseif(@$_REQUEST['submit'] == 'Edit User'){
					  $user = new User();
						$user->Get(@$_REQUEST['uid']);
						$user->username = @$_REQUEST['username'];
						if(@$_REQUEST['password'] != '******')
						  $user->password = @$_REQUEST['password'];
						$user->firstname = @$_REQUEST['firstname'];
						$user->lastname = @$_REQUEST['lastname'];
						$user->question = @$_REQUEST['question'];
						$user->answer = @$_REQUEST['answer'];
						$user->groupId = @$_REQUEST['groupid'];
						$userid = $user->save();
						if($userid){
							$smarty->assign('motd', 'User edited '.@$_REQUEST['username']);
							$smarty->assign('message', $user->firstname.' '.$user->lastname.' was successfully changed into the database.');
						}
						else{
							$smarty->assign('error', 'Error editing '.@$_REQUEST['username']);
							$smarty->assign('message', 'An error has occured while editing data, edit user failed.');
						}
					}
					else{
						  $smarty->assign('error', 'Invalid Form');									
						  $smarty->assign('message', 'The system does not recognize the form being submitted.');
					}
					$smarty->display('templates/index.tpl');
				  break;
				// manage added users
				case 'manageusers':
					$grpilist = array();
					$grpnlist = array();
					GetSelectContent('group', $grpilist, $grpnlist);
					$smarty->assign('grpilist',$grpilist);
					$smarty->assign('grpnlist',$grpnlist);
					require_once('objects/class.user.php');
					$user = new User();
					$userlist = $user->GetList(array(array('userId','>',0),array('disabled','=',0)));
					if(count($userlist)>0){
					  $users = array();
					  foreach($userlist as $user){
						  array_push($users, array(
							  'userid' => $user->userId,
								'username' => $user->username,
								'firstname' => $user->firstname,
								'lastname' => $user->lastname,
								'groupid' => $user->groupId,
								'lastlogin' => $user->lastlogin,
								'disabled' => $user->disabled)
							);
						}
						$smarty->assign('users',$users);
					}
					else{
					  $smarty->assign('motd', 'Table Empty');
						$smarty->assign('message', 'No users found in the database.');
					}
					$smarty->display('templates/manageusers.tpl');
				  break;
				// user entered random tasks
				default:
				  $smarty->assign('error', 'Unknown Task');
					$smarty->assign('message', 'The system was not able to translate the task specified.');
				  $smarty->display('templates/index.tpl');
					break;
  		} // end switch($tsk)
		} // end if(isLogin)
	  break;
	// user entered a random command
	default:
	  DisplayDefaultData();
		$smarty->assign('title', "Tire Inventory | User Login");
		$smarty->display('templates/login.tpl');
}
// Display the default values in the sidebar
function DisplayDefaultData(){
  global $smarty;
	$session = new session();
	require_once('objects/class.user.php');
	$user = new User();
	$user->Get($session->get('currentuserid'));
	$smarty->assign('currentuserid', $user->userId);
	$smarty->assign('currentusername',$user->username);	
	$smarty->assign('currentfirst',$user->firstname);
	$smarty->assign('currentlast',$user->lastname);
}
// getcontents from a class and return an array of ids and names
// for display on a select box.
function GetSelectContent($class, &$objectid, &$objectname){
  $objectid = array();
	$objectname = array();
	require_once('objects/class.'.$class.'.php');
	$classname = ucfirst($class);                 // insure first letter is uppercase
	$object = new $classname;
	$objectlist = $object->GetList(array(array($class.'Id','>',0)));
	$idindex = $class.'Id';
	foreach($objectlist as $object){
  	array_push($objectid, $object->$idindex);
  	array_push($objectname, $object->name);
	}
}
//check if user is already logged.
function isLogin(){
  $session = new Session();
	if (!$session->get('currentuserid')) {
     header("Location: ". $_SERVER['PHP_SELF']);
	   exit;   
	}
	return true;
}
?>
