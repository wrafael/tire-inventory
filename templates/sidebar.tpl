<br />
<div id="user-status">
	<div class="block-body-text">
	  {$smarty.now|date_format:"%A, %B %e, %Y"}<br />
		<br />
		User: <strong>{$currentusername}</strong><br />
		<a href="index.php?cmd=user&tsk=edituser&uid={$currentuserid}"><strong>{$currentlast}, {$currentfirst}</strong></a><br />
		{if $lastlogin}
		Last Login: {$lastlogin|date_format:"%m/%e/%Y"}<br />
		{/if}
		<a href="index.php?cmd=logout">Logout</a>
	</div>
</div>
<br />
<!--
<div id="inventory">
	<div id="block-head">
		Inventory
	</div>
	<div id="block-body">
		<div class="block-body-text">
			Add Item<br />
			Manage Inventories
		</div>
	</div>
</div>
<br />
<div id="receivables">
	<div id="block-head">
		Accounts Receivable
	</div>
	<div id="block-body">
		<div class="block-body-text">
			Add User<br />
		</div>
	</div>
</div>
<br />
<div id="payables">
	<div id="block-head">
		Accounts Payable
	</div>
	<div id="block-body">
		<div class="block-body-text">
			Add User<br />
			Logout
		</div>
	</div>
</div>
<br />
-->
<div id="setup">
	<div id="block-head">
		Setup
	</div>
	<div id="block-body">
		<div class="block-body-text">
		  Add Product<br />
			Manage Products<br />
			<a href="index.php?cmd=setup&tsk=addcustomer">Add New Customer</a><br />
			<a href="index.php?cmd=setup&tsk=managecustomers">Manage Customers</a><br />
			<a href="index.php?cmd=setup&tsk=addsupplier">Add New Supplier</a><br />
			<a href="index.php?cmd=setup&tsk=managesuppliers">Manage Suppliers</a><br />
		</div>
	</div>
</div>
<br/>
<div id="admin">
	<div id="block-head">
		Administration
	</div>
	<div id="block-body">
		<div class="block-body-text">
			<a href="index.php?cmd=admin&tsk=adduser">Add User</a><br />
			<a href="index.php?cmd=admin&tsk=manageusers">Manage Users</a><br/>
		</div>
	</div>
</div>
<br/>
