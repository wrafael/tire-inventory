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
		{include file="templates/details.tpl"}
		</div>
		<div style="clear:both"></div>
		<div id="footer">
		{include file="templates/footer.tpl"}
		</div>
	</div>
	<a href="javascript:toggleLayer('commentForm');" title="Add a comment to this entry">Add a comment</a>
  <div id="commentForm">
	<input type="reset" name="reset" value="Cancel" onclick="javascript:toggleLayer('commentForm');" />
	</div>
</body>
</html>