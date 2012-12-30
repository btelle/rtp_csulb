{**
    template file for the form used to cretae a new account
**}

{include file="layout/std_header.tpl"}

<h1>{$header.title}</h1>
{if $header.intro}
<p>Please fill in the following information to create a new account.  Select your preferences to better filter
    the results that you see on the main page when you login.</p>
{else}
{if $header.intro = 2} <div id="account_changed"><p>Congratulations!  You successfully changed your account settings!</p></div> {/if}
<p>Please feel free to change any of the preferences that you have previously selected below. Once
you submit the information your account will be updated.  Thank you.</p>
{/if}
{include file="util/error.tpl"}

<form action="account.php?mode={$mode}" method="post" id="create_account">
    <fieldset>
        <legend>Personal Information</legend>
        <div><label for="name">First Name:</label> <input type="text" name="name" id="name" value="{$data.name}" required /></div>
        <div><label for="email">Email:</label> <input type="email" name="email" id="email" value="{$data.email}" required /></div>
        <div><label for="password">Password:</label> <input type="password" name="password" id="password" value="" required /></div>
        <div><label for="confirm">Conform Password:</label> <input type="password" name="confirm" id="confirm" value="" required /></div>
    </fieldset>

    <fieldset>
        <legend>Parking Preferences</legend>
        <div><label for="alerts">Receive E-mail Notifications?</label><input type=checkbox name="alerts" id="alerts" {if $data.alerts} checked {/if}/></div>

        <div><label for="spaceType">Preferred Parking Space Type:</label>
             <select name="spaceType" id="spaceType">
                 {section loop=$spaceTypes name=s}
                 <option value="{$spaceTypes[s].id}" {if $data['spaceType'] eq $spaceTypes[s].id}selected="selected"{/if}>{$spaceTypes[s].full_text}</option>
                 {/section}
             </select>
        </div>

        <div><label for="lot">Preferred Parking Lot:</label>
             <select name="lot" id="lot">
                 {section loop=$lots name=p}
                 <option value="{$lots[p].id}" {if $data['lot'] eq $lots[p].id}selected="selected"{/if}>{$lots[p].type}</option>
                 {/section}
             </select>
        </div>
        <div><label for="location">Preferred Campus Location:</label>
            <select name="location" id="location">
                 {section loop=$locations name=l}
                 <option value="{$locations[l].id}" {if $data['location'] eq $locations[l].id}selected="selected"{/if}>{$locations[l].location}</option>
                 {/section}
             </select>
        </div>

    </fieldset>

    <fieldset>
        <legend>Verify and Submit</legend>
        <div><label for="recaptcha_response_field">Verification:</label> {include file="util/recaptcha.tpl"}</div>
        <div class="submit"><input type="submit" value="Send" name="submit" /></div>
    </fieldset>
  
</form>

<script type="text/javascript" src="js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/rtp.validate.js"></script>

{include file="layout/std_footer.tpl"}