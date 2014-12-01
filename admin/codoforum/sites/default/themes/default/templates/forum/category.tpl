{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}

    <div class="marker left"></div>
    <div class="marker right"></div>

    <div class="codo_container" id="codo_category_topics">

        <div class="row">

            <div class="codo_upper_container codo_topics clearfix" id="codo_upper_container">

                <ol class="codo_breadcrumb">
                    <li><a href="{$smarty.const.RURI}{$site_url}">{$home_title}</a></li>
                    <li>{$cat_info.cat_name}</li>
                    <li class="advanced_search" id="codo_advanced_search_li">
                        <form method="GET" id="codo_search_form">

                            <div class="codo_basic_search">
                                <input id="codo_search_keywords" class="codo_topics_search" placeholder="{_('Search in ')}{$cat_info.cat_name}" name="search" type="text" />
                                <a class="codo_search_flip" id="codo_search_open_advanced" title="{_('Advanced search')}" >
                                    <span class='advanced_search_dropdown'></span>
                                </a>
                            </div>

                        </form>
                    </li>
                </ol>
                <div class="codo_search_advanced_options" id="codo_search_advanced_options">

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

                <div id="codo_topics_create" class="codo_topics_create">
                    <div class="codo_widget">
                        <div class="codo_widget-header codo_topics_on_focus_show" id="codo_create_new_topic">
                            {_("Create Topic")}
                        </div>

                        <div class="codo_widget-content">
                            <form id="codo_new_topic_form" method="POST" class="" role="form">

                                <div class="form-group codo_topics_on_focus_show">
                                    <div>
                                        <input id="codo_topic_title" type="text" class="codo_input" placeholder="{_("Give a title for your topic")}" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div id="codo_topic_desc_div" class="form-control">{_("Create new topic")}</div>
                                    {*<textarea placeholder="{_("Topic description")}" id="codo_topic_desc" class="form-control" rows="3"></textarea>*}


                                    <div id="codo_new_reply" class="codo_new_reply">

                                        <!--<div class="codo_reply_resize_handle"></div>-->

                                        <div class="codo_reply_box" id="codo_reply_box">
                                            <textarea placeholder="{_('Describe your topic . You can use BBcode or Markdown')}" id="codo_new_reply_textarea" name="input_text"></textarea>
                                            <div class="codo_new_reply_preview" id="codo_new_reply_preview_container">
                                                <div class="codo_editor_preview_placeholder">{_("live preview")}</div>
                                                <div id="codo_new_reply_preview"></div>
                                            </div>
                                        </div>

                                        <div class="codo_new_reply_action">
                                            <button class="codo_btn" id="codo_new_topic_btn">{_("Post")}</button>
                                            <button class="codo_btn codo_btn_def" id="codo_cancel_topic_btn">{_("Cancel")}</button>

                                            <img id="codo_new_reply_loading" src="{$smarty.const.CURR_THEME}img/ajax-loader.gif" />
                                            <button class="codo_btn codo_btn_def codo_post_preview_bg" id="codo_post_preview_btn">&nbsp;</button>
                                        </div>
                                        <input type="text" class="end-of-line" name="end_of_line" />

                                        <div class="codo_reply_min_chars">{_("enter atleast ")}<span id="codo_reply_min_chars_left">{$reply_min_chars}</span>{_(" characters")}</div>
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


                {* Invisible div to check any div's height before visibly appending it *}
                <div id="codo_empty_space" style="display: none"></div>

                <div class="codo_categories" id="codo_categories">

                    <div class="codo_cat_title">{$cat_info.cat_name}</div>

                    <div class="codo_cat_imgs">
                        <div class="codo_cat_img">
                            <img id="codo_cat_img" draggable="false" src="{$smarty.const.DURI}{$smarty.const.CAT_IMGS}{$cat_info.cat_img}" />
                        </div>
                    </div>
                    <div class="codo_cat_desc">{$cat_info.cat_description}</div>
                    <div class="codo_cat_info clearfix">

                        <div class="codo_cat_num">
                            <div>{$cat_info.no_topics|abbrev_no}</div>
                            {_("Topics")}
                        </div>

                        <div class="codo_cat_num">
                            <div>{$cat_info.no_posts|abbrev_no}</div>
                            {_("Posts")}
                        </div>
                    </div>

                    <div class="codo_sub_categories">

                        {if !empty($sub_cats)}
                            <div class="codo_sub_categories_txt">{_("sub-categories")}</div>
                        {/if}
                        {foreach from=$sub_cats item=cat}

                            <div class="clearfix">
                                <a class="codo_categories_category" href="{$smarty.const.RURI}forum/topics/{$cat.cat_alias}">
                                    <div class="codo_category_img">
                                        <img draggable="false" src="{$smarty.const.DURI}{$smarty.const.CAT_IMGS}{$cat.cat_img}" />
                                    </div>
                                    <div class="codo_category_title">{$cat.cat_name}</div>
                                    <div class="codo_category_content"><span>{$cat.no_topics} </span>{_("topics")}

                                        {if $cat.no_sub_cats > 0}
                                            &middot; <span>{$cat.no_sub_cats} </span>{ngettext("sub-category", "sub-categories", {$cat.no_sub_cats})}
                                        {/if}
                                    </div>
                                </a>
                            </div>

                        {/foreach}

                    </div>
                </div>
                <div style="display:none" id="codo_no_topics_display" class="codo_no_topics">{_("No posts to display")}</div>

            </div>


            <div class="codo_lower_containers" id="codo_lower_containers">
                <div class="codo_topics" id="codo_topics_container_1">

                    {foreach from=$topics item=topic name=category}

                        {assign var="avatar" value=$topic.avatar}

                        {if $avatar == null}

                            {assign var="avatar" value="{$smarty.const.DURI}{$smarty.const.DEF_AVATAR}"}
                        {/if}

                        <article id="codo_topics_article_{$smarty.foreach.category.iteration}">
                            <div class="codo_topics_topic_content">

                                <div class="codo_posts_post_moderation">

                                    {if $topic.can_edit_topic}
                                        <div id="codo_posts_edit_{$topic.topic_id}" class="codo_posts_edit_post codo_post_this_is_topic">
                                            <img src="{$smarty.const.CURR_THEME}img/edit2.png" />
                                        </div>
                                    {/if}

                                    {if $topic.can_delete_topic}
                                        <div rel='popover' id="codo_posts_trash_{$topic.topic_id}" class="codo_posts_trash_post codo_post_this_is_topic">
                                            <div class="codo_spinner"></div>
                                            <img src="{$smarty.const.CURR_THEME}img/trash.png" />
                                        </div>
                                    {/if}

                                </div>

                                <div class="codo_topics_topic_avatar">
                                    <a href="{$smarty.const.RURI}user/profile/{$topic.id}">
                                        <img draggable="false" src="{$avatar}" />
                                    </a>
                                </div>
                                <div class="codo_topics_topic_name">
                                    <a href="{$smarty.const.RURI}user/profile/{$topic.id}">{$topic.name}</a>
                                    <span>{_("posted ")}{$topic.post_created}</span>
                                </div>
                                <div class="codo_topics_topic_title">
                                    <a href="{$smarty.const.RURI}forum/topic/{$topic.topic_id}/{$topic.safe_title}">{$topic.title}</a>
                                </div>

                            </div>

                            <div id="codo_topics_topic_message_{$smarty.foreach.category.iteration}" class="codo_topics_topic_message">{$topic.message}</div>
                            <div id="codo_topics_topic_more_{$smarty.foreach.category.iteration}" class="codo_topics_topic_readmore">
                                <a href="{$smarty.const.RURI}forum/topic/{$topic.topic_id}/{$topic.safe_title}">
                                    {_('read more')}
                                </a>
                            </div>

                            <div class="codo_topics_topic_foot clearfix">

                                <div class="codo_topics_no_replies"><span>{$topic.no_replies}</span>{_("replies")}</div>
                                <div class="codo_topics_no_replies"><span>{$topic.no_views}</span>{_("views")}</div>

                                {if $topic.last_post_time != null}
                                    <div class="codo_topics_last_post">
                                        {_('recent by')} <a href="{$smarty.const.RURI}user/profile/{$topic.last_post_uid}">{$topic.last_post_name}</a>
                                        &nbsp;&middot;&nbsp; {$topic.last_post_time}
                                    </div>

                                {/if}
                            </div>

                        </article>

                    {/foreach}

                </div>


                <div class="codo_topics_pagination">

                    {$pagination}
                </div>


            </div>



            {literal}

                <script id="codo_pagination" type="text/html">

                    <div class="codo_topics_pagination">


                        {{#each page}}

                        {{#if last}}
                        ...
                        {{/if}}


                        {{#if active}}
                        <a class="codo_topics_curr_page">{{page}}</a>
                        {{else}}
                        <a href="{{../../constants.RURI}}forum/topics/{{../../constants.cat_alias}}/{{page}}&search={{../../constants.search}}">{{page}}</a>
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
                                {{#if in_search}}

                                <div class="codo_topics_topic_title"><a href="{{RURI}}forum/topic/{{topic_id}}/{{safe_title}}/post-{{post_id}}#post-{{post_id}}">{{{title}}}</a></div>
                                {{else}}
                                <div class="codo_topics_topic_title"><a href="{{RURI}}forum/topic/{{topic_id}}/{{safe_title}}">{{title}}</a></div>                                
                                {{/if}}
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

                                {{#if last_post_time}}
                                <div class="codo_topics_last_post">
                                    {{recent_by}} <a href="{{RURI}}user/profile/{{last_post_uid}}">{{last_post_name}}</a>
                                    &nbsp;&middot;&nbsp; {{last_post_time}}
                                </div>
                                {{/if}}

                            </div>

                        </article>

                        </script>
                    {/literal}
                </div>
                {include file='forum/editor.tpl'}
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

            <script type="text/javascript">

                                                                                                CODOF.pass = {
                                                                                                catid: '{$cat_info.cat_id}',
                                                                                                        cat_alias: '{$cat_alias}',
                                                                                                        num_pages: parseInt('{$num_pages}'),
                                                                                                        curr_page: parseInt('{$curr_page}'),
                                                                                                        constants: JSON.parse('{$constants}'),
                                                                                                        smileys: JSON.parse('{$forum_smileys}'),
                                                                                                        reply_min_chars: parseInt({$reply_min_chars}),
                                                                                                        dropzone: {
                                                                                                        dictDefaultMessage: '{_("Drop files to upload &nbsp;&nbsp;(or click)")}',
                                                                                                                max_file_size: parseInt('{$max_file_size}'),
                                                                                                                allowed_file_mimetypes: '{$allowed_file_mimetypes}',
                                                                                                                forum_attachments_multiple: {$forum_attachments_multiple},
                                                                                                                forum_attachments_parallel: parseInt('{$forum_attachments_parallel}'),
                                                                                                                forum_attachments_max: parseInt('{$forum_attachments_max}')

                                                                                                        },
                                                                                                        logged_in: '{$is_logged_in}',
                                                                                                        login_url: '{$login_url}',
                                                                                                        search_data: '{$search_data}'

                                                                                                }

            </script>

            {*<script src="{$smarty.const.DURI}assets/js/category/category.js"></script>
            
            <script type="text/javascript" src="{$smarty.const.DURI}assets/markitup/jquery.markitup.js"></script>
            <script type="text/javascript" src="{$smarty.const.DURI}assets/markitup/parsers/marked.js"></script>
            <script type="text/javascript" src="{$smarty.const.DURI}assets/markitup/highlight/highlight.pack.js"></script>
            <script type="text/javascript" src="{$smarty.const.DURI}assets/dropzone/dropzone.js"></script>
            <script type="text/javascript" src="{$smarty.const.DURI}assets/js/editor.js"></script>
            <script type="text/javascript" src="{$smarty.const.DURI}assets/js/fittext.js"></script>
            <script type="text/javascript" src="{$smarty.const.DURI}assets/js/griphandler.js"></script>
            *}
            <link rel="stylesheet" type="text/css" href="{$smarty.const.DURI}assets/markitup/highlight/styles/github.css" />
            <link rel="stylesheet" type="text/css" href="{$smarty.const.DURI}assets/dropzone/css/basic.css" />

            {*            <script src="{$smarty.const.DURI}assets/js/category/jquery.easing.1.3.js"></script>*}

        {/block}
