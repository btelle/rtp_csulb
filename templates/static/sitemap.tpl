{**
 * static/sitemap.tpl
 * 
 * Site map file list template
 * 
 * @author Brandon Telle
 *}
 
{include file="layout/std_header.tpl"}

<h1>Site Map</h1>

{if $files}

    <ul class="site_map">
    {section loop=$files name=i}
        <li><h2>{$files[i].title}</h2>
            <ul>
            {section loop=$files[i].files name=f}
                <li><a href="syntax.php?file={$files[i].files[f].file}" title="{$files[i].files[f].desc}">{$files[i].files[f].file}</a></li>
            {/section}
            </ul>
        </li>
    {/section}
    </ul>
    
{/if}

{include file="layout/std_footer.tpl"}