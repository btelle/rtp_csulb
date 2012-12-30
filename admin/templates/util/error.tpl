{**
 * util/error.tpl
 *
 * Error page
 *
 * @author Brandon Telle
 *}
 
{if $error}
    {section loop=$error name=e}
        <h2 class="error">{$error[e]}</h2>
    {/section}
{/if}