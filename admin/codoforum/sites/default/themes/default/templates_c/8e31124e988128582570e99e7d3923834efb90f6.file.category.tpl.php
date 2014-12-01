<?php /* Smarty version Smarty-3.1.16, created on 2014-02-13 17:02:14
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45101950252b85b0f6e0af7-36220852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e31124e988128582570e99e7d3923834efb90f6' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/category.tpl',
      1 => 1392306701,
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
  'nocache_hash' => '45101950252b85b0f6e0af7-36220852',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b85b0f861142_97389620',
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
<?php if ($_valid && !is_callable('content_52b85b0f861142_97389620')) {function content_52b85b0f861142_97389620($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_abbrev_no')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.abbrev_no.php';
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

    

    <div class="marker left"></div>
    <div class="marker right"></div>

    <div class="codo_container" id="codo_category_topics">

        <div class="row">

            <div class="codo_upper_container codo_topics clearfix" id="codo_upper_container">

                <div id="codo_topics_create" class="codo_topics_create">
                    <div class="codo_widget">
                        <div class="codo_widget-header codo_topics_on_focus_show">
                            <?php echo _("Create Topic");?>

                        </div>

                        <div class="codo_widget-content">
                            <form id="codo_new_topic_form" method="POST" class="" role="form">

                                <div class="form-group codo_topics_on_focus_show">
                                    <div>
                                        <input id="codo_topic_title" type="text" class="codo_input" placeholder="<?php echo _("Give a title for your topic");?>
" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div id="codo_topic_desc_div" class="form-control"><?php echo _("Create new topic");?>
</div>
                                    


                                    <div id="codo_new_reply" class="codo_new_reply">

                                        <!--<div class="codo_reply_resize_handle"></div>-->

                                        <div class="codo_reply_box" id="codo_reply_box">
                                            <textarea placeholder="<?php echo _('Describe your topic . You can use BBcode or Markdown');?>
" id="codo_new_reply_textarea" name="input_text"></textarea>
                                            <div class="codo_new_reply_preview" id="codo_new_reply_preview_container">
                                                <div class="codo_editor_preview_placeholder"><?php echo _("live preview");?>
</div>
                                                <div id="codo_new_reply_preview"></div>
                                            </div>
                                        </div>

                                        <div class="codo_new_reply_action">
                                            <button class="codo_btn" id="codo_new_topic_btn"><?php echo _("Post");?>
</button>
                                            <button class="codo_btn codo_btn_def" id="codo_cancel_topic_btn"><?php echo _("Cancel");?>
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

                                </div>

                                <div class="form-group codo_topics_on_focus_show">

                                    <input type="text" class="end-of-line" name="end_of_line" />
                                    <input id="codo_topic_cat" name="codo_topic_cat" type="hidden" />
                                    <input id="codo_topic_cat_alias" name="codo_topic_cat_alias" type="hidden" />
                                </div>
                            </form>
                        </div>

                    </div>

                </div>


                
                <div id="codo_empty_space" style="display: none"></div>

                <div class="codo_categories" id="codo_categories">

                    <div class="codo_cat_title"><?php echo $_smarty_tpl->tpl_vars['cat_info']->value['cat_name'];?>
</div>

                    <div class="codo_cat_imgs">
                        <div class="codo_cat_img">
                            <img id="codo_cat_img" draggable="false" src="<?php echo @constant('DURI');?>
<?php echo @constant('CAT_IMGS');?>
<?php echo $_smarty_tpl->tpl_vars['cat_info']->value['cat_img'];?>
" />
                        </div>
                    </div>
                    <div class="codo_cat_desc"><?php echo $_smarty_tpl->tpl_vars['cat_info']->value['cat_description'];?>
</div>
                    <div class="codo_cat_info clearfix">

                        <div class="codo_cat_num">
                            <div><?php echo smarty_modifier_abbrev_no($_smarty_tpl->tpl_vars['cat_info']->value['no_topics']);?>
</div>
                            <?php echo _("Topics");?>

                        </div>

                        <div class="codo_cat_num">
                            <div><?php echo smarty_modifier_abbrev_no($_smarty_tpl->tpl_vars['cat_info']->value['no_posts']);?>
</div>
                            <?php echo _("Posts");?>

                        </div>
                    </div>

                    <div class="codo_sub_categories">

                        <?php if (!empty($_smarty_tpl->tpl_vars['sub_cats']->value)) {?>
                            <div class="codo_sub_categories_txt"><?php echo _("sub-categories");?>
</div>
                        <?php }?>
                        <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sub_cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>

                            <div class="clearfix">
                                <a class="codo_categories_category" href="<?php echo @constant('RURI');?>
forum/topics/<?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_alias'];?>
">
                                    <div class="codo_category_img">
                                        <img draggable="false" src="<?php echo @constant('DURI');?>
<?php echo @constant('CAT_IMGS');?>
<?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_img'];?>
" />
                                    </div>
                                    <div class="codo_category_title"><?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_name'];?>
</div>
                                    <div class="codo_category_content"><span><?php echo $_smarty_tpl->tpl_vars['cat']->value['no_topics'];?>
 </span><?php echo _("topics");?>


                                        <?php if ($_smarty_tpl->tpl_vars['cat']->value['no_sub_cats']>0) {?>
                                            &middot; <span><?php echo $_smarty_tpl->tpl_vars['cat']->value['no_sub_cats'];?>
 </span><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['cat']->value['no_sub_cats'];?>
<?php $_tmp1=ob_get_clean();?><?php echo ngettext("sub-category","sub-categories",$_tmp1);?>

                                        <?php }?>
                                    </div>
                                </a>
                            </div>

                        <?php } ?>

                    </div>
                </div>

            </div>


            <div class="codo_lower_containers" id="codo_lower_containers">
                <div class="codo_topics" id="codo_topics_container_1">

                    <?php  $_smarty_tpl->tpl_vars['topic'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['topic']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['topics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['category']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['topic']->key => $_smarty_tpl->tpl_vars['topic']->value) {
$_smarty_tpl->tpl_vars['topic']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['category']['iteration']++;
?>

                        <?php $_smarty_tpl->tpl_vars["avatar"] = new Smarty_variable($_smarty_tpl->tpl_vars['topic']->value['avatar'], null, 0);?>

                        <?php if ($_smarty_tpl->tpl_vars['avatar']->value==null) {?>

                            <?php $_smarty_tpl->tpl_vars["avatar"] = new Smarty_variable(((string)@constant('DURI')).((string)@constant('DEF_AVATAR')), null, 0);?>
                        <?php }?>

                        <article id="codo_topics_article_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['category']['iteration'];?>
">
                            <div class="codo_topics_topic_content">

                                <div class="codo_posts_post_moderation">

                                    <?php if ($_smarty_tpl->tpl_vars['topic']->value['can_edit_topic']) {?>
                                        <div id="codo_posts_edit_<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_id'];?>
" class="codo_posts_edit_post codo_post_this_is_topic">
                                            <img src="<?php echo @constant('CURR_THEME');?>
img/edit2.png" />
                                        </div>
                                    <?php }?>

                                    <?php if ($_smarty_tpl->tpl_vars['topic']->value['can_delete_topic']) {?>
                                        <div rel='popover' id="codo_posts_trash_<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_id'];?>
" class="codo_posts_trash_post codo_post_this_is_topic">
                                            <div class="codo_spinner"></div>
                                            <img src="<?php echo @constant('CURR_THEME');?>
img/trash.png" />
                                        </div>
                                    <?php }?>

                                </div>

                                <div class="codo_topics_topic_avatar">
                                    <a href="<?php echo @constant('RURI');?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['topic']->value['id'];?>
">
                                        <img draggable="false" src="<?php echo $_smarty_tpl->tpl_vars['avatar']->value;?>
" />
                                    </a>
                                </div>
                                <div class="codo_topics_topic_name">
                                    <a href="<?php echo @constant('RURI');?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['topic']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['topic']->value['name'];?>
</a>
                                    <span><?php echo _("posted ");?>
<?php echo $_smarty_tpl->tpl_vars['topic']->value['post_created'];?>
</span>
                                </div>
                                <div class="codo_topics_topic_title">
                                    <a href="<?php echo @constant('RURI');?>
forum/topic/<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['topic']->value['safe_title'];?>
"><?php echo $_smarty_tpl->tpl_vars['topic']->value['title'];?>
</a>
                                </div>

                            </div>

                            <div id="codo_topics_topic_message_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['category']['iteration'];?>
" class="codo_topics_topic_message"><?php echo $_smarty_tpl->tpl_vars['topic']->value['message'];?>
</div>
                            <div id="codo_topics_topic_more_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['category']['iteration'];?>
" class="codo_topics_topic_readmore">
                                <a href="<?php echo @constant('RURI');?>
forum/topic/<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['topic']->value['safe_title'];?>
">
                                    <?php echo _('read more');?>

                                </a>
                            </div>

                            <div class="codo_topics_topic_foot clearfix">

                                <div class="codo_topics_no_replies"><span><?php echo $_smarty_tpl->tpl_vars['topic']->value['no_replies'];?>
</span><?php echo _("replies");?>
</div>
                                <div class="codo_topics_no_replies"><span><?php echo $_smarty_tpl->tpl_vars['topic']->value['no_views'];?>
</span><?php echo _("views");?>
</div>

                                <?php if ($_smarty_tpl->tpl_vars['topic']->value['lpost_time']!=null) {?>
                                    <div class="codo_topics_last_post">
                                        <?php echo _('recent by');?>
 <a href="<?php echo @constant('RURI');?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['topic']->value['luid'];?>
"><?php echo $_smarty_tpl->tpl_vars['topic']->value['lname'];?>
</a>
                                        &nbsp;&middot;&nbsp; <?php echo $_smarty_tpl->tpl_vars['topic']->value['lpost_time'];?>

                                    </div>

                                <?php }?>
                            </div>

                        </article>

                    <?php } ?>

                </div>


                <div class="codo_topics_pagination">

                    <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

                </div>


            </div>



            

                <script id="codo_pagination" type="text/html">

                    <div class="codo_topics_pagination">


                        {{#each page}}

                        {{#if last}}
                        ...
                        {{/if}}


                        {{#if active}}
                        <a class="codo_topics_curr_page">{{page}}</a>
                        {{else}}
                        <a href="{{../../constants.RURI}}forum/topics/{{../../constants.cat_alias}}/{{page}}">{{page}}</a>
                        {{/if}}

                        {{#if first}}
                        ...
                        {{/if}}


                        {{/each}}

                    </div>


                    </script>

                    <script id="codo_template" type="text/html">

                        <article class="{{position}} codo_ajax_article" id="{{aid}}">

                            <div class="codo_topics_topic_content">

                                <div class="codo_posts_post_moderation">

                                    {{#if can_edit_topic}}
                                    <div id="codo_posts_edit_{{topic_id}}" class="codo_posts_edit_post codo_post_this_is_topic">
                                        <img src="{{CURR_THEME}}img/edit2.png" />
                                    </div>
                                    {{/if}}

                                    {{#if can_delete_topic}}
                                    <div rel='popover' id="codo_posts_trash_{{topic_id}}" class="codo_posts_trash_post codo_post_this_is_topic">
                                        <div class="codo_spinner"></div>
                                        <img src="{{CURR_THEME}}img/trash.png" />
                                    </div>
                                    {{/if}}
                                </div>

                                <div class="codo_topics_topic_avatar">
                                    <a href="{{RURI}}user/profile/{{id}}">

                                        {{#if avatar}}
                                        <img draggable="false" src="{{avatar}}" />
                                        {{else}}
                                        <img draggable="false" src="{{DURI}}{{DEF_AVATAR}}" />
                                        {{/if}}

                                    </a>
                                </div>
                                <div class="codo_topics_topic_name">
                                    <a href="{{RURI}}user/profile/{{id}}">{{name}}</a>
                                    <span>{{posted}} {{post_created}}</span>
                                </div>
                                <div class="codo_topics_topic_title"><a href="{{RURI}}forum/topic/{{topic_id}}/{{safe_title}}">{{title}}</a></div>
                            </div>
                            <div id="codo_topics_topic_message_{{cid}}" class="codo_topics_topic_message">{{{message}}}</div>
                            <div id="codo_topics_topic_more_{{cid}}" class="codo_topics_topic_readmore">
                                <a href="{{RURI}}forum/topic/{{topic_id}}/{{safe_title}}">
                                    {{read_more}}
                                </a>
                            </div>

                            <div class="codo_topics_topic_foot clearfix">

                                <div class="codo_topics_no_replies"><span>{{no_replies}}</span>{{replies}}</div>
                                <div class="codo_topics_no_replies"><span>{{no_views}}</span>{{views}}</div>

                                {{#if lpost_time}}
                                <div class="codo_topics_last_post">
                                    {{recent_by}} <a href="{{RURI}}user/profile/{{luid}}">{{lname}}</a>
                                    &nbsp;&middot;&nbsp; {{lpost_time}}
                                </div>
                                {{/if}}

                            </div>

                        </article>

                        </script>
                    
                </div>
                <?php /*  Call merged included template "forum/editor.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('forum/editor.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '45101950252b85b0f6e0af7-36220852');
content_52fcec86b3b149_52006168($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "forum/editor.tpl" */?>
                <div id='codo_delete_topic_confirm_html'>
                    <div class='codo_posts_topic_delete'>
                        <div class='codo_content'>
                            <?php echo _("All posts under this topic will be ");?>
