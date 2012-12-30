{**
 * contact/form.tpl
 *
 * Contact form template.
 *
 * @author Brandon Telle
 *}

{include file="layout/std_header.tpl"}

<h1>Contact Us</h1>
<p>Please use the form below to contact the site's authors with your questions, concerns, or suggestions.</p>
{include file="util/error.tpl"}

<form action="contact.php" method="post" id="contact">
    <fieldset>
        <legend>Contact Us</legend>
        <div><label for="name">Name:</label> <input type="text" name="name" id="name" value="{$contact_data.name}" required /></div>
        <div><label for="email">Email:</label> <input type="email" name="email" id="email" value="{$contact_data.email}" required /></div>
        <div><label for="comment">Comment:</label> <textarea name="comment" id="comment" cols="50" rows="5" required>{$contact_data.comment}</textarea></div>
        <div><label for="recaptcha_response_field">Verification:</label> {include file="util/recaptcha.tpl"}</div>
        <div class="submit"><input type="submit" value="Send" name="submit" /></div>
    </fieldset>
</form>

<script type="text/javascript" src="js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/rtp.validate.js"></script>

{include file="layout/std_footer.tpl"}