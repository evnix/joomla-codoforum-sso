<?php /* Smarty version Smarty-3.1.16, created on 2014-05-31 13:49:32
         compiled from "/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/user/profile/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153002456252fe138e80a374-43100779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fac18a023a4eb1fd9d9864142af8036d702d8716' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/user/profile/edit.tpl',
      1 => 1401538826,
      2 => 'file',
    ),
    'd4abc0502b2b173e5dfcd5d7949b028f1e336780' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/layout.tpl',
      1 => 1401014858,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153002456252fe138e80a374-43100779',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52fe138e97bb76_58482427',
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
<?php if ($_valid && !is_callable('content_52fe138e97bb76_58482427')) {function content_52fe138e97bb76_58482427($_smarty_tpl) {?>
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

    
    <div class="codo_container">

        <div id="profile_edit_status" class="codo_notification" style="display: none"></div>

        <div class="row">

            <div class="col-md-8">
                <div class="codo_edit_profile">


                    <?php if (isset($_smarty_tpl->tpl_vars['file_upload_error']->value)) {?>

                        <div class="codo_notification codo_notification_error"><?php echo $_smarty_tpl->tpl_vars['file_upload_error']->value;?>
</div>
                    <?php }?>

                    <?php if (isset($_smarty_tpl->tpl_vars['user_profile_edit']->value)&&$_smarty_tpl->tpl_vars['user_profile_edit']->value) {?>
                        <div class="codo_notification codo_notification_success"><?php echo _("user profile edits saved successfully");?>
</div>
                    <?php }?>
                    <form action="<?php echo @constant('RURI');?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
/edit" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label"><?php echo _("username");?>
</label>
                            <div class="col-sm-8">
                                <input type="text" name="username" class="codo_input codo_input_disabled" id="username"  value="<?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="display_name" class="col-sm-2 control-label"><?php echo _("display name");?>
</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="codo_input" id="codo_display_name" placeholder="" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->name;?>
">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="display_name" class="col-sm-2 control-label"><?php echo _("avatar");?>
</label>
                            <div class="col-sm-8 codo_avatar">

                                <img class="codo_avatar_img" draggable="false" src="<?php echo $_smarty_tpl->tpl_vars['user']->value->avatar;?>
" />
                                <input class="codo_change_avatar" id="codo_avatar_file" type="file" name="avatar" />
                                <div style="display: none" id="codo_new_avatar_selected_name"></div>
                                <img class="codo_right_arrow" id="codo_right_arrow" src="<?php echo @constant('CURR_THEME');?>
img/arrow-right.jpg" />
                                <img class="codo_avatar_preview" src="" id="codo_avatar_preview"/>
                                <div class="codo_btn codo_btn_def"><?php echo _("Change");?>
</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="display_name" class="col-sm-2 control-label"><?php echo _("signature");?>
</label>
                            <div class="col-sm-8">
                                <textarea name="signature" maxlength="<?php echo $_smarty_tpl->tpl_vars['signature_char_lim']->value;?>
" id="codo_signature_textarea" class="codo_input"><?php echo $_smarty_tpl->tpl_vars['user']->value->signature;?>
</textarea>
                            </div>
                            <span id="codo_countdown_signature_characters"><?php echo $_smarty_tpl->tpl_vars['signature_char_lim']->value;?>
</span>
                        </div>


                        <div id="codo_before_save_user_profile">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="codo_btn codo_btn_primary"><?php echo _("Save edits");?>
</button>
                            </div>
                        </div>

                        <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
" />
                    </form>
                </div>
            </div>


            <div class="col-md-4 codo_edit_profile">

                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" name="curr_pass" class="codo_input" id="curr_pass"  placeholder="<?php echo _("Current password");?>
" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" name="new_pass" class="codo_input" id="new_pass"  placeholder="<?php echo _("New password");?>
" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" name="confirm_new_pass" class="codo_input" id="confirm_pass"  placeholder="<?php echo _("Confirm password");?>
" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button id="change_pass" type="submit" class="codo_btn codo_btn_primary"><?php echo _("Change password");?>
</button>
                        <span id="codo_pass_no_match_txt" class="codo_pass_no_match_txt"><?php echo _("passwords do not match!");?>
</span>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">

        jQuery(document).ready(function($) {

            $('#codo_display_name').focus();

            $(document).keypress(function(e) {
                
                if(e.which === 13 && $('#confirm_pass').is(":focus")) {
                    
                    $('#change_pass').trigger('click');
                }
            });

            $('#change_pass').click(function() {

                CODOF.req.data = {
                    curr_pass: $('#curr_pass').val(),
                    new_pass: $('#new_pass').val(),
                    confirm_pass: $('#confirm_pass').val(),
                    token: codo_defs.token
                };

                CODOF.util.add_error_class_if_blank('curr_pass');
                CODOF.util.add_error_class_if_blank('new_pass');
                CODOF.util.add_error_class_if_blank('confirm_pass');

                var no_pass_txt = $('#codo_pass_no_match_txt');

                if (CODOF.req.data.new_pass !== CODOF.req.data.confirm_pass) {

                    if (no_pass_txt.hasClass('codo_pass_no_match_txt_twice')) {

                        CODOF.ui.saccade(no_pass_txt);
                    }

                    else if (no_pass_txt.hasClass('codo_pass_no_match_txt_again')) {

                        no_pass_txt.addClass('codo_pass_no_match_txt_twice');
                    }

                    else if (no_pass_txt.is(":visible")) {

                        no_pass_txt.addClass('codo_pass_no_match_txt_again');
                    } else {

                        no_pass_txt.show();
                    }
                    
                    return false;
                }
                CODOF.hook.call('before_change_pass');

                $.getJSON(
                        codo_defs.url + 'Ajax/user/edit/change_pass',
                        CODOF.req.data,
                        function(response) {

                            CODOF.util.update_response_status(response, $('#profile_edit_status'), true);
                        }
                );
            });

            function calculate_len(textarea) {

                var len = textarea.val().length;
                console.log(len);
                var allowed_len = parseInt('<?php echo $_smarty_tpl->tpl_vars['signature_char_lim']->value;?>
');

                var count = allowed_len - len;

                $('#codo_countdown_signature_characters').html(count);

            }

            $('#codo_signature_textarea').keyup(function() {

                calculate_len($(this));
            });

            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#codo_avatar_preview').show().attr('src', e.target.result);
                        $('#codo_right_arrow').show('slow');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#codo_avatar_file').change(function() {

                if (window.File && window.FileReader && window.FileList) {

                    //can show file preview
                    readURL($(this)[0]);
                } else {

                    $('#codo_new_avatar_selected_name').html($(this).val().match(/[^\/\\]+$/)).show('slow');
                }



            });
            calculate_len($('#codo_signature_textarea'));
        });
    </script>


    <div class="codo_footer">

        <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>


        <div style="display: none" id="codo_js_php_defs"></div>
    </div>
</body>

</html>
<?php }} ?>
