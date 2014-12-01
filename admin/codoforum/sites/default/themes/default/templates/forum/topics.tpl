{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}
    <div class="codo_container">

        <div class="row">

            <!-- TODO: Assign height to codo_category_img dynamically based on li.height() -->

            <div class="codo_categories col-md-4">
                <ul id="codo_categories_ul">
                    <a href="#"><div class="active clearfix codo_categories_category">
                            <div class="codo_category_img">
                                <img draggable="false" src="{$smarty.const.CURR_THEME}img/th-list.png" />
                            </div>
                            <div class="codo_category_title">{_("All topics")}</div>
                            <div id="codo_category_all_num_topics" class="codo_category_content"><span>{$total_num_topics}</span> {_("topics")}</div>
                        </div>
                    </a>

                    {assign var=total_topics value=0}
                    {foreach from=$cats item=cat}

                        <div>

                            <div class="clearfix codo_category_children_shower codo_categories_category codo_categories_category_container">
                                <div class="codo_category_img">
                                    <img draggable="false" src="{$smarty.const.DURI}{$smarty.const.CAT_IMGS}{$cat->cat_img}" />
                                </div>
                                <a href="{$smarty.const.RURI}forum/topics/{$cat->cat_alias}">
                                    <div class="codo_category_title">{$cat->cat_name}</div>
                                </a>
                                <div class="codo_category_content"><span>{$cat->no_topics|abbrev_no}</span> {_("topics")}

                                    {assign "no_children"  {get_no_children cat=$cat}}

                                    {if $no_children}
                                        &middot;
                                        {$no_children}
                                    {/if}

                                    {if !$no_children} <span class="codo_no_children_present"></span> {/if}

                                </div>
                            </div>

                            <div class="codo_category_children_container">        
                                {get_children cat=$cat}
                            </div>
                        </div>
                    {/foreach}





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
                                <li class="codo_topics_new_topic"><div onclick="codo_create_topic()">{_('New topic')}</div></li>
                                <li class="active"><a href="#">{_('Topics')}</a></li>
                                    {*<li><a href="#">{('Popular')}</a></li>*}
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class='advanced_search' id="codo_advanced_search_li">
                                    <form method="GET" id="codo_search_form">

                                        <div class="codo_basic_search">
                                            <input id="codo_search_keywords" class="codo_topics_search" placeholder="{_('Search')}" name="search" type="text" />
                                            <a class="codo_search_flip" id="codo_search_open_advanced" title="{_('Advanced search')}" >
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
                                <label for="display_name" class="control-label">{_("Category")}</label>
                            </div>

                            <div class="col-md-8">

                                <select class="codo_input" name="cat_ids[]" id="codo_search_cats" multiple="multiple" title="{_("Search in forum")}" size="{$option_size}">
                                    {foreach from=$cats item=cat}
                                        <option value="{$cat->cat_id}">{$cat->cat_name}</option>     
                                        {print_children cat=$cat el="option"}
                                    {/foreach}
                                </select>
                            </div>                                    
                        </div>


                        <div class="row">

                            <label class="control-label col-md-4">{_("Search sub-categories")}</label>
                            <div class="col-md-8">
                                <div id="codo_search_sub_cats_switch" class="codo_switch codo_switch_on" style="margin-top: 6px">
                                    <div class="codo_switch_toggle"></div>
                                    <span class="codo_switch_on">{_('Yes')}</span>
                                    <span class="codo_switch_off">{_('No')}</span>
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <div class="row">

                            <label class="control-label col-md-4">{_("Search in Topic titles")}</label>
                            <div class="col-md-8">
                                <div id="codo_search_titles_switch" class="codo_switch codo_switch_on" style="margin-top: 6px">
                                    <div class="codo_switch_toggle"></div>
                                    <span class="codo_switch_on">{_('Yes')}</span>
                                    <span class="codo_switch_off">{_('No')}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <label class="control-label col-md-4">{_("Sort results by")}</label>

                            <div class="col-md-8">

                                <select name="search_sort" id="codo_search_sort" class="codo_input">
                                    <option value="name">{_("Author")}</option>
                                    <option value="post_created" selected="selected">{_("Post created")}</option>
                                    <option value="no_posts">{_("No. of replies")}</option>
                                    <option value="no_views">{_("No. of views")}</option>
                                    <option value="last_post_time">{_("Last post time")}</option>
                                    <option value="message">{_("Post body")}</option>
                                    <option value="title">{_("Post title")}</option>                                    
                                </select>
                                <div id="codo_search_order_switch" class="codo_switch codo_switch_off" style="position:absolute;left:54%;top:5px;">
                                    <div class="codo_switch_toggle"></div>
                                    <span class="codo_switch_on">{_('Asc')}</span>
                                    <span class="codo_switch_off" style="color:#1471af">{_('Desc')}</span>
                                    
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <label class="control-label col-md-4">{_("Search within")}</label>

                            <div class="col-md-8">

                                <select name="search_time" id="codo_search_time" class="codo_input">
                                    <option value="anytime" selected>{_("Any time")}</option>
                                    <option value="hour">{_("Past hour")}</option>
                                    <option value="day">{_("Past 24 hours")}</option>
                                    <option value="week">{_("Past week")}</option>
                                    <option value="month">{_("Past month")}</option>
                                    <option value="year">{_("Past year")}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">        
                        <div class="col-sm-offset-4 col-sm-8">
                            <button id="codo_search_btn" class="codo_btn codo_btn_primary">{_("Search")}</button>
                        </div>
                        </div>
                    </div>

                </div>
                {literal}
                    <div class="codo_topics_body" id="codo_topics_body">

                        <script style="display: none" id="codo_template" type="text/html">

                            {{#unless topics}}
                        {/literal}
                        <article id="codo_no_topics_display" style="display: none">
                            <div class="codo_no_topics">
                                <p>{_("No topics created yet!")}
                                    {_("Be the first to ")}<a onclick="codo_create_topic()">{_("create one")}</a></p>
                            </div>


                        </article>
                        {literal}
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
                    {/literal}
                </div>
                <div id='codo_delete_topic_confirm_html'>
                    <div class='codo_posts_topic_delete'>
                        <div class='codo_content'>
                            {_("All posts under this topic will be ")}<b>{_("deleted")}</b> ?
                        </div>
                        <div class="codo_modal_footer">
                            <div class="codo_btn codo_btn_def codo_modal_delete_topic_cancel">{_("Cancel")}</div>
                            <div class="codo_btn codo_btn_primary codo_modal_delete_topic_submit">{_("Delete")}</div>
                        </div>
                        <div class="codo_spinner"></div>
                    </div>
                </div>

            </div>
        </div>

        <script type="text/javascript">

                                                    CODOF.pass = {

                                                    topics: {$topics},
                                                            no_more_posts: '{_("No more topics to display!")}',
                                                            no_posts: '{_("No topics found matching your criteria!")}',
                                                            subcategory_dropdown: '{$subcategory_dropdown}',
                                                            num_posts_per_page: '{$num_posts_per_page}'
                                                    }

        </script>

        {*<script type="text/javascript" src="{$smarty.const.DURI}assets/js/topics/topics.js"></script>*}
        <link rel="stylesheet" type="text/css" href="{$smarty.const.DURI}assets/markitup/highlight/styles/github.css" />

    {/block}
