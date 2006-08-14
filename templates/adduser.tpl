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
        .: ADD NEW USER
      </div>
      <div id="detail-body">
  	  	<form action="index.php?cmd=admin&tsk=saveuser" method="post">
				  <table border="1" id="manage">
					<tr><td>Firstname:</td> <td><input type="text" name="firstname" size="40"></td></tr>
          <tr><td>Lastname:</td><td><input type="text" name="lastname" size="40"></td></tr>
          <tr><td>Username:</td><td><input type="text" name="username" size="40"></td></tr>
					<tr><td>Password:</td><td><input type="text" name="password" size="40"></td></tr>
					<tr><td>Question:</td><td><input type="text" name="question" size="40"></td></tr>
					<tr><td>Answer:</td><td><input type="text" name="answer" size="40"></td></tr>         
					<tr><td>Group:</td>
					<td>
					  <select name="groupid" >
					    {html_options values=$grpilist output=$grpnlist}
					  </select>
          </td></tr>
					<tr><td></td><td><input type="submit" name="submit" value="Add User" >
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