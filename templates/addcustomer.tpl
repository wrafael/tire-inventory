<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
{assign var="title" value=$title|default:"SB Marketing - Inventory Main"}
{popup_init src="javascripts/overlib.js"}
{literal}
<script language="javascript" type="text/javascript" src="javascripts/toggelayer.js"></script>
{/literal}
<title>{$title}</title>
<link rel="stylesheet" href="styles/styles.css" type="text/css" />
</head>

<body>
	<div id="header">
	  {include file="templates/header.tpl"}
	</div>
	<div id="content">
		<div id="sidebar">
		{include file="templates/sidebar.tpl"}
		</div>
		<div id="details">
      <div id="detail-head">
        .: ADD NEW CUSTOMER
      </div>
      <div id="detail-body">
  	  	<form action="index.php?cmd=setup&tsk=savecustomer" method="post">
				  <table border="1" id="manage">
					<tr><td>Company:</td> <td><input type="text" name="company" size="40"></td></tr>
          <tr><td>Firstname:</td><td><input type="text" name="firstname" size="40"></td></tr>
          <tr><td>Lastname:</td><td><input type="text" name="lastname" size="40"></td></tr>
					<tr><td>Address:</td><td><input type="text" name="address1" size="40"></td></tr>
					<tr><td></td><td><input type="text" name="address2" size="40"></td></tr>
					<tr><td>City:</td><td><input type="text" name="city" size="40"></td></tr>         
					<tr><td>Mobile:</td><td><input type="text" name="mobile" size="40"></td></tr>
					<tr><td>Land Line:</td><td><input type="text" name="landline" size="40"></td></tr>
					<tr><td>Email:</td><td><input type="text" name="email" size="40"></td></tr>
					<tr><td>Credit Limit:</td><td><input type="text" name="limit" size="40"></td></tr>
					<tr><td></td><td><input type="submit" name="submit" value="Add Customer" >
					<input type="reset" name="Clear" value="Clear"></td></tr>
					</table> 
  		  </form>
      </div>		
		</div>
		<div style="clear:both"></div>
		<div id="footer">
		{include file="templates/footer.tpl"}
		</div>
	</div>
</body>
</html>