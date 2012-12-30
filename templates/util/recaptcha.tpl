{**
 * util/recaptcha.tpl
 *
 * Recaptcha verification form
 *
 * @author Brandon Telle (really Google, just copied from their recaptchalib)
 *}
<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k={$recaptcha_pubkey}"></script>
<noscript>
    <iframe src="http://www.google.com/recaptcha/api/noscript?k={$recaptcha_pubkey}" height="300" width="500" frameborder="0"></iframe><br/>
    <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
    <input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
</noscript>