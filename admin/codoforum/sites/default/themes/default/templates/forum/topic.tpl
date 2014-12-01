{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}

    {assign "title" $topic_info.title}
    {assign "safe_title" $title|URL_safe}
    {assign "tid" $topic_info.topic_id}

    <div class="codo_container">

        <div class="row">

            <ol class="codo_breadcrumb" style="margin-left: 14px;margin-right: 14px;">
                <li><a href="{$smarty.const.RURI}{$site_url}">{$home_title}</a></li>
                <li><a href="{$smarty.const.RURI}forum/topics/{$topic_info.cat_alias}">{$topic_info.cat_name}</a></li>
                <li>{$topic_info.title}</li>
                <li id="codo_advanced_search_li" class="advanced_search">
                    <form method="GET" id="codo_search_form">

                        <div class="codo_basic_search">
                            <input id="codo_search_keywords" class="codo_topics_search" placeholder="{_('Search in ')}{$topic_info.title}" name="search" type="text" />
                            <a class="codo_search_flip" id="codo_search_open_advanced" title="{_('Advanced search')}" >
                                <span class='advanced_search_dropdown'></span>
                            </a>
                        </div>

                    </form>
                </li>                
            </ol>

            <div class="codo_search_advanced_options" id="codo_search_advanced_options">


                <div class="row">

                    <label class="control-label col-md-4">{_("Sort results by")}</label>

                    <div class="col-md-8">

                        <select name="search_sort" id="codo_search_sort" class="codo_input">
                            <option value="name">{_("Author")}</option>
                            <option value="post_created" selected="selected">{_("Post created")}</option>
                            <option value="last_post_time">{_("Last post time")}</option>
                            <option value="message">{_("Post body")}</option>
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

            <div class="codo_posts col-md-9">


                <div class="codo_widget">
                    <div class="codo_widget-header" id="codo_head_title">
                        <div class="row">
                            <div class="codo_topic_title">
                                <a href="{$smarty.const.RURI}forum/topic/{$tid}/{$safe_title}">
                                    <h1><div class="codo_widget_header_title">{$title}</div></h1>
                                </a>
                            </div>
                            <div id="codo_topic_title_pagination">
                            </div>
                        </div>
                    </div>


                    <div style="display: none" id="codo_no_topics_display" class="codo_no_topics">{_("No posts to display")}</div>

                    <div id="codo_posts_container" class="codo_widget-content">

                        {if !$posts}

                            {* This is actually an error! *}
                            No posts to display!
                        {/if}

                        {foreach from=$posts item=post}

                            {assign "avatar" $post.avatar}

                            {if !$avatar}

                                {assign var="avatar" value="{$smarty.const.DURI}{$smarty.const.DEF_AVATAR}"}
                            {/if}

                            <a name="post-{$post.post_id}"></a>
                            <article id="post-{$post.post_id}" class="clearfix">

                                <div class="codo_posts_post_moderation">
                                    {if $post.post_id eq $topic_info.post_id}
                                        {* this is topic *}
                                        {if $can_edit_topic == 'true'}
                                            <div class="codo_posts_edit_post codo_post_this_is_topic">
                                                <img src="{$smarty.const.CURR_THEME}img/edit2.png" />
                                            </div>
                                        {/if}

                                        {if $can_delete_topic == 'true'}
                                            <div rel='popover' id="codo_posts_trash_{$post.post_id}" class="codo_posts_trash_post codo_post_this_is_topic">
                                                <div class="codo_spinner"></div>
                                                <img src="{$smarty.const.CURR_THEME}img/trash.png" />
                                            </div>
                                        {/if}

                                    {else}
                                        {* this is a normal post *}
                                        {if $post.can_edit_post}
                                            <div class="codo_posts_edit_post codo_post_this_is_post" id="codo_posts_edit_{$post.post_id}">
                                                <img src="{$smarty.const.CURR_THEME}img/edit2.png" />
                                            </div>
                                        {/if}

                                        {if $post.can_delete_post}
                                            <div id="codo_posts_trash_{$post.post_id}" class="codo_posts_trash_post codo_post_this_is_post">
                                                <div class="codo_spinner"></div>
                                                <img src="{$smarty.const.CURR_THEME}img/trash.png" />
                                            </div>
                                        {/if}

                                    {/if}



                                </div>

                                <div class="codo_posts_user_info">
                                    <div class="codo_posts_post_avatar">
                                        <a href="{$smarty.const.RURI}user/profile/{$post.id}">
                                            <img draggable="false" src="{$avatar}" />
                                        </a>
                                    </div>


                                    <div class="codo_posts_post_name">
                                        <a href="{$smarty.const.RURI}user/profile/{$post.id}">{$post.name}</a>

                                    </div>
                                    <div class="codo_posts_post_desc">
                                        <span>
                                            {_("posted")}
                                            <a href="{$smarty.const.RURI}forum/topic/{$tid}/{$safe_title}/{$curr_page}#post-{$post.post_id}">
                                                {$post.post_created}
                                            </a>
                                        </span>
                                    </div>

                                    <div class="codo_posts_user_spec">
                                        <!--<div><?php //echo $post.num_posts}&nbsp;<?php //echo _("posts")}</div>-->
                                        <!--<hr/>-->
                                        <!--<div><?php //echo $post.role}</div>-->
                                    </div>
                                </div>
                                <div class="codo_posts_post_content">
                                    <div class="codo_posts_post_message">{$post.message}</div>
                                    <div class="codo_posts_post_imessage">{$post.imessage}</div>

                                    {if $post.signature}
                                        <div class="codo_posts_signature">{$post.signature}</div>
                                    {/if}

                                </div>

                                <div class="codo_posts_post_foot clearfix">

                                    <div class="codo_posts_post_action">
                                        <div class="btn-group">
                                            <div class="codo_btn_def codo_quote_btn"><img src="{$smarty.const.CURR_THEME}img/quote-left.png" /></div>
                                            <div class="codo_btn_primary codo_btn codo_reply_btn">{_("reply")}</div>
                                        </div>
                                    </div>
                                </div>

                            </article>
                            <div class="codo_topic_separator"></div>
                        {/foreach}

                        {if $num_pages > 1}
                            <div class="codo_topics_pagination">

                                {$pagination}
                            </div>
                        {/if}

                    </div>
                </div>
            </div>

            <div class="codo_topic col-md-3" id="codo_topic_sidebar">

                <div class="codo_topic_statistics">

                    <div class="codo_cat_num">
                        <div id="codo_topic_views" data-number="{$topic_info.no_views}">
                            {$topic_info.no_views|abbrev_no}
                        </div>
                        {_('views')}
                    </div>
                    <div class="codo_cat_num">
                        <div>
                            {$topic_info.no_replies|abbrev_no}
                        </div>
                        {_('replies')}
                    </div>

                </div>

            </div>
        </div>
        <div id="codo_new_reply" class="codo_new_reply">

            <div class="codo_reply_resize_handle"></div>
            <form id="codo_new_reply_post" action="/" method="POST">

                <div class="codo_reply_box" id="codo_reply_box">
                    <textarea placeholder="{_('Start typing here . You can use BBcode or Markdown')}" id="codo_new_reply_textarea" name="input_text"></textarea>
                    <div class="codo_new_reply_preview" id="codo_new_reply_preview_container">
                        <div class="codo_editor_preview_placeholder">{_("live preview")}</div>
                        <div id="codo_new_reply_preview"></div>
                    </div>
                </div>

                <div class="codo_new_reply_action">
                    <button class="codo_btn" id="codo_post_new_reply">{_("Post")}</button>
                    <button class="codo_btn codo_btn_def" id="codo_post_cancel">{_("Cancel")}</button>

                    <img id="codo_new_reply_loading" src="{$smarty.const.CURR_THEME}img/ajax-loader.gif" />
                    <button class="codo_btn codo_btn_def codo_post_preview_bg" id="codo_post_preview_btn">&nbsp;</button>
                    <button class="codo_btn codo_btn_def codo_post_preview_bg" id="codo_post_preview_btn_resp">&nbsp;</button>                    
                </div>
                <input type="text" class="end-of-line" name="end_of_line" id="end_of_line" />
            </form>

            <div class="codo_reply_min_chars">{_("enter atleast ")}<span id="codo_reply_min_chars_left">{$reply_min_chars}</span>{_(" characters")}</div>
        </div>

        {include file='forum/editor.tpl'}
    </div>
    {literal}

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
                        <!--<div><?php //echo $post.num_posts}&nbsp;<?php //echo _("posts")}</div>-->
                        <!--<hr/>-->
                        <!--<div><?php //echo $post.role}</div>-->
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
    {/literal}


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

    <script>

                                                                                CODOF.pass = {

                                                                                tid: {$tid},
                                                                                        perms: {

                                                                                        can_edit_topic: {$can_edit_topic},
                                                                                                can_delete_topic: {$can_delete_topic}
                                                                                        },
                                                                                        post_id: {$topic_info.post_id},
                                                                                        cat_alias: '{$topic_info.cat_alias}',
                                                                                        title: '{$safe_title}',
                                                                                        curr_page: {$curr_page},
                                                                                        num_pages: {$num_pages},
                                                                                        url: '{$url}',
                                                                                        new_page: '{$new_page}',
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
                                                                                        deleted_msg: '{_("The post has been ")}',
                                                                                        deleted: '{_("deleted")}',
                                                                                        undo_msg: '{_("undo")}',
                                                                                        search_data: '{$search_data}'
                                                                                }

    </script>


    {*<script type="text/javascript" src="{$smarty.const.DURI}assets/js/topic/topic.js"></script>
    
    <script type="text/javascript" src="{$smarty.const.DURI}assets/markitup/jquery.markitup.js"></script>
    <script type="text/javascript" src="{$smarty.const.DURI}assets/markitup/parsers/marked.js"></script>
    <script type="text/javascript" src="{$smarty.const.DURI}assets/markitup/highlight/highlight.pack.js"></script>
    <script type="text/javascript" src="{$smarty.const.DURI}assets/dropzone/dropzone.js"></script>
    <script type="text/javascript" src="{$smarty.const.DURI}assets/js/editor.js"></script>
    <script type="text/javascript" src="{$smarty.const.DURI}assets/js/fittext.js"></script>
    <script type="text/javascript" src="{$smarty.const.DURI}assets/js/griphandler.js"></script>
    
    <script type="text/javascript" src="{$smarty.const.DURI}assets/js/modal.js"></script>
    *}

    <link rel="stylesheet" type="text/css" href="{$smarty.const.DURI}assets/markitup/highlight/styles/github.css" />
    <link rel="stylesheet" type="text/css" href="{$smarty.const.DURI}assets/dropzone/css/basic.css" />


{/block}