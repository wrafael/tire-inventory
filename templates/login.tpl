<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="styles/styles.css" type="text/css" />
{assign var="title" value=$title|default:"SB Marketing - Inventory Main"}
<title>{$title}</title>
</head>
<body>
<div id="header">
{include file="templates/header.tpl"}
</div>
<p />
<div id="login">
  <div class="title">Tire Inventory</div>
	<div class="details">
		<br />
		<form action="index.php?cmd=login" method="post">
			Username: <input type="text" name="username" value="user" onFocus="if(this.value=='user')this.value='';"> <br />
			Password: <input type="password" name="password" value="user101" onFocus="if(this.value=='user101')this.value='';"> <br />
			<div align="center">
				<input type="submit" name="submit" value="Login" />
				<input type="reset" name="reset" value="Clear" />
				<br />
				<br /><em><span style="text-decoration:blink"><strong>{$message}</strong></span></em><br />		
			</div>
		</form>
	</div>
</div>
{include file="templates/footer.tpl"}