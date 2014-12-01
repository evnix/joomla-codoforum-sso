{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}

    <style type="text/css">

        .codo_login_register_link {

            margin-right: 5px;
        }

        .remember_me_txt {

            color: grey;
        }
        
        #codo_login_error {
            
            margin-top: 20px;
            padding: 10px;
            display: none;
        }

    </style>

    <div class="container">

        <ol class="codo_breadcrumb">
            <li><a href="{$smarty.const.RURI}{$site_url}">{$home_title}</a></li>
            <li>{$sub_title}</li>
        </ol>
        
        
        <div id="codo_login_error" class="codo_notification codo_notification_error">{_("Please fill both the fields!")}</div>
        
        
        <div id="codo_login_container" class="codo_block">
            
            
            
            <div class="row">

                <div class="col-md-6">            
                    <input class="codo_input" type="text" id="name" maxlength="60" placeholder="{_("username")}"/>
                </div>

            </div>
            <div class="row">

                <div class="col-md-6">            
                    <input class="codo_input" type="password" id="pass" maxlength="128" placeholder="{_("password")}"/>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <input id="remember_me" type="checkbox" /><span class="remember_me_txt">{_(" Keep me logged in")}</span>
                    <button class="codo_btn codo_btn_primary" id="codo_login">{_("Login")}</button>
                </div>

            </div>


            <div class="row">

                <div class="col-md-6">
                    <a  class="codo_login_register_link" href="{$register_url}">{_("Register")}</a>
                    <a href="{$smarty.const.RURI}user/forgot">{_("I forgot my password")}</a>            
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

                    $('#codo_login').trigger('click');
                }
            });


            $('#codo_login').on('click', function() {

                //if (!CODOF.authenticator) {
                    
                    //No alternative authenticator exists so use default
                    $.getJSON(
                            codo_defs.url + 'Ajax/user/login/dologin',
                            {
                                username: $.trim($('#name').val()),
                                password: $.trim($('#pass').val()),
                                remember: $('#remember_me').is(":checked"),
                                token: codo_defs.token
                            },
                    function(response) {

                        if (response.msg === "success") {

                            window.location.href = codo_defs.url + 'user/profile';
                        } else {
                            
                                $('#codo_login_error').html(response.msg).show('slow');
                                CODOF.ui.saccade($('#codo_login_error'));
                        }
                    }
                    );

               // }
            });


        });

    </script>
{/block}
