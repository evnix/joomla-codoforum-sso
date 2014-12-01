<?php /* Smarty version Smarty-3.1.16, created on 2014-05-30 16:19:23
         compiled from "/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/user/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:161228940652fdecbfbb8078-64700750%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49b6df78542f0ec819708d3de10de363c71a683b' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/user/login.tpl',
      1 => 1401463159,
      2 => 'file',
    ),
    'd4abc0502b2b173e5dfcd5d7949b028f1e336780' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/layout.tpl',
      1 => 1401014858,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161228940652fdecbfbb8078-64700750',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52fdecbfcd82c8_65425850',
  'variables' => 
  array (
    'sub_title' => 0,
    'site_title' => 0,
    'page' => 0,
    'CSRF_token' => 0,
    'is_logged_in' => 0,
    'php_time_now' => 0,
    'site_url' => 0,
    'logged_in' => 0,
    'profile_url' => 0,
    'logout_url' => 0,
    'register_url' => 0,
    'login_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52fdecbfcd82c8_65425850')) {function content_52fdecbfcd82c8_65425850($_smarty_tpl) {?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="generator" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $_smarty_tpl->tpl_vars['sub_title']->value;?>
 | <?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</title>

        <!--[if lte IE 8]>
         <script src="//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.min.js"></script>
        <![endif]-->

        <?php echo $_smarty_tpl->tpl_vars['page']->value['head']['css'];?>

        <link rel="shortcut icon" type="image/x-icon" href="http://codoforum.com/img/favicon.ico?v=1">
        <link rel="apple-touch-icon" sizes="57x57" href="http://codoforum.com/img/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="http://codoforum.com/img/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="http://codoforum.com/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="http://codoforum.com/img/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="http://codoforum.com/img/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="http://codoforum.com/img/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="http://codoforum.com/img/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="http://codoforum.com/img/apple-touch-icon-152x152.png">
        <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-196x196.png" sizes="196x196">
        <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-32x32.png" sizes="32x32">
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
",
                logged_in: "<?php echo $_smarty_tpl->tpl_vars['is_logged_in']->value;?>
",
                time: "<?php echo $_smarty_tpl->tpl_vars['php_time_now']->value;?>
",
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
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#codo_navbar_content">
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
                <div class="collapse navbar-collapse" id="codo_navbar_content">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($_smarty_tpl->tpl_vars['logged_in']->value) {?>
                            

                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['profile_url']->value;?>
"><?php echo _("My profile");?>
</a></li>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['logout_url']->value;?>
"><?php echo _("Logout");?>
</a></li>

                        <?php } else { ?>


                            <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['register_url']->value;?>
"><?php echo _("Register");?>
</a></li>
                            <li><a id="codo_login_link" href="<?php echo $_smarty_tpl->tpl_vars['login_url']->value;?>
"><?php echo _("Login");?>
</a></li>

                        <?php }?>
                    </ul>                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class='codo_modal_bg'></div>

    

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
            <li><a href="<?php echo @constant('RURI');?>
<?php echo $_smarty_tpl->tpl_vars['site_url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['home_title']->value;?>
</a></li>
            <li><?php echo $_smarty_tpl->tpl_vars['sub_title']->value;?>
</li>
        </ol>
        
        
        <div id="codo_login_error" class="codo_notification codo_notification_error"><?php echo _("Please fill both the fields!");?>
</div>
        
        
        <div id="codo_login_container" class="codo_block">
            
            
            
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
                    <a  class="codo_login_register_link" href="<?php echo $_smarty_tpl->tpl_vars['register_url']->value;?>
"><?php echo _("Register");?>
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


    <div class="codo_footer">

        <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>


        <div style="display: none" id="codo_js_php_defs"></div>
    </div>
</body>

</html>
<?php }} ?>
