<?php /* Smarty version Smarty-3.1.16, created on 2014-02-13 16:57:33
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/new_topic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5312616352b92ab84681c3-63675347%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1826259601b3555ebd065dcd72f8351a642caf7' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/new_topic.tpl',
      1 => 1392306133,
      2 => 'file',
    ),
    'e19a14c9e0a1d8063627a23a68a2a861b04ad7e9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/layout.tpl',
      1 => 1392306995,
      2 => 'file',
    ),
    '1c42df8ae26057585b6d346ffef9d76f51d123d9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/editor.tpl',
      1 => 1389717993,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5312616352b92ab84681c3-63675347',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b92ab853a443_57411277',
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
<?php if ($_valid && !is_callable('content_52b92ab853a443_57411277')) {function content_52b92ab853a443_57411277($_smarty_tpl) {?><?php if (!is_callable('smarty_function_print_children')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/function.print_children.php';
?>
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

            <div class="codo_widget">
                <div class="codo_widget-header">
                    <?php echo _("Create Topic");?>

                </div>

                <div class="codo_widget-content">
                    <form id="codo_new_reply_post"  method="POST" class="" role="form">

                        <div class="form-group">
                            <label for="title"><?php echo _("Title");?>
</label>
                            <div>
                                <input id="codo_topic_title" type="text" class="codo_input" value="<?php echo $_smarty_tpl->tpl_vars['topic']->value['title'];?>
" placeholder="<?php echo _('Give a title for your topic');?>
" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category"><?php echo _('Category');?>
</label>

                            <div>
                                <div class="dropdown" id="codo_category_select">
                                    <button value="" class="btn dropdown-toggle btn-default" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                        <span><?php echo _("Select a category");?>
</span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                        <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>

                                            <li role="presentation"><a id="<?php echo $_smarty_tpl->tpl_vars['cat']->value->cat_id;?>
" data-alias="<?php echo $_smarty_tpl->tpl_vars['cat']->value->cat_alias;?>
"><?php echo $_smarty_tpl->tpl_vars['cat']->value->cat_name;?>
</a></li>

                                            <?php echo smarty_function_print_children(array('cat'=>$_smarty_tpl->tpl_vars['cat']->value),$_smarty_tpl);?>

                                        <?php } ?>


                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div id="codo_new_reply" class="codo_new_reply">

                            <!--<div class="codo_reply_resize_handle"></div>-->

                            <div class="codo_reply_box" id="codo_reply_box">
                                <textarea placeholder="<?php echo _('Describe your topic . You can use BBcode or Markdown');?>
" id="codo_new_reply_textarea" name="input_text"><?php echo $_smarty_tpl->tpl_vars['topic']->value['imessage'];?>
</textarea>
                                <div class="codo_new_reply_preview" id="codo_new_reply_preview_container">
                                    <div class="codo_editor_preview_placeholder"><?php echo _("live preview");?>
</div>
                                    <div id="codo_new_reply_preview"></div>
                                </div>
                            </div>

                            <div class="codo_new_reply_action">
                                <button class="codo_btn" id="codo_new_reply_action_post"><?php echo _("Post");?>
</button>
                                <button onclick="window.history.back()" class="codo_btn codo_btn_def" id="codo_new_reply_action_cancel"><?php echo _("Cancel");?>
</button>

                                <img id="codo_new_reply_loading" src="<?php echo @constant('CURR_THEME');?>
img/ajax-loader.gif" />
                                <button class="codo_btn codo_btn_def codo_post_preview_bg" id="codo_post_preview_btn">&nbsp;</button>                        
                            </div>
                            <input type="text" class="end-of-line" name="end_of_line" />                        

                            <div class="codo_reply_min_chars"><?php echo _("enter atleast ");?>
<span id="codo_reply_min_chars_left"><?php echo $_smarty_tpl->tpl_vars['reply_min_chars']->value;?>
</span><?php echo _(" characters");?>
</div>
                        </div>

                        <input type="text" class="end-of-line" name="end_of_line" />
                        <input id="codo_topic_cat" name="codo_topic_cat" type="hidden" />
                        <input id="codo_topic_cat_alias" name="codo_topic_cat_alias" type="hidden" />
                        <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
" />

                    </form>
                </div>
            </div>
        </div>

        <?php /*  Call merged included template "forum/editor.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('forum/editor.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '5312616352b92ab84681c3-63675347');
content_52fceb6dde06c4_90628213($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "forum/editor.tpl" */?>
    </div>
    <script type="text/javascript">


        CODOF.pass = {
            smileys: JSON.parse('<?php echo $_smarty_tpl->tpl_vars['forum_smileys']->value;?>
'),
            reply_min_chars: parseInt(<?php echo $_smarty_tpl->tpl_vars['reply_min_chars']->value;?>
),
            dropzone: {
                dictDefaultMessage: '<?php echo _("Drop files to upload &nbsp;&nbsp;(or click)");?>
',
                max_file_size: parseInt('<?php echo $_smarty_tpl->tpl_vars['max_file_size']->value;?>
'),
                allowed_file_mimetypes: '<?php echo $_smarty_tpl->tpl_vars['allowed_file_mimetypes']->value;?>
',
                forum_attachments_multiple: <?php echo $_smarty_tpl->tpl_vars['forum_attachments_multiple']->value;?>
,
                forum_attachments_parallel: parseInt('<?php echo $_smarty_tpl->tpl_vars['forum_attachments_parallel']->value;?>
'),
                forum_attachments_max: parseInt('<?php echo $_smarty_tpl->tpl_vars['forum_attachments_max']->value;?>
')

            }

        };

        jQuery('document').ready(function($) {

            $('html, body').animate({
                scrollTop: $(".codo_widget-header").offset().top
            }, 500);
            CODOF.editor_form = $('#codo_new_reply_post');
            CODOF.editor_preview_btn = $('#codo_post_preview_btn');
            CODOF.editor_reply_post_btn = $('#codo_new_reply_action_post');

            $('#codo_new_reply_textarea').putCursorAtEnd();
            $('#codo_category_select li  a').on('click', function() {

                $('#codo_category_select > button > span:first-child').text($.trim($(this).text()));
                $('#codo_topic_cat').val($(this).attr('id'));
                $('#dropdownMenu1').val($(this).attr('id'));
                $('#codo_topic_cat_alias').val($(this).data('alias'));

            });

            function select_curr_cat() {


                var cat_id = parseInt('<?php echo $_smarty_tpl->tpl_vars['topic']->value['cat_id'];?>
');

                CODOF.edit_topic_id = false;

                if (cat_id !== 0) {

                    CODOF.edit_topic_id = parseInt('<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_id'];?>
');

                    $('#codo_category_select li  a').each(function() {

                        if (parseInt($(this).attr('id')) === cat_id) {

                            $(this).trigger('click');
                            $('#codo_category_select li  a').off();
                            $('#codo_new_reply_action_post').html('<?php echo _("Edit");?>
');
                            //$('#codo_category_select button').css('background','#eee');
                        }
                    });
                }

            }
            ;

            select_curr_cat();



            CODOF.submitted = function() {
                //$('#codo_reply_replica').val($('#codo_new_reply_preview').html());

                if (CODOF.editor_reply_post_btn.hasClass('codo_btn_primary') && !CODOF.is_error()) {
                    CODOF.editor_reply_post_btn.removeClass('codo_btn_primary');
                    $('#codo_new_reply_loading').show();

                    var action = 'create';
                    if (CODOF.edit_topic_id) {

                        action = 'edit';
                    }
                    $.post(
                            codo_defs.url + 'Ajax/forum/topic/' + action,
                            {
                                title: $.trim($('#codo_topic_title').val()),
                                cat: $.trim($('#codo_topic_cat').val()),
                                imesg: $('#codo_new_reply_textarea').val(),
                                omesg: $('#codo_new_reply_preview').html(),
                                end_of_line: $('#end_of_line').val(),
                                token: codo_defs.token,
                                tid: CODOF.edit_topic_id
                            },
                    function(response) {

                        if (response === "success") {
                            if (CODOF.edit_topic_id) {
                                window.history.back()
                            } else
                                window.location.href = codo_defs.url + 'forum/topics/' + $('#codo_topic_cat_alias').val();
                        } else {
                            alert(response);
                            CODOF.editor_reply_post_btn.addClass('codo_btn_primary')
                        }

                        $('#codo_new_topic_loader').hide();
                    }
                    );


                }

                return false;
            };

            CODOF.is_error = function() {

                var error = false;

                var val = $.trim($('#dropdownMenu1').val());

                if (val === "") {

                    $('#dropdownMenu1').addClass('boundary-error').focus();
                    error = true;
                } else {

                    $('#dropdownMenu1').removeClass('boundary-error');
                }

                $('#codo_new_reply_post :input[required=""],#codo_new_reply_post :input[required]').each(function() {

                    var val = $(this).val();

                    if ($.trim(val) === "") {

                        $(this).addClass('boundary-error').focus();
                        error = true;
                        return false;
                    } else {
                        $(this).removeClass('boundary-error')
                    }
                });

                return error;
            };
        });

    </script>


    <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/markitup/jquery.markitup.js"></script>
    <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/markitup/parsers/marked.js"></script>
    <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/markitup/highlight/highlight.pack.js"></script>
    <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/dropzone/dropzone.js"></script>
    <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/js/editor.js"></script>
    <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/js/fittext.js"></script>
    <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/js/griphandler.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo @constant('DURI');?>
assets/markitup/highlight/styles/github.css" />    
    <link rel="stylesheet" type="text/css" href="<?php echo @constant('DURI');?>
assets/dropzone/css/basic.css" />    



    <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

</body>

</html>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2014-02-13 16:57:33
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/editor.tpl" */ ?>
<?php if ($_valid && !is_callable('content_52fceb6dde06c4_90628213')) {function content_52fceb6dde06c4_90628213($_smarty_tpl) {?>




<!-- Modal -->
<div class="modal animated bounceInDown" id="codo_modal_link" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo _("Add link");?>
</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">

                    <input id="codo_modal_link_url" name="element_1" type="text" class="form-control" placeholder="<?php echo _("link url");?>
" required=""/>
                    <hr/>

                    <input id="codo_modal_link_text" name="element_2" type="text" class="form-control" placeholder="<?php echo _("link text");?>
 - <?php echo _("optional");?>
"/>
                    <hr/>

                    <input id="codo_modal_link_title" name="element_3" type="text" class="form-control" placeholder="<?php echo _("link title");?>
 - <?php echo _("optional");?>
"/>
                </form>

            </div>
            <div class="modal-footer">
                <div class="codo_modal_link_cancel codo_btn codo_btn_def" data-dismiss="modal"><?php echo _("Cancel");?>
</div>
                <div id="codo_modal_link_submit" class="codo_btn codo_btn_primary"><?php echo _("Add");?>
</div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div class="modal animated bounceInDown" id="codo_modal_upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo _("Upload");?>
</h4>
            </div>
            <div class="modal-body">
                <form class="dropzone"
                      id="codomyawesomedropzone">

                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                    <input name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
" />
                </form>

            </div>
            <div class="modal-footer">
                <div class="codo_modal_upload_cancel codo_btn codo_btn_def" data-dismiss="modal"><?php echo _("Cancel");?>
</div>
                <div id="codo_modal_upload_submit" class="codo_btn"><?php echo _("Upload");?>
</div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php }} ?>
