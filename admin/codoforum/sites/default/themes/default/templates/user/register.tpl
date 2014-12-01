{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}

    <style type="text/css">

        .codo_reg_error {
            position: absolute;
            background: #d14836;
            border: 1px solid #d14836;
            color: white;
            padding: 5px;
            border-radius: 1px;
            display: none;
        }

        .codo_reg_error_block .codo_reg_error {

            position: static;
            display: block;

        }

        #password {

            padding-right: 27px;
        }

        #codo_reg_pass { 
            position: relative;
        }
        #letterViewer { 
            position: absolute;
            right: -72px;
            top: 0;
            width: 100px;
            font: bold 30px Helvetica, Sans-Serif;
        }  

        .codo_already_registered {

            color: #585858;
            display: inline-block;
            margin-left: 4px;
        }
    </style>

    <div class="container">
        
        <ol class="codo_breadcrumb">
            <li><a href="{$smarty.const.RURI}{$site_url}">{$home_title}</a></li>
            <li>{$sub_title}</li>
        </ol>
        
        <div class="codo_block">

        {if !empty($errors)}
            <div class="codo_reg_error_block">
                {foreach from=$errors item=error}
                    <div class='codo_reg_error'> {$error} </div>

                {/foreach}
            </div>
        {/if}

        <form id="codo_register_form" action="{$smarty.const.RURI}user/register" method="POST" >
            <div class="row">

                <div class="col-md-6">            
                    <input data-length="{$min_username_len}" value="{$register->username}" class="codo_input" id="reg_username" type="text" name="username" placeholder="{_("username")}" required/>
                    <div class="codo_reg_error"></div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-6">          
                    <div id="codo_reg_pass">
                        <input data-length="{$min_pass_len}" value="{$register->password}" class="codo_input" id="password" type="password" name="password" placeholder="{_("password")}" required/>
                        <div class="codo_reg_error"></div>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">            
                    <input value="{$register->mail}" class="codo_input" type="email" id="reg_mail" name="mail" placeholder="{_("email")}" required=""/>
                    <div class="codo_reg_error"></div>                
                </div>

            </div>

            {if isset($recaptcha)}        
                <div class="row col-md-12">

                    {$recaptcha}
                </div>
            {/if}
            
         

            <input type="hidden" name="token" value="{$CSRF_token}" />
            <div class="row">

                <div class="col-md-12">
                    <button class="codo_btn codo_btn_primary" id="codo_register">{_("Register")}</button>
                    <div class="codo_already_registered">
                        {_("Already registered?")} <a  class="codo_login_register_link" href="{$smarty.const.RURI}user/login">{_("Login here")}</a>    
                    </div>
                </div>
            </div>

        </form>
        </div>
    </div>

    <script type="text/javascript">

        codo_defs.register = {
            pass_min: parseInt('{$min_pass_len}'),
            username_min: parseInt('{$min_username_len}')
        };

        CODOF.pass = {
            trans: {
                username_short: '{_("username cannot be less than ")}' + codo_defs.register.username_min + '{_(" characters")}',
                username_exists: '{_("username already exists")}',
                password_short: '{_("passowrd cannot be less than ")}' + codo_defs.register.pass_min + '{_(" characters")}',
                mail_exists: '{_("mail already exists")}'

            }
        }

    </script>

    <!-- could have placed inline , but this looks better -->
    <script type="text/javascript" src="{$smarty.const.DURI}assets/js/user/register.js"></script>
{/block}
