<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
{assign var="title" value=$title|default:"$company - Inventory Main"}
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
        .: 
				{if $error}
				  {$error}
				{elseif $motd}
				  {$motd}
				{else} 
				  MANAGE SUPPLIERS
				{/if}
      </div>
      <div id="detail-body">
			  {if $message}
				  {$message}
				{else}
           <table width="100%" border="1" id="manage">
					   <tr><th>Company</th><th>Lastname</th><th>Firstname</th><th>Mobile</th><th>Landline</th><th>Credit Limit</th><th>Available</th><th>Action</th></tr>
					   {section name=cust loop=$customers}
					   <tr bgcolor="{cycle values="#E7EBFF,#F1F3F8"}">
							 <td>{$customers[cust].company}</td>
							 <td>{$customers[cust].lastname}</td>
							 <td>{$customers[cust].firstname}</td>
							 <td>{$customers[cust].mobile}</td>
							 <td>{$customers[cust].landline}</td>
							 <td align="right">{$customers[cust].limit|string_format:"%.2f"}</td>
							 <td align="right">{$customers[cust].available|string_format:"%.2f"}</td>
							 <td><a href="index.php?cmd=setup&tsk=editcustomer&uid={$customers[cust].customerid}">edit</a> 
							 <a href="index.php?cmd=setup&tsk=delcust&uid={$customers[cust].customerid}">delete</td>
						 </tr>  
						 {/section}
					 </table>
				{/if}
      </div>		
		</div>
		<div style="clear:both"></div>
		<div id="footer">
		{include file="templates/footer.tpl"}
		</div>
	</div>
</body>
</html>