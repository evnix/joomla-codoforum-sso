{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}

    <style type="text/css">

    </style>

    <div class="container">

        <ol class="codo_breadcrumb">
            <li><a href="{$smarty.const.RURI}{$site_url}">{$home_title}</a></li>
            <li><a href="{$smarty.const.RURI}user/login">{_("User login")}</a>
            <li>{$sub_title}</li>
        </ol>

        <div id='codo_new_password_resp' class='codo_notification' style="display: none"></div>

        <div class="codo_block">


            <div class="row">

                <div class="col-md-6">            
                    <input class="codo_input" type="text" id="name" maxlength="60" placeholder="{_('username or e-mail address')}" required="">
                </div>

            </div>

            <div class='row'>

                <div class='col-md-6'>

                    <button id='req_pass' class='codo_btn codo_btn_primary'>{_('E-mail new password')}</button>
                    <img id="codo_sending_mail" style="display: none" src="{$smarty.const.CURR_THEME}img/ajax-loader.gif" />
                </div>
            </div>    

        </div>
    </div>
    <script type="text/javascript">

        jQuery('document').ready(function($) {

            //keep initial focus
            $('#name').focus();

            $('input').bind('keypress', function(e) {

                var code = e.keyCode || e.which;
                if (code === 13) { //Enter keycode

                    $('#req_pass').trigger('click');
                }
            });


            $('#req_pass').on('click', function() {

                $('#codo_sending_mail').show();
                $.getJSON(
                        codo_defs.url + 'Ajax/user/login/req_pass',
                        {
                            ident: $.trim($('#name').val()),
                            token: codo_defs.token
                        },
                function(response) {

                    $('#codo_sending_mail').hide();
                    CODOF.util.update_response_status(response, $('#codo_new_password_resp'), true);
                }
                );

            });


        });

    </script>

{/block}