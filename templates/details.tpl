<div id="detail-head">
.: 
{if $error}
	{$error}
{elseif $motd}
	{$motd}
{/if}
</div>
<div id="detail-body">
{if $message}
	{$message}
{/if}
</div>