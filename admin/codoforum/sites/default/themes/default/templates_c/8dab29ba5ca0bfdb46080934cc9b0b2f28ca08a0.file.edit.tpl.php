<?php /* Smarty version Smarty-3.1.16, created on 2014-02-13 16:57:53
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/user/profile/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:97498070152f7982537b937-19592868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8dab29ba5ca0bfdb46080934cc9b0b2f28ca08a0' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/user/profile/edit.tpl',
      1 => 1392143015,
      2 => 'file',
    ),
    'e19a14c9e0a1d8063627a23a68a2a861b04ad7e9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/layout.tpl',
      1 => 1392306995,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97498070152f7982537b937-19592868',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52f7982540fe12_32902280',
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
<?php if ($_valid && !is_callable('content_52f7982540fe12_32902280')) {function content_52f7982540fe12_32902280($_smarty_tpl) {?>
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
                            
                            <li><a href="<?php echo @constant('RURI');?>
user/profile"><?php echo _("My profile");?>
</a></li>
                            <li><a href="<?php echo @constant('RURI');?>
user/logout"><?php echo _("Logout");?>
</a></li>

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

    
    <div class="codo_container">
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
        </div>
    </div>

    <script type="text/javascript">

        jQuery(document).ready(function($) {

            $('#codo_display_name').focus();

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


    <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

</body>

</html>
<?php }} ?>
