<?php /* Smarty version Smarty-3.1.16, created on 2014-02-13 16:58:04
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/topics.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53153115152b1cb9f9ae6f0-86103715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55e3e6943c99fb64ce3034c51b5ccce3e212b826' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/forum/topics.tpl',
      1 => 1392225142,
      2 => 'file',
    ),
    'e19a14c9e0a1d8063627a23a68a2a861b04ad7e9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/layout.tpl',
      1 => 1392306995,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53153115152b1cb9f9ae6f0-86103715',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52b1cb9fa1e820_01734934',
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
<?php if ($_valid && !is_callable('content_52b1cb9fa1e820_01734934')) {function content_52b1cb9fa1e820_01734934($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_abbrev_no')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.abbrev_no.php';
if (!is_callable('smarty_function_get_no_children')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/function.get_no_children.php';
if (!is_callable('smarty_function_get_children')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/function.get_children.php';
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
                            <div id="codo_category_all_num_topics" class="codo_category_content"><span></span> <?php echo _("topics");?>
</div>
                        </div>
                    </a>

                    <?php $_smarty_tpl->tpl_vars['total_topics'] = new Smarty_variable(0, null, 0);?>

                    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>

                        <?php $_smarty_tpl->tpl_vars['total_topics'] = new Smarty_variable($_smarty_tpl->tpl_vars['total_topics']->value+$_smarty_tpl->tpl_vars['cat']->value->no_topics, null, 0);?>
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
                        </div><!-- /.navbar-collapse -->
                    </nav>

                </div>
                
                    <div class="codo_topics_body" id="codo_topics_body">

                        <div style="display: none" id="codo_template" type="text/html">

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
                                    <div class="codo_topics_topic_title"><a href="{{../RURI}}forum/topic/{{topic_id}}/{{safe_title}}">{{title}}</a></div>

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
                            </div>

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

                                                    topics: '<?php echo $_smarty_tpl->tpl_vars['topics']->value;?>
',
                                                            total_topics: <?php echo $_smarty_tpl->tpl_vars['total_topics']->value;?>
,
                                                            no_posts: '<?php echo _("No more topics to display!");?>
',
                                                            subcategory_dropdown: '<?php echo $_smarty_tpl->tpl_vars['subcategory_dropdown']->value;?>
'
                                                    }

        </script>        
        <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/js/topics/topics.js">
        </script>

    

    <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

</body>

</html>
<?php }} ?>
