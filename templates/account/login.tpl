{**
 * account/login.tpl
 *
 * Login form template
 *
 * @author Brandon Telle
 *}

{include file="layout/std_header.tpl"}

<h1>Log in</h1>

{include file="util/error.tpl"}

<form action="login.php" method="post" id="login_full">
    <fieldset>
        <legend>Log in</legend>
        <div><label for="email">Email</label> <input type="email" name="email" id="email" value="{$data['email']}" required/></div>
        <div><label for="password">Password</label> <input type="password" name="password" id="password" value="" required/></div>
        <div class="submit"><input type="submit" name="submit" value="Log in" /></div>
    </fieldset>
</form>
<script type="text/javascript" src="js/jquery/jquery.validate.min.js"></script>

{include file="layout/std_footer.tpl"} 