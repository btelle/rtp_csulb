{**
 * lots/info.tpl
 *
 * Lot info page, displays lot details
 *
 * @author Brandon Telle
 *}

{include file="layout/std_header.tpl"}

<h1>{$details.name}</h1>

{include file="lots/nav.tpl"}

<div class="lot-details-content">
	<div class="imgfloat"><img src="images/lots/{$details.img}" alt="{$details.name}" /></div>

	<h2>Capacity</h2>
	<ul>
	    {section loop=$types name=t}
	    {if $details[$types[t].type]}<li>{$details[$types[t].type]} {$types[t].full_text}</li>{/if}
	    {/section}
	</ul>

	<h2>Restrictions</h2>
	<ul>
	    <li>Operating Hours: {if $details.open_time != $details.close_time}{$details.open_time} to {$details.close_time}{else}Always Open{/if}</li>
	{section loop=$restrictions name=r}
	    <li>{$restrictions[r]}</li>
	{/section}
	</ul>

	<h2>Nearby</h2>
	<ul>
	{section loop=$nearby name=n}
	    <li>{$nearby[n]}</li>
	{/section}
	</ul>
</div>
        
<script type="text/javascript" src="js/rtp.lotinfo.js"></script>

{include file="layout/std_footer.tpl"}