<b><?php echo _("deleted");?>
</b> ?
                        </div>
                        <div class="codo_modal_footer">
                            <div class="codo_btn codo_btn_def codo_modal_delete_topic_cancel"><?php echo _("Cancel");?>
</div>
                            <div class="codo_btn codo_btn_primary codo_modal_delete_topic_submit"><?php echo _("Delete");?>
</div>
                        </div>
                        <div class="codo_spinner"></div>
                    </div>
                </div>

            </div>

            <script type="text/javascript">

                                                                                CODOF.pass = {
                                                                                catid: '<?php echo $_smarty_tpl->tpl_vars['cat_info']->value['cat_id'];?>
',
                                                                                        cat_alias: '<?php echo $_smarty_tpl->tpl_vars['cat_alias']->value;?>
',
                                                                                        num_pages: parseInt('<?php echo $_smarty_tpl->tpl_vars['num_pages']->value;?>
'),
                                                                                        curr_page: parseInt('<?php echo $_smarty_tpl->tpl_vars['curr_page']->value;?>
'),
                                                                                        constants: JSON.parse('<?php echo $_smarty_tpl->tpl_vars['constants']->value;?>
'),
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

                                                                                }

            </script>

            <script src="<?php echo @constant('DURI');?>
assets/js/category/category.js"></script>
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

            <script src="<?php echo @constant('DURI');?>
assets/js/category/jquery.easing.1.3.js"></script>

        

    <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

</body>

</html>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2014-02-13 17:02:14
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/editor.tpl" */ ?>
<?php if ($_valid && !is_callable('content_52fcec86b3b149_52006168')) {function content_52fcec86b3b149_52006168($_smarty_tpl) {?>




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
