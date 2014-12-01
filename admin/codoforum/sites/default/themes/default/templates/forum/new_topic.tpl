{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}
    <div class="codo_container">

            <ol class="codo_breadcrumb">
                <li><a href="{$smarty.const.RURI}{$site_url}">{$home_title}</a></li>
                <li>{_("New topic")}</li>
            </ol>
        
        
        <div class="row">

            <div class="codo_widget">
                <div class="codo_widget-header">
                    {_("Create Topic")}
                </div>

                <div class="codo_widget-content">
                    <form id="codo_new_reply_post"  method="POST" class="" role="form">

                        <div class="form-group">
                            <label for="title">{_("Title")}</label>
                            <div>
                                <input id="codo_topic_title" type="text" class="codo_input" value="{$topic.title}" placeholder="{_('Give a title for your topic')}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category">{_('Category')}</label>

                            <div>
                                <div class="dropdown" id="codo_category_select">
                                    <button value="" class="btn dropdown-toggle btn-default" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                        <span>{_("Select a category")}</span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                        {foreach from=$cats item=cat}

                                            <li role="presentation"><a id="{$cat->cat_id}" data-alias="{$cat->cat_alias}">{$cat->cat_name}</a></li>

                                            {print_children cat=$cat}
                                        {/foreach}


                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div id="codo_new_reply" class="codo_new_reply">

                            <!--<div class="codo_reply_resize_handle"></div>-->

                            <div class="codo_reply_box" id="codo_reply_box">
                                <textarea placeholder="{_('Describe your topic . You can use BBcode or Markdown')}" id="codo_new_reply_textarea" name="input_text">{$topic.imessage}</textarea>
                                <div class="codo_new_reply_preview" id="codo_new_reply_preview_container">
                                    <div class="codo_editor_preview_placeholder">{_("live preview")}</div>
                                    <div id="codo_new_reply_preview"></div>
                                </div>
                            </div>

                            <div class="codo_new_reply_action">
                                <button class="codo_btn" id="codo_new_reply_action_post">{_("Post")}</button>
                                <button onclick="window.history.back()" class="codo_btn codo_btn_def" id="codo_new_reply_action_cancel">{_("Cancel")}</button>

                                <img id="codo_new_reply_loading" src="{$smarty.const.CURR_THEME}img/ajax-loader.gif" />
                                <button class="codo_btn codo_btn_def codo_post_preview_bg" id="codo_post_preview_btn">&nbsp;</button>       
                                <button class="codo_btn codo_btn_def codo_post_preview_bg" id="codo_post_preview_btn_resp">&nbsp;</button>                    
                                
                            </div>
                            <input type="text" class="end-of-line" name="end_of_line" />                        

                            <div class="codo_reply_min_chars">{_("enter atleast ")}<span id="codo_reply_min_chars_left">{$reply_min_chars}</span>{_(" characters")}</div>
                        </div>

                        <input type="text" class="end-of-line" name="end_of_line" />
                        <input id="codo_topic_cat" name="codo_topic_cat" type="hidden" />
                        <input id="codo_topic_cat_alias" name="codo_topic_cat_alias" type="hidden" />
                        <input type="hidden" name="token" value="{$CSRF_token}" />

                    </form>
                </div>
            </div>
        </div>

        {include file='forum/editor.tpl'}
    </div>
    <script type="text/javascript">


        CODOF.pass = {
            smileys: JSON.parse('{$forum_smileys}'),
            reply_min_chars: parseInt({$reply_min_chars}),
            dropzone: {
                dictDefaultMessage: '{_("Drop files to upload &nbsp;&nbsp;(or click)")}',
                max_file_size: parseInt('{$max_file_size}'),
                allowed_file_mimetypes: '{$allowed_file_mimetypes}',
                forum_attachments_multiple: {$forum_attachments_multiple},
                forum_attachments_parallel: parseInt('{$forum_attachments_parallel}'),
                forum_attachments_max: parseInt('{$forum_attachments_max}')

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


                var cat_id = parseInt('{$topic.cat_id}');

                CODOF.edit_topic_id = false;

                if (cat_id !== 0) {

                    CODOF.edit_topic_id = parseInt('{$topic.topic_id}');

                    $('#codo_category_select li  a').each(function() {

                        if (parseInt($(this).attr('id')) === cat_id) {

                            $(this).trigger('click');
                            $('#codo_category_select li  a').off();
                            $('#codo_new_reply_action_post').html('{_("Edit")}');
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

                    CODOF.req.data = {
                        title: $.trim($('#codo_topic_title').val()),
                        cat: $.trim($('#codo_topic_cat').val()),
                        imesg: $('#codo_new_reply_textarea').val(),
                        omesg: $('#codo_new_reply_preview').html(),
                        end_of_line: $('#end_of_line').val(),
                        token: codo_defs.token,
                        tid: CODOF.edit_topic_id
                    };

                    CODOF.hook.call('before_req_send');

                    $.post(
                            codo_defs.url + 'Ajax/forum/topic/' + action,
                            CODOF.req.data,
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

{*
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

{/block}
