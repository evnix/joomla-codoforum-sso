<?php /* Smarty version Smarty-3.1.16, created on 2014-05-25 12:08:54
         compiled from "/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/user/profile/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198900003052fdee33cfc5e7-13221578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b6cedcdd7046200236d91060046d9861e966ef4' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/user/profile/view.tpl',
      1 => 1400652147,
      2 => 'file',
    ),
    'd4abc0502b2b173e5dfcd5d7949b028f1e336780' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/layout.tpl',
      1 => 1401014858,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198900003052fdee33cfc5e7-13221578',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52fdee33e63fc1_67803147',
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
<?php if ($_valid && !is_callable('content_52fdee33e63fc1_67803147')) {function content_52fdee33e63fc1_67803147($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_pretty_time')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.get_pretty_time.php';
if (!is_callable('smarty_modifier_abbrev_no')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.abbrev_no.php';
?>
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

    

    <style type='text/css'>
    </style>
    <div class="codo_container">

        <div class="row">
            <div class="col-md-6">

                <div style="display:none" class="codo_notification codo_notification_error" id="codo_resend_mail_failed"></div>
                
                <div style="display:none" id="codo_mail_resent" class="codo_notification codo_notification_success">
                    <?php echo _("A confirmation email has been sent to your email address!");?>

                </div>


                <?php if ($_smarty_tpl->tpl_vars['user_is_current']->value&&$_smarty_tpl->tpl_vars['user']->value->user_status=="0") {?>

                    <div class="codo_notification codo_notification_warning">
                        <?php echo _("You have not yet confirmed your email address.");?>

                        <a id="codo_resend_mail" href="#"><?php echo _("Resend email");?>
</a>
                        <img id="codo_email_sending_img" src="<?php echo @constant('CURR_THEME');?>
img/ajax-loader-orange.gif" />
                    </div>
                <?php }?>

                <div class='codo_user_info'>


                    <div class="codo_user_name">
                        <div><?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</div>
                        <div id="codo_edit_profile" class="codo_edit_profile">
                            <img draggable="false" src="<?php echo @constant('CURR_THEME');?>
img/edit_white.png" />
                        </div>
                    </div>
                    <div class="codo_minus_user_name">
                        <div class='codo_avatar'>

                            <img draggable="false" src="<?php echo $_smarty_tpl->tpl_vars['user']->value->avatar;?>
" />
                            <div class="codo_role_name"><?php echo $_smarty_tpl->tpl_vars['rname']->value;?>
</div>
                        </div>

                        <div class="codo_user_details">
                            <div>
                                <span><?php echo _("Joined: ");?>
</span><?php echo smarty_modifier_get_pretty_time($_smarty_tpl->tpl_vars['user']->value->created);?>

                            </div>
                            <div>
                                <span><?php echo _("Last login: ");?>
</span><?php echo smarty_modifier_get_pretty_time($_smarty_tpl->tpl_vars['user']->value->last_access);?>

                            </div>

                            <div class="codo_topic_statistics">

                                <div class="codo_cat_num">
                                    <div id="codo_topic_views" data-number="22" style="display: block;"><?php echo smarty_modifier_abbrev_no($_smarty_tpl->tpl_vars['user']->value->profile_views);?>
</div>
                                    <?php echo _("views");?>

                                </div>
                                <div class="codo_cat_num">
                                    <div>
                                        <?php echo smarty_modifier_abbrev_no($_smarty_tpl->tpl_vars['user']->value->no_posts);?>

                                    </div>
                                    <?php echo _("posts");?>

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

                window.location.href = codo_defs.url + 'user/profile/' + <?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
 + '/edit';
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


    <div class="codo_footer">

        <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>


        <div style="display: none" id="codo_js_php_defs"></div>
    </div>
</body>

</html>
<?php }} ?>
