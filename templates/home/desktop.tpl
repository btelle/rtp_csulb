{**
 * desktop.tpl
 * 
 * Home page template
 * 
 * @author Brandon Telle
 *}

{include file="layout/std_header.tpl"}
<h1>Current Parking Lot Status</h1>
<div id="homepage_map">
    <ul class="home_lots">
        {$full = 90}
        {$mid = 80}
        {** Preferred lot goes to the top. **}
        {section loop=$lots name=pref}
        {if $lots[pref].Capacity gt 0 && $lots[pref].Id eq $pref_lot}
        {$lots[pref].percent = (($lots[pref].Occupied/$lots[pref].Capacity)*100)}

        <li class="{if $lots[pref].Closed}closed{elseif $lots[pref].percent gt $full}full{elseif $lots[pref].percent gt $mid}mid{else}empty{/if}" id="{$lots[pref].Classname}">
            <h2>{$lots[pref].Name}</h2>
            <span>{if $lots[pref].Closed}Closed{else}{$lots[pref].percent|floor}%{/if}</span>
        </li>

        {/if}
        {/section}

        {section loop=$lots name=l}

        {if $lots[l].Capacity gt 0 && $lots[l].Id neq $pref_lot}
        {$lots[l].percent = (($lots[l].Occupied/$lots[l].Capacity)*100)}

        <li class="{if $lots[l].Closed}closed{elseif $lots[l].percent gt $full}full{elseif $lots[l].percent gt $mid}mid{else}empty{/if}" id="{$lots[l].Classname}">
            <h2>{$lots[l].Name}</h2>
            <span>{if $lots[l].Closed}Closed{else}{$lots[l].percent|floor}%{/if}</span>
        </li> 

        {/if}

        {/section}
    </ul>
    <form id="map_prefs" action="index.php" method="get">
        <fieldset>
            <legend>Preferences</legend>
            <div>
                <label for="space_type">Space Type</label>
                <select name="space_type" id="space_type">
                    <option value="">All</option>
                    {section loop=$space_types name=s}
                     <option value="{$space_types[s].id}" {if $filter['space_type'] eq $space_types[s].id}selected="selected"{/if}>{$space_types[s].full_text}</option>
                    {/section}
                </select>
            </div>
            {if !$user.id}
            <div>
                <label for="campus_section">Campus Section</label>
                <select name="campus_section" id="campus_section">
                    <option value="">All</option>
                    {section loop=$sections name=sec}
                    <option value="{$sections[sec].id}" {if $filter['campus_section'] eq $sections[sec].id}selected="selected"{/if}>{$sections[sec].section}</option>
                    {/section}
                </select>
            </div>
            {else}
            <div>
                <label for="location">Location</label>
                <select name="location" id="location">
                    <option value="">None</option>
                    {section loop=$locations name=l}
                    <option value="{$locations[l].id}" {if $filter['location'] eq $locations[l].id}selected="selected"{/if}>{$locations[l].location}</option>
                    {/section}
                </select>
            </div>
            {/if}
            <div class="submit"><input type="submit" name="submit" value="Filter" /></div>
        </fieldset>
    </form>
    <div id="lotDetail">Test!</div>
</div>
<script type="text/javascript" src="js/rtp.map.js"></script>
{include file="layout/std_footer.tpl"}