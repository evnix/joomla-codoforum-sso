{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}

    <div class="codo_container">

        <div class="row">

            <div class="col-md-6">

                {if $result == "VAR_NOT_PASSED" || $result == "VAR_NOT_FOUND"}
                    <div class="codo_notification codo_notification_error">
                        {$result}{_("There was some error. Please check your confirmation link")}
                    </div>
                {else}
                    <div class="codo_notification codo_notification_success">
                        {_("Email confirmation successfull")}<br/>
                        {_("You will be redirected to your ")}<a href="{$profile_url}">{_("profile")}</a>{_(" in 2 seconds")}
                    </div>
                {/if}


            </div>
        </div>
    </div>

    <script type="text/javascript">

        setTimeout(function() {

            window.location.href = codo_defs.url + "user/profile";
        }, 2000);
    </script>
{/block}
