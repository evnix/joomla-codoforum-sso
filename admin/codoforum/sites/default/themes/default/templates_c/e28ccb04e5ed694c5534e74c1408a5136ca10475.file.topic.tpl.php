<?php /* Smarty version Smarty-3.1.16, created on 2014-05-31 06:11:24
         compiled from "/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/forum/topic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159097800552fd931900b1e9-81908258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e28ccb04e5ed694c5534e74c1408a5136ca10475' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/forum/topic.tpl',
      1 => 1401513082,
      2 => 'file',
    ),
    'd4abc0502b2b173e5dfcd5d7949b028f1e336780' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/layout.tpl',
      1 => 1401014858,
      2 => 'file',
    ),
    '0ce1a96597d0c5fa15cf67b1459b1d3ae735af5d' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/forum/editor.tpl',
      1 => 1389717993,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159097800552fd931900b1e9-81908258',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52fd93194b20d6_66421576',
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
<?php if ($_valid && !is_callable('content_52fd93194b20d6_66421576')) {function content_52fd93194b20d6_66421576($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_URL_safe')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.URL_safe.php';
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

    

    <?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_smarty_tpl->tpl_vars['topic_info']->value['title'], null, 0);?>
    <?php $_smarty_tpl->tpl_vars["safe_title"] = new Smarty_variable(smarty_modifier_URL_safe($_smarty_tpl->tpl_vars['title']->value), null, 0);?>
    <?php $_smarty_tpl->tpl_vars["tid"] = new Smarty_variable($_smarty_tpl->tpl_vars['topic_info']->value['topic_id'], null, 0);?>

    <div class="codo_container">

        <div class="row">

            <ol class="codo_breadcrumb" style="margin-left: 14px;margin-right: 14px;">
                <li><a href="<?php echo @constant('RURI');?>
<?php echo $_smarty_tpl->tpl_vars['site_url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['home_title']->value;?>
</a></li>
                <li><a href="<?php echo @constant('RURI');?>
forum/topics/<?php echo $_smarty_tpl->tpl_vars['topic_info']->value['cat_alias'];?>
"><?php echo $_smarty_tpl->tpl_vars['topic_info']->value['cat_name'];?>
</a></li>
                <li><?php echo $_smarty_tpl->tpl_vars['topic_info']->value['title'];?>
</li>
                <li id="codo_advanced_search_li" class="advanced_search">
                    <form method="GET" id="codo_search_form">

                        <div class="codo_basic_search">
                            <input id="codo_search_keywords" class="codo_topics_search" placeholder="<?php echo _('Search in ');?>
<?php echo $_smarty_tpl->tpl_vars['topic_info']->value['title'];?>
" name="search" type="text" />
                            <a class="codo_search_flip" id="codo_search_open_advanced" title="<?php echo _('Advanced search');?>
" >
                                <span class='advanced_search_dropdown'></span>
                            </a>
                        </div>

                    </form>
                </li>                
            </ol>

            <div class="codo_search_advanced_options" id="codo_search_advanced_options">


                <div class="row">

                    <label class="control-label col-md-4"><?php echo _("Sort results by");?>
</label>

                    <div class="col-md-8">

                        <select name="search_sort" id="codo_search_sort" class="codo_input">
                            <option value="name"><?php echo _("Author");?>
</option>
                            <option value="post_created" selected="selected"><?php echo _("Post created");?>
</option>
                            <option value="last_post_time"><?php echo _("Last post time");?>
</option>
                            <option value="message"><?php echo _("Post body");?>
</option>
                        </select>
                        <div id="codo_search_order_switch" class="codo_switch codo_switch_off" style="position:absolute;left:54%;top:5px;">
                            <div class="codo_switch_toggle"></div>
                            <span class="codo_switch_on"><?php echo _('Asc');?>
</span>
                            <span class="codo_switch_off" style="color:#1471af"><?php echo _('Desc');?>
</span>

                        </div>

                    </div>
                </div>
                <div class="row">

                    <label class="control-label col-md-4"><?php echo _("Search within");?>
</label>

                    <div class="col-md-8">

                        <select name="search_time" id="codo_search_time" class="codo_input">
                            <option value="anytime" selected><?php echo _("Any time");?>
</option>
                            <option value="hour"><?php echo _("Past hour");?>
</option>
                            <option value="day"><?php echo _("Past 24 hours");?>
</option>
                            <option value="week"><?php echo _("Past week");?>
</option>
                            <option value="month"><?php echo _("Past month");?>
</option>
                            <option value="year"><?php echo _("Past year");?>
</option>
                        </select>
                    </div>
                </div>
                <div class="row">        
                    <div class="col-sm-offset-4 col-sm-8">
                        <button id="codo_search_btn" class="codo_btn codo_btn_primary"><?php echo _("Search");?>
</button>
                    </div>
                </div>
            </div>

            <div class="codo_posts col-md-9">


                <div class="codo_widget">
                    <div class="codo_widget-header" id="codo_head_title">
                        <div class="row">
                            <div class="codo_topic_title">
                                <a href="<?php echo @constant('RURI');?>
forum/topic/<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['safe_title']->value;?>
">
                                    <h1><div class="codo_widget_header_title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div></h1>
                                </a>
                            </div>
                            <div id="codo_topic_title_pagination">
                            </div>
                        </div>
                    </div>


                    <div style="display: none" id="codo_no_topics_display" class="codo_no_topics"><?php echo _("No posts to display");?>
</div>

                    <div id="codo_posts_container" class="codo_widget-content">

                        <?php if (!$_smarty_tpl->tpl_vars['posts']->value) {?>

                            
                            No posts to display!
                        <?php }?>

                        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>

                            <?php $_smarty_tpl->tpl_vars["avatar"] = new Smarty_variable($_smarty_tpl->tpl_vars['post']->value['avatar'], null, 0);?>

                            <?php if (!$_smarty_tpl->tpl_vars['avatar']->value) {?>

                                <?php $_smarty_tpl->tpl_vars["avatar"] = new Smarty_variable(((string)@constant('DURI')).((string)@constant('DEF_AVATAR')), null, 0);?>
                            <?php }?>

                            <a name="post-<?php echo $_smarty_tpl->tpl_vars['post']->value['post_id'];?>
"></a>
                            <article id="post-<?php echo $_smarty_tpl->tpl_vars['post']->value['post_id'];?>
" class="clearfix">

                                <div class="codo_posts_post_moderation">
                                    <?php if ($_smarty_tpl->tpl_vars['post']->value['post_id']==$_smarty_tpl->tpl_vars['topic_info']->value['post_id']) {?>
                                        
                                        <?php if ($_smarty_tpl->tpl_vars['can_edit_topic']->value=='true') {?>
                                            <div class="codo_posts_edit_post codo_post_this_is_topic">
                                                <img src="<?php echo @constant('CURR_THEME');?>
img/edit2.png" />
                                            </div>
                                        <?php }?>

                                        <?php if ($_smarty_tpl->tpl_vars['can_delete_topic']->value=='true') {?>
                                            <div rel='popover' id="codo_posts_trash_<?php echo $_smarty_tpl->tpl_vars['post']->value['post_id'];?>
" class="codo_posts_trash_post codo_post_this_is_topic">
                                                <div class="codo_spinner"></div>
                                                <img src="<?php echo @constant('CURR_THEME');?>
img/trash.png" />
                                            </div>
                                        <?php }?>

                                    <?php } else { ?>
                                        
                                        <?php if ($_smarty_tpl->tpl_vars['post']->value['can_edit_post']) {?>
                                            <div class="codo_posts_edit_post codo_post_this_is_post" id="codo_posts_edit_<?php echo $_smarty_tpl->tpl_vars['post']->value['post_id'];?>
">
                                                <img src="<?php echo @constant('CURR_THEME');?>
img/edit2.png" />
                                            </div>
                                        <?php }?>

                                        <?php if ($_smarty_tpl->tpl_vars['post']->value['can_delete_post']) {?>
                                            <div id="codo_posts_trash_<?php echo $_smarty_tpl->tpl_vars['post']->value['post_id'];?>
" class="codo_posts_trash_post codo_post_this_is_post">
                                                <div class="codo_spinner"></div>
                                                <img src="<?php echo @constant('CURR_THEME');?>
img/trash.png" />
                                            </div>
                                        <?php }?>

                                    <?php }?>



                                </div>

                                <div class="codo_posts_user_info">
                                    <div class="codo_posts_post_avatar">
                                        <a href="<?php echo @constant('RURI');?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
">
                                            <img draggable="false" src="<?php echo $_smarty_tpl->tpl_vars['avatar']->value;?>
" />
                                        </a>
                                    </div>


                                    <div class="codo_posts_post_name">
                                        <a href="<?php echo @constant('RURI');?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
</a>

                                    </div>
                                    <div class="codo_posts_post_desc">
                                        <span>
                                            <?php echo _("posted");?>

                                            <a href="<?php echo @constant('RURI');?>
forum/topic/<?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['safe_title']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['curr_page']->value;?>
#post-<?php echo $_smarty_tpl->tpl_vars['post']->value['post_id'];?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['post']->value['post_created'];?>

                                            </a>
                                        </span>
                                    </div>

                                    <div class="codo_posts_user_spec">
                                        <!--<div><<?php ?>?php //echo $post.num_posts}&nbsp;<<?php ?>?php //echo _("posts")}</div>-->
                                        <!--<hr/>-->
                                        <!--<div><<?php ?>?php //echo $post.role}</div>-->
                                    </div>
                                </div>
                                <div class="codo_posts_post_content">
                                    <div class="codo_posts_post_message"><?php echo $_smarty_tpl->tpl_vars['post']->value['message'];?>
</div>
                                    <div class="codo_posts_post_imessage"><?php echo $_smarty_tpl->tpl_vars['post']->value['imessage'];?>
</div>

                                    <?php if ($_smarty_tpl->tpl_vars['post']->value['signature']) {?>
                                        <div class="codo_posts_signature"><?php echo $_smarty_tpl->tpl_vars['post']->value['signature'];?>
</div>
                                    <?php }?>

                                </div>

                                <div class="codo_posts_post_foot clearfix">

                                    <div class="codo_posts_post_action">
                                        <div class="btn-group">
                                            <div class="codo_btn_def codo_quote_btn"><img src="<?php echo @constant('CURR_THEME');?>
img/quote-left.png" /></div>
                                            <div class="codo_btn_primary codo_btn codo_reply_btn"><?php echo _("reply");?>
</div>
                                        </div>
                                    </div>
                                </div>

                            </article>
                            <div class="codo_topic_separator"></div>
                        <?php } ?>

                        <?php if ($_smarty_tpl->tpl_vars['num_pages']->value>1) {?>
                            <div class="codo_topics_pagination">

                                <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

                            </div>
                        <?php }?>

                    </div>
                </div>
            </div>

            <div class="codo_topic col-md-3" id="codo_topic_sidebar">

                <div class="codo_topic_statistics">

                    <div class="codo_cat_num">
                        <div id="codo_topic_views" data-number="<?php echo $_smarty_tpl->tpl_vars['topic_info']->value['no_views'];?>
">
                            <?php echo smarty_modifier_abbrev_no($_smarty_tpl->tpl_vars['topic_info']->value['no_views']);?>

                        </div>
                        <?php echo _('views');?>

                    </div>
                    <div class="codo_cat_num">
                        <div>
                            <?php echo smarty_modifier_abbrev_no($_smarty_tpl->tpl_vars['topic_info']->value['no_replies']);?>

                        </div>
                        <?php echo _('replies');?>

                    </div>

                </div>

            </div>
        </div>
        <div id="codo_new_reply" class="codo_new_reply">

            <div class="codo_reply_resize_handle"></div>
            <form id="codo_new_reply_post" action="/" method="POST">

                <div class="codo_reply_box" id="codo_reply_box">
                    <textarea placeholder="<?php echo _('Start typing here . You can use BBcode or Markdown');?>
" id="codo_new_reply_textarea" name="input_text"></textarea>
                    <div class="codo_new_reply_preview" id="codo_new_reply_preview_container">
                        <div class="codo_editor_preview_placeholder"><?php echo _("live preview");?>
</div>
                        <div id="codo_new_reply_preview"></div>
                    </div>
                </div>

                <div class="codo_new_reply_action">
                    <button class="codo_btn" id="codo_post_new_reply"><?php echo _("Post");?>
</button>
                    <button class="codo_btn codo_btn_def" id="codo_post_cancel"><?php echo _("Cancel");?>
</button>

                    <img id="codo_new_reply_loading" src="<?php echo @constant('CURR_THEME');?>
img/ajax-loader.gif" />
                    <button class="codo_btn codo_btn_def codo_post_preview_bg" id="codo_post_preview_btn">&nbsp;</button>
                    <button class="codo_btn codo_btn_def codo_post_preview_bg" id="codo_post_preview_btn_resp">&nbsp;</button>                    
                </div>
                <input type="text" class="end-of-line" name="end_of_line" id="end_of_line" />
            </form>

            <div class="codo_reply_min_chars"><?php echo _("enter atleast ");?>
<span id="codo_reply_min_chars_left"><?php echo $_smarty_tpl->tpl_vars['reply_min_chars']->value;?>
</span><?php echo _(" characters");?>
</div>
        </div>

        <?php /*  Call merged included template "forum/editor.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('forum/editor.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '159097800552fd931900b1e9-81908258');
content_5389647cd715c3_29204023($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "forum/editor.tpl" */?>
    </div>
    

        <script id="codo_template" type="text/html">

            <a name="post-{{post_id}}"></a>
            <article id="post-{{post_id}}" class="clearfix">

                <div class="codo_posts_post_moderation">


                    {{#if can_edit_topic}}
                    <div class="codo_posts_edit_post codo_post_this_is_topic"><img src="{{CURR_THEME}}img/edit2.png" /></div>
                    {{/if}}

                    {{#if can_delete_topic}}
                    <div rel='popover' id="codo_posts_trash_{{post_id}}" class="codo_posts_trash_post codo_post_this_is_topic">
                        <div class="codo_spinner"></div>
                        <img src="{{CURR_THEME}}img/trash.png" />
                    </div>
                    {{/if}}

                    {{#if can_edit_post}}
                    <div class="codo_posts_edit_post codo_post_this_is_post" id="codo_posts_edit_{{post_id}}">
                        <img src="{{CURR_THEME}}img/edit2.png" />
                    </div>
                    {{/if}}

                    {{#if can_delete_post}}
                    <div id="codo_posts_trash_{{post_id}}" class="codo_posts_trash_post codo_post_this_is_post">
                        <div class="codo_spinner"></div>
                        <img src="{{CURR_THEME}}img/trash.png" />
                    </div>
                    {{/if}}

                </div>

                <div class="codo_posts_user_info">
                    <div class="codo_posts_post_avatar">
                        <a href="{{RURI}}user/profile/{{id}}">

                            {{#if avatar}}
                            <img draggable="false" src="{{avatar}}" />
                            {{else}}
                            <img draggable="false" src="{{DURI}}{{DEF_AVATAR}}" />
                            {{/if}}

                        </a>
                    </div>
                    <!--<div class="codo_posts_post_title">

                    </div>-->

                    <div class="codo_posts_post_name">
                        <a href="{{RURI}}user/profile/{{id}}">{{name}}</a>
                    </div>

                    <div class="codo_posts_post_desc">
                        {{#if in_search}}
                        {{posted}}&nbsp;<a href="{{RURI}}forum/topic/{{tid}}/{{safe_title}}/post-{{post_id}}#post-{{post_id}}">{{post_created}}</a>
                        {{else}}
                        <span>
                            {{posted}}&nbsp;<a href="{{RURI}}forum/topic/{{tid}}/{{safe_title}}/{{page}}#post-{{post_id}}">{{post_created}}</a>
                        </span>
                        {{/if}}
                    </div>

                    <div class="codo_posts_user_spec">
                        <!--<div><<?php ?>?php //echo $post.num_posts}&nbsp;<<?php ?>?php //echo _("posts")}</div>-->
                        <!--<hr/>-->
                        <!--<div><<?php ?>?php //echo $post.role}</div>-->
                    </div>
                </div>
                <div class="codo_posts_post_content">
                    <div class="codo_posts_post_message">{{{message}}}</div>
                    <div class="codo_posts_post_imessage">{{imessage}}</div>

                    {{#if signature}}
                    <div class="codo_posts_signature">{{signature}}</div>
                    {{/if}}

                </div>

                <div class="codo_posts_post_foot clearfix">

                    <div class="codo_posts_post_action">
                        <div class="btn-group">
                            <div class="codo_btn_def codo_quote_btn"><img src="{{CURR_THEME}}img/quote-left.png" /></div>
                            <div class="codo_btn_primary codo_btn codo_reply_btn">{{reply}}</div>
                        </div>
                    </div>
                </div>

            </article>
            <div class="codo_topic_separator"></div>

        </script>

        <script id="codo_pagination" type="text/html">

            <div class="{{constants.cls}}">


                {{#each page}}

                {{#if last}}
                ...
                {{/if}}


                {{#if active}}
                <a class="codo_topics_curr_page">{{page}}</a>
                {{else}}
                <a href="{{../../constants.url}}{{page}}&search={{../../constants.search}}">{{page}}</a>
                {{/if}}

                {{#if first}}
                ...
                {{/if}}


                {{/each}}

            </div>


        </script>
    


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

    <script>

                                                                                CODOF.pass = {

                                                                                tid: <?php echo $_smarty_tpl->tpl_vars['tid']->value;?>
,
                                                                                        perms: {

                                                                                        can_edit_topic: <?php echo $_smarty_tpl->tpl_vars['can_edit_topic']->value;?>
,
                                                                                                can_delete_topic: <?php echo $_smarty_tpl->tpl_vars['can_delete_topic']->value;?>

                                                                                        },
                                                                                        post_id: <?php echo $_smarty_tpl->tpl_vars['topic_info']->value['post_id'];?>
,
                                                                                        cat_alias: '<?php echo $_smarty_tpl->tpl_vars['topic_info']->value['cat_alias'];?>
',
                                                                                        title: '<?php echo $_smarty_tpl->tpl_vars['safe_title']->value;?>
',
                                                                                        curr_page: <?php echo $_smarty_tpl->tpl_vars['curr_page']->value;?>
,
                                                                                        num_pages: <?php echo $_smarty_tpl->tpl_vars['num_pages']->value;?>
,
                                                                                        url: '<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
',
                                                                                        new_page: '<?php echo $_smarty_tpl->tpl_vars['new_page']->value;?>
',
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

                                                                                        },
                                                                                        deleted_msg: '<?php echo _("The post has been ");?>
',
                                                                                        deleted: '<?php echo _("deleted");?>
',
                                                                                        undo_msg: '<?php echo _("undo");?>
',
                                                                                        search_data: '<?php echo $_smarty_tpl->tpl_vars['search_data']->value;?>
'
                                                                                }

    </script>


    

    <link rel="stylesheet" type="text/css" href="<?php echo @constant('DURI');?>
assets/markitup/highlight/styles/github.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo @constant('DURI');?>
assets/dropzone/css/basic.css" />




    <div class="codo_footer">

        <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>


        <div style="display: none" id="codo_js_php_defs"></div>
    </div>
</body>

</html>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2014-05-31 06:11:24
         compiled from "/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/forum/editor.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5389647cd715c3_29204023')) {function content_5389647cd715c3_29204023($_smarty_tpl) {?>




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