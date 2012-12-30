{**
 * static/syntax.tpl
 *
 * Syntax highlighting template. 
 *
 * @author Brandon Telle
 *}
{include file="layout/std_header.tpl"}

<h1>{$file.name}</h1>

<pre class="syntax {$file.type}">
{$file.contents}
</pre>

<script type="text/javascript" src="js/jquery/syntax/jquery.syntax.min.js"></script>
<script type="text/javascript" src="js/rtp.syntax.js"></script>

{include file="layout/std_footer.tpl"}