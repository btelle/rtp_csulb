{**
 * lots/nav.tpl
 *
 * Lot info navigation 
 *
 * @author Brandon Telle
 *}

<ul id="lot-info-nav">
{section loop=$sections name=s}
    <li><a href="#">{$sections[s].location}</a>
        <ul>
            {section loop=$lots[$sections[s].id] name=l}
            <li {if $details.id eq $lots[$sections[s].id][l].url}class="selected"{/if}><a href="lotinfo.php?lot={$lots[$sections[s].id][l].url}">{$lots[$sections[s].id][l].name}</a></li>
            {/section}
        </ul>
    </li>
{/section}
</ul>