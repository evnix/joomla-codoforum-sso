<?php /* Smarty version Smarty-3.1.16, created on 2014-02-13 16:22:21
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/user/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:163000175652b99a87172cc1-02850409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7be04b1c2da55e7df06ef16a21138720be0be25' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/user/login.tpl',
      1 => 1392304011,
      2 => 'file',
    ),
    'e19a14c9e0a1d8063627a23a68a2a861b04ad7e9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/layout.tpl',
      1 => 1392304913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '163000175652b99a87172cc1-02850409',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b99a8723a9f2_99652268',
  'variables' => 
  array (
    'site_title' => 0,
    'page' => 0,
    'CSRF_token' => 0,
    'site_url' => 0,
    'logged_in' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b99a8723a9f2_99652268')) {function content_52b99a8723a9f2_99652268($_smarty_tpl) {?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</title>

        <!--[if lte IE 8]>
         <script src="//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.min.js"></script>
        <![endif]-->

        <?php echo $_smarty_tpl->tpl_vars['page']->value['head']['css'];?>


        <script type="text/javascript">
            var codo_defs = {
                url: "<?php echo @constant('RURI');?>
",
                duri: "<?php echo @constant('DURI');?>
",
                reluri: "<?php echo @constant('DATA_REL_PATH');?>
",
                token: "<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
",
                smiley_path: "<?php echo @constant('SMILEY_PATH');?>
"
            };
        </script>

        <?php echo $_smarty_tpl->tpl_vars['page']->value['head']['js'];?>


        <style type="text/css">

            .navbar {

                border-radius: 0;

            }
            .navbar-clean {

                background: white;
                box-shadow: 0 1px 5px #cccccc;
            }
            .nav > li > a:hover, .nav > li > a:focus {

                background: white;
                color: #1471af;
            }

            .nav > li > a {

                color: #3794db;
                cursor: pointer;

            }
            
            .nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
            
                background: white;
            }

            .navbar-clean .container-fluid {

                padding-left: 20px;
                padding-right: 30px;
            }

            .codo_forum_title {

                font-family: Oswald, Helvetica;
                color: #333 !important;

            }

            .codo_forum_title:hover {
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;  
            }

            .navbar-toggle {

                background: #1471af;
            }

.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {

    color: white;
    background: #3794db;
}            
            .navbar-toggle .icon-bar {

                background: white;
            }

        </style>

    </head>

    <body>


        <nav class="navbar navbar-clean" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand codo_forum_title" href="<?php echo @constant('RURI');?>
<?php echo $_smarty_tpl->tpl_vars['site_url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($_smarty_tpl->tpl_vars['logged_in']->value) {?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo @constant('RURI');?>
user/profile"><?php echo _("My profile");?>
 <b class="caret"></b></a>
                            
                                <ul class="dropdown-menu">
                                    
                                    <li>
                                        <a href="<?php echo @constant('RURI');?>
user/logout"><?php echo _("Logout");?>
</a>
                                    </li>
                                </ul>
                            </li>

                        <?php } else { ?>
                            <li class="active"><a href="<?php echo @constant('RURI');?>
user/register"><?php echo _("Register");?>
</a></li>
                            <li><a href="<?php echo @constant('RURI');?>
user/login"><?php echo _("Login");?>
</a></li>

                        <?php }?>
                    </ul>                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class='codo_modal_bg'></div>

    

    <style type="text/css">


        #codo_login_container {

            margin-top: 20px;
            background: white;
            box-shadow: 1px 1px 5px #ccc;
        }

        .codo_login_register_link {

            margin-right: 5px;
        }

        .remember_me_txt {

            color: grey;
        }

    </style>

    <div class="container">

        <div id="codo_login_container">
            <div class="row">

                <div class="col-md-6">            
                    <input class="codo_input" type="text" id="name" maxlength="60" placeholder="<?php echo _("username");?>
"/>
                </div>

            </div>
            <div class="row">

                <div class="col-md-6">            
                    <input class="codo_input" type="password" id="pass" maxlength="128" placeholder="<?php echo _("password");?>
"/>
                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <input id="remember_me" type="checkbox" /><span class="remember_me_txt"><?php echo _(" Keep me logged in");?>
</span>
                    <button class="codo_btn codo_btn_primary" id="codo_login"><?php echo _("Login");?>
</button>
                </div>

            </div>


            <div class="row">

                <div class="col-md-6">
                    <a  class="codo_login_register_link" href="<?php echo @constant('RURI');?>
user/register"><?php echo _("Register");?>
</a>
                    <a href="<?php echo @constant('RURI');?>
user/forgot"><?php echo _("I forgot my password");?>
</a>            
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
                        alert(response.msg);
                    }
                }
                );

            });


        });

    </script>


    <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

</body>

</html>
<?php }} ?>
