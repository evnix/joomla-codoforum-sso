{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}

    <style type='text/css'>
    </style>
    <div class="codo_container">

        <div class="row">
            <div class="col-md-6">

                <div style="display:none" class="codo_notification codo_notification_error" id="codo_resend_mail_failed"></div>
                
                <div style="display:none" id="codo_mail_resent" class="codo_notification codo_notification_success">
                    {_("A confirmation email has been sent to your email address!")}
                </div>


                {if $user_is_current && $user->user_status eq "0"}

                    <div class="codo_notification codo_notification_warning">
                        {_("You have not yet confirmed your email address.")}
                        <a id="codo_resend_mail" href="#">{_("Resend email")}</a>
                        <img id="codo_email_sending_img" src="{$smarty.const.CURR_THEME}img/ajax-loader-orange.gif" />
                    </div>
                {/if}

                <div class='codo_user_info'>


                    <div class="codo_user_name">
                        <div>{$user->username}</div>
                        <div id="codo_edit_profile" class="codo_edit_profile">
                            <img draggable="false" src="{$smarty.const.CURR_THEME}img/edit_white.png" />
                        </div>
                    </div>
                    <div class="codo_minus_user_name">
                        <div class='codo_avatar'>

                            <img draggable="false" src="{$user->avatar}" />
                            <div class="codo_role_name">{$rname}</div>
                        </div>

                        <div class="codo_user_details">
                            <div>
                                <span>{_("Joined: ")}</span>{$user->created|get_pretty_time}
                            </div>
                            <div>
                                <span>{_("Last login: ")}</span>{$user->last_access|get_pretty_time}
                            </div>

                            <div class="codo_topic_statistics">

                                <div class="codo_cat_num">
                                    <div id="codo_topic_views" data-number="22" style="display: block;">{$user->profile_views|abbrev_no}</div>
                                    {_("views")}
                                </div>
                                <div class="codo_cat_num">
                                    <div>
                                        {$user->no_posts|abbrev_no}
                                    </div>
                                    {_("posts")}
                                </div>

                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        jQuery(document).ready(function($) {

            $('#codo_mail_resent').hide();
            $('#codo_email_sending_img').hide();

            $('#codo_edit_profile').on('click', function() {

                window.location.href = codo_defs.url + 'user/profile/' + {$user->id} + '/edit';
            });

            $('#codo_resend_mail').on('click', function() {

                $('#codo_email_sending_img').show();

                $.get(
                        codo_defs.url + 'Ajax/user/register/resend_mail',
                        {
                            token: codo_defs.token
                        },
                function(response) {

                    if (response === "success") {

                        $('#codo_mail_resent').fadeIn('slow');
                    } else {
                        
                        $('#codo_resend_mail_failed').html(response).show('slow');
                    }

                    $('#codo_email_sending_img').hide();

                }
                );

            });
        });
    </script>
{/block}
