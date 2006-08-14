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
				  MANAGE USERS
				{/if}
      </div>
      <div id="detail-body">
			  {if $message}
				  {$message}
				{else}
           <table width="100%" border="1" id="manage">
					   <tr><th>Lastname</th><th>Firstname</th><th>Username</th><th>Group</th><th>Last Login</th><th>Action</th></tr>
					   {section name=user loop=$users}
					   <tr bgcolor="{cycle values="#E7EBFF,#F1F3F8"}">
							 <td>{$users[user].lastname}</td>
							 <td>{$users[user].firstname}</td>
							 <td>{$users[user].username}</td>
							 <td>
							 <select name=groupid>
							   {html_options values="$grpilist" output="$grpnlist" selected=$users[user].groupid}
							 </select>
							 </td>
							 <td>
							 {if $users[user].lastlogin eq 0}
							   Never
							 {else}
							   {$users[user].lastlogin|date_format:"%m/%d/%Y"}
							 {/if}
							 </td>
							 <td><a href="index.php?cmd=user&tsk=edituser&uid={$users[user].userid}">edit</a> 
							 <a href="index.php?cmd=admin&tsk=deluser&uid={$users[user].userid}">delete</td>
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