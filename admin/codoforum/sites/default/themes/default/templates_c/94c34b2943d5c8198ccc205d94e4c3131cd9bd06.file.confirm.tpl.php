<?php /* Smarty version Smarty-3.1.16, created on 2014-05-10 16:09:47
         compiled from "/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/user/confirm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:828269028536e332b590023-31669839%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94c34b2943d5c8198ccc205d94e4c3131cd9bd06' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/user/confirm.tpl',
      1 => 1399702492,
      2 => 'file',
    ),
    'd4abc0502b2b173e5dfcd5d7949b028f1e336780' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/layout.tpl',
      1 => 1399702502,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '828269028536e332b590023-31669839',
  'function' => 
  array (
  ),
  'variables' => 
  array (
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
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_536e332b6ad967_89479154',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_536e332b6ad967_89479154')) {function content_536e332b6ad967_89479154($_smarty_tpl) {?>
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
",
                logged_in: "<?php echo $_smarty_tpl->tpl_vars['is_logged_in']->value;?>
",
                time: "<?php echo $_smarty_tpl->tpl_vars['php_time_now']->value;?>
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

    

    <div class="codo_container">

        <div class="row">

            <div class="col-md-6">

                <?php if ($_smarty_tpl->tpl_vars['result']->value=="VAR_NOT_PASSED"||$_smarty_tpl->tpl_vars['result']->value=="VAR_NOT_FOUND") {?>
                    <div class="codo_notification codo_notification_error">
                        <?php echo $_smarty_tpl->tpl_vars['result']->value;?>
<?php echo _("There was some error. Please check your confirmation link");?>

                    </div>
                <?php } else { ?>
                    <div class="codo_notification codo_notification_success">
                        <?php echo _("Email confirmation successfull");?>
<br/>
                        <?php echo _("You will be redirected to your ");?>
<a href="<?php echo $_smarty_tpl->tpl_vars['profile_url']->value;?>
"><?php echo _("profile");?>
</a><?php echo _(" in 2 seconds");?>

                    </div>
                <?php }?>


            </div>
        </div>
    </div>

    <script type="text/javascript">

        setTimeout(function() {

            window.location.href = codo_defs.url + "user/profile";
        }, 2000);
    </script>


    <div class="codo_footer">

        <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>


        <div style="display: none" id="codo_js_php_defs"></div>
    </div>
</body>

</html>
<?php }} ?>