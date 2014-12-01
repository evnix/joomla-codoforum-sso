<?php /* Smarty version Smarty-3.1.16, created on 2014-06-02 11:51:49
         compiled from "/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/forum/topics.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130901147052fd930f9037a0-11060275%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ea300228d24797a204dfd48fa06a607d39ba242' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/forum/topics.tpl',
      1 => 1401706251,
      2 => 'file',
    ),
    'd4abc0502b2b173e5dfcd5d7949b028f1e336780' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/default/themes/default/templates/layout.tpl',
      1 => 1401014858,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130901147052fd930f9037a0-11060275',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52fd930fbbbf42_35475269',
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
<?php if ($_valid && !is_callable('content_52fd930fbbbf42_35475269')) {function content_52fd930fbbbf42_35475269($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_abbrev_no')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.abbrev_no.php';
if (!is_callable('smarty_function_get_no_children')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/function.get_no_children.php';
if (!is_callable('smarty_function_get_children')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/function.get_children.php';
if (!is_callable('smarty_function_print_children')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/function.print_children.php';
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

    
    <div class="codo_container">

        <div class="row">

            <!-- TODO: Assign height to codo_category_img dynamically based on li.height() -->

            <div class="codo_categories col-md-4">
                <ul id="codo_categories_ul">
                    <a href="#"><div class="active clearfix codo_categories_category">
                            <div class="codo_category_img">
                                <img draggable="false" src="<?php echo @constant('CURR_THEME');?>
img/th-list.png" />
                            </div>
                            <div class="codo_category_title"><?php echo _("All topics");?>
</div>
                            <div id="codo_category_all_num_topics" class="codo_category_content"><span><?php echo $_smarty_tpl->tpl_vars['total_num_topics']->value;?>
</span> <?php echo _("topics");?>
</div>
                        </div>
                    </a>

                    <?php $_smarty_tpl->tpl_vars['total_topics'] = new Smarty_variable(0, null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>

                        <div>

                            <div class="clearfix codo_category_children_shower codo_categories_category codo_categories_category_container">
                                <div class="codo_category_img">
                                    <img draggable="false" src="<?php echo @constant('DURI');?>
<?php echo @constant('CAT_IMGS');?>
<?php echo $_smarty_tpl->tpl_vars['cat']->value->cat_img;?>
" />
                                </div>
                                <a href="<?php echo @constant('RURI');?>
forum/topics/<?php echo $_smarty_tpl->tpl_vars['cat']->value->cat_alias;?>
">
                                    <div class="codo_category_title"><?php echo $_smarty_tpl->tpl_vars['cat']->value->cat_name;?>
</div>
                                </a>
                                <div class="codo_category_content"><span><?php echo smarty_modifier_abbrev_no($_smarty_tpl->tpl_vars['cat']->value->no_topics);?>
</span> <?php echo _("topics");?>


                                    <?php ob_start();?><?php echo smarty_function_get_no_children(array('cat'=>$_smarty_tpl->tpl_vars['cat']->value),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["no_children"] = new Smarty_variable($_tmp1, null, 0);?>

                                    <?php if ($_smarty_tpl->tpl_vars['no_children']->value) {?>
                                        &middot;
                                        <?php echo $_smarty_tpl->tpl_vars['no_children']->value;?>

                                    <?php }?>

                                    <?php if (!$_smarty_tpl->tpl_vars['no_children']->value) {?> <span class="codo_no_children_present"></span> <?php }?>

                                </div>
                            </div>

                            <div class="codo_category_children_container">        
                                <?php echo smarty_function_get_children(array('cat'=>$_smarty_tpl->tpl_vars['cat']->value),$_smarty_tpl);?>

                            </div>
                        </div>
                    <?php } ?>





                </ul>

            </div>

            <div class="codo_topics col-md-8 clearfix">

                <div class="codo_topics_head">

                    <nav class="navbar navbar-default" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#codo_topics_navhead">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="codo_topics_navhead">

                            <ul class="nav navbar-nav">
                                <li class="codo_topics_new_topic"><div onclick="codo_create_topic()"><?php echo _('New topic');?>
</div></li>
                                <li class="active"><a href="#"><?php echo _('Topics');?>
</a></li>
                                    
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class='advanced_search' id="codo_advanced_search_li">
                                    <form method="GET" id="codo_search_form">

                                        <div class="codo_basic_search">
                                            <input id="codo_search_keywords" class="codo_topics_search" placeholder="<?php echo _('Search');?>
" name="search" type="text" />
                                            <a class="codo_search_flip" id="codo_search_open_advanced" title="<?php echo _('Advanced search');?>
" >
                                                <span class='advanced_search_dropdown'></span>
                                            </a>
                                        </div>

                                    </form>

                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>
                    <div class="codo_search_advanced_options" id="codo_search_advanced_options">

                        <div class="row">
                            <div class="col-md-4">
                                <label for="display_name" class="control-label"><?php echo _("Category");?>
</label>
                            </div>

                            <div class="col-md-8">

                                <select class="codo_input" name="cat_ids[]" id="codo_search_cats" multiple="multiple" title="<?php echo _("Search in forum");?>
" size="<?php echo $_smarty_tpl->tpl_vars['option_size']->value;?>
">
                                    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value->cat_id;?>
"><?php echo $_smarty_tpl->tpl_vars['cat']->value->cat_name;?>
</option>     
                                        <?php echo smarty_function_print_children(array('cat'=>$_smarty_tpl->tpl_vars['cat']->value,'el'=>"option"),$_smarty_tpl);?>

                                    <?php } ?>
                                </select>
                            </div>                                    
                        </div>


                        <div class="row">

                            <label class="control-label col-md-4"><?php echo _("Search sub-categories");?>
</label>
                            <div class="col-md-8">
                                <div id="codo_search_sub_cats_switch" class="codo_switch codo_switch_on" style="margin-top: 6px">
                                    <div class="codo_switch_toggle"></div>
                                    <span class="codo_switch_on"><?php echo _('Yes');?>
</span>
                                    <span class="codo_switch_off"><?php echo _('No');?>
</span>
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <div class="row">

                            <label class="control-label col-md-4"><?php echo _("Search in Topic titles");?>
</label>
                            <div class="col-md-8">
                                <div id="codo_search_titles_switch" class="codo_switch codo_switch_on" style="margin-top: 6px">
                                    <div class="codo_switch_toggle"></div>
                                    <span class="codo_switch_on"><?php echo _('Yes');?>
</span>
                                    <span class="codo_switch_off"><?php echo _('No');?>
</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <label class="control-label col-md-4"><?php echo _("Sort results by");?>
</label>

                            <div class="col-md-8">

                                <select name="search_sort" id="codo_search_sort" class="codo_input">
                                    <option value="name"><?php echo _("Author");?>
</option>
                                    <option value="post_created" selected="selected"><?php echo _("Post created");?>
</option>
                                    <option value="no_posts"><?php echo _("No. of replies");?>
</option>
                                    <option value="no_views"><?php echo _("No. of views");?>
</option>
                                    <option value="last_post_time"><?php echo _("Last post time");?>
</option>
                                    <option value="message"><?php echo _("Post body");?>
</option>
                                    <option value="title"><?php echo _("Post title");?>
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

                </div>
                
                    <div class="codo_topics_body" id="codo_topics_body">

                        <script style="display: none" id="codo_template" type="text/html">

                            {{#unless topics}}
                        
                        <article id="codo_no_topics_display" style="display: none">
                            <div class="codo_no_topics">
                                <p><?php echo _("No topics created yet!");?>

                                    <?php echo _("Be the first to ");?>
<a onclick="codo_create_topic()"><?php echo _("create one");?>
</a></p>
                            </div>


                        </article>
                        
                            {{/unless}}

                            {{#each topics}}
                            <article class="clearfix">

                                <div class="codo_topics_topic_img">
                                    <a href="{{../RURI}}forum/topics/{{cat_alias}}">
                                        <img draggable="false" src="{{../DURI}}{{../CAT_IMGS}}{{cat_img}}" />
                                    </a>
                                </div>

                                <div class="codo_posts_post_moderation">


                                    {{#if can_edit_topic}}
                                    <div id="codo_posts_edit_{{topic_id}}" class="codo_posts_edit_post codo_post_this_is_topic">
                                        <img src="{{../../CURR_THEME}}img/edit2.png" />
                                    </div>
                                    {{/if}}

                                    {{#if can_delete_topic}}
                                    <div rel='popover' id="codo_posts_trash_{{topic_id}}" class="codo_posts_trash_post codo_post_this_is_topic">
                                        <div class="codo_spinner"></div>
                                        <img src="{{../../CURR_THEME}}img/trash.png" />
                                    </div>
                                    {{/if}}
                                </div>

                                <div class="codo_topics_topic_content">
                                    <div class="codo_topics_topic_avatar">
                                        <a href="{{../RURI}}user/profile/{{id}}">

                                            {{#if avatar}}
                                            <img draggable="false" src="{{avatar}}" />
                                            {{else}}
                                            <img draggable="false" src="{{../../DURI}}{{../../DEF_AVATAR}}" />
                                            {{/if}}

                                        </a>
                                    </div>
                                    <div class="codo_topics_topic_name">
                                        <a href="{{../RURI}}user/profile/{{id}}">{{name}}</a>
                                        <span>{{../posted}} {{post_created}}</span>
                                    </div>
                                    {{#if in_search}}
                                    <div class="codo_topics_topic_title"><a href="{{../../RURI}}forum/topic/{{topic_id}}/{{safe_title}}/post-{{post_id}}#post-{{post_id}}">{{{title}}}</a></div>                                    
                                    {{else}}
                                    <div class="codo_topics_topic_title"><a href="{{../../RURI}}forum/topic/{{topic_id}}/{{safe_title}}">{{title}}</a></div>
                                    {{/if}}    
                                </div>
                                <div class="codo_topics_topic_message">{{{message}}}</div>

                                <div class="codo_topics_topic_foot clearfix">

                                    <div class="codo_topics_no_replies"><span>{{no_replies}}</span>{{../reply_txt}}</div>
                                    <div class="codo_topics_no_replies"><span>{{no_views}}</span>{{../views_txt}}</div>

                                    {{#if last_post_time}}
                                    <div class="codo_topics_last_post">
                                        {{../recent_txt}} <a href="{{../RURI}}user/profile/{{last_post_uid}}">{{last_post_name}}</a>
                                        &nbsp;&middot;&nbsp; {{last_post_time}}
                                    </div>
                                    {{/if}}
                                </div>

                            </article>
                            {{/each}}
                            </script>

                        </div>
                    
                </div>
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
        </div>

        <script type="text/javascript">

                                                    CODOF.pass = {

                                                    topics: <?php echo $_smarty_tpl->tpl_vars['topics']->value;?>
,
                                                            no_more_posts: '<?php echo _("No more topics to display!");?>
',
                                                            no_posts: '<?php echo _("No topics found matching your criteria!");?>
',
                                                            subcategory_dropdown: '<?php echo $_smarty_tpl->tpl_vars['subcategory_dropdown']->value;?>
',
                                                            num_posts_per_page: '<?php echo $_smarty_tpl->tpl_vars['num_posts_per_page']->value;?>
'
                                                    }

        </script>

        
        <link rel="stylesheet" type="text/css" href="<?php echo @constant('DURI');?>
assets/markitup/highlight/styles/github.css" />

    

    <div class="codo_footer">

        <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>


        <div style="display: none" id="codo_js_php_defs"></div>
    </div>
</body>

</html>
<?php }} ?>
