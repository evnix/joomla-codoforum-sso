/*
 * @CODOLICENSE
 */

'use strict';


jQuery('document').ready(function($) {

    CODOF.editor_form = $('#codo_new_reply_post');
    CODOF.editor_preview_btn = $('#codo_post_preview_btn');
    CODOF.editor_reply_post_btn = $('#codo_post_new_reply');
    CODOF.container = $('.codo_container');


    CODOF.topic_creator = {
        body: $('#codo_posts_container'),
        from: parseInt(CODOF.pass.curr_page),
        template: Handlebars.compile($("#codo_template").html()),
        paginate: Handlebars.compile($("#codo_pagination").html()),
        container: $('#codo_posts_container'),
        edit_post_id: false,
        search_data: JSON.parse(CODOF.pass.search_data),
        search_switch: false,
        build_topic: function(context) {

            this.built_topics = this.template(context);
            return this.built_topics;
        },
        update_head_navigation: function() {

            var pagination = CODOF.topic_creator.paginate(CODOF.ret_pagination(CODOF.pass.curr_page, CODOF.pass.num_pages, {
                cls: 'codo_head_navigation',
                url: CODOF.pass.url,
                search: JSON.stringify(CODOF.topic_creator.search_data)
            }));

            $('.codo_head_navigation').replaceWith(pagination);
            //adjusts width of pagination and title so that it fits in one line
            CODOF.topic_creator.dynamic_width_assign();

            this.search_switch = false;

        },
        fetch: function() {
            
            $('.codo_load_more_gif').remove();
            CODOF.topic_creator.body.append("<div class='codo_load_more_gif'></div>");

            CODOF.req.data = {
                from: CODOF.topic_creator.from,
                tid: CODOF.pass.tid,
                title: CODOF.pass.title,
                token: codo_defs.token
            };

            CODOF.hook.call('before_req_fetch_topics', {}, function() {

                $.getJSON(
                        codo_defs.url + 'Ajax/forum/topic/get_posts',
                        CODOF.req.data,
                        function(response) {

                            CODOF.req.data.get_page_count = 'no';
                            if (response.posts.length > 0) {

                                var html;

                                if (response.num_pages > 0) {

                                    CODOF.pass.num_pages = response.num_pages;
                                }


                                for (var key in response.posts) {

                                    for (var k in response)
                                        if (k !== 'posts') {
                                            response.posts[key][k] = response[k];
                                        }

                                    if (response.posts[key].post_id === CODOF.pass.post_id) {

                                        response.posts[key]['can_edit_topic'] = CODOF.pass.perms.can_edit_topic;
                                        response.posts[key]['can_delete_topic'] = CODOF.pass.perms.can_delete_topic;
                                    }

                                    response.posts[key].page = CODOF.topic_creator.from + 1;
                                    html = CODOF.topic_creator.build_topic(response.posts[key]);

                                    CODOF.topic_creator.container.append(html);
                                }

                                var curr_page = CODOF.topic_creator.from + 1;

                                var pagination = CODOF.editor_ret_pagination(curr_page);


                                if (CODOF.topic_creator.search_switch) {

                                    CODOF.topic_creator.update_head_navigation();
                                }

                                CODOF.topic_creator.container.append(pagination);

                                CODOF.req_started = false;
                                CODOF.topic_creator.from++; //next page
                                $('.codo_load_more_gif').remove();
                            } else {

                                $('.codo_load_more_gif').remove();
                                CODOF.pass.num_pages = 0;
                                $('.codo_head_navigation').css('visibility', 'hidden');
                                $('#codo_no_topics_display').show();

                            }
                        }
                );
            });
        },
        refresh: function() {

            $('#codo_posts_container > article').remove();
            $('.codo_topic_separator').remove();
            
            //set page 1
            this.from = 0;

            this.fetch(true);
        }
    };

    //event delegation with event maps
    $('#codo_posts_container').on({
        'click': function() {

            var textbox = $('#codo_new_reply_textarea');
            textbox.val('');
            CODOF.editor_trigger_preview(textbox);
            $('#codo_new_reply').slideDown(400, function() {
                CODOF.container.css('padding-bottom', $('#codo_new_reply').outerHeight(true));

            });

            CODOF.post_being_edited = false;

        }
    }, '.codo_reply_btn');

    $('#codo_posts_container').on({
        'click': function() {

            var content = $(this).parent().parent().parent().prev().children().eq(1);

            var text = content.text();

            var lines = text.split('\n');
            var len = lines.length;

            for (var i = 0; i < len; i++) {

                if ($.trim(lines[i]) !== '') {

                    //not a blank line
                    lines[i] = '>' + lines[i];
                }
            }

            var textbox = $('#codo_new_reply_textarea');
            var def_val = textbox.val();

            if (def_val !== '') {

                text = '\n' + lines.join('\n');
            } else {

                text = lines.join('\n');
            }


            CODOF.textarea = textbox;
            textbox.val(def_val + text + '\n');

            $('#codo_new_reply').slideDown(400, function() {

                CODOF.container.css('padding-bottom', $('#codo_new_reply').outerHeight(true));
                CODOF.editor_trigger_preview(textbox);
                CODOF.textarea.putCursorAtEnd();
            });
            CODOF.post_being_edited = false;

        }
    }, '.codo_quote_btn');

    CODOF.topic_creator.active = false;

    $('#codo_posts_container').on('click', ".codo_posts_trash_post", function() {

        if (CODOF.topic_creator.active)
            return;

        var $that = $(this);
        //activity started
        CODOF.codo_spinner = $that.find('.codo_spinner');
        CODOF.codo_spinner.show();

        if ($that.hasClass('codo_post_this_is_topic')) {

            if (CODOF.topic_creator.topic_active)
                return;

            CODOF.topic_creator.topic_active = true;
            CODOF.codo_spinner.hide();
            if (typeof CODOF.confirm_popover === "undefined") {

                CODOF.confirm_popover = $that.popover({
                    html: true,
                    placement: function() {
                        if (document.documentElement.clientWidth < 320) {

                            return 'bottom';
                        } else if (document.documentElement.clientWidth > 320) {

                            if (CODOF.topic_creator.arrow)
                                CODOF.topic_creator.arrow.show();
                            return 'left';
                        }
                    },
                    content: function() {
                        return $('#codo_delete_topic_confirm_html').html();
                    }
                }).on('shown.bs.popover', function() {

                    //-207px
                    if (document.documentElement.clientWidth < 320) {

                        //popover is always appended so it becomes the next element
                        var popover = $(this).next();
                        popover.css('left', '-207px');
                        CODOF.topic_creator.arrow = popover.find('.arrow')
                                .hide();
                    }
                });

                $that.parent().on('click', '.codo_modal_delete_topic_cancel', function() {

                    CODOF.confirm_popover.popover('hide');
                    CODOF.codo_spinner.hide();
                    CODOF.topic_creator.topic_active = false;

                });

                $that.parent().on('click', '.codo_modal_delete_topic_submit', function() {

                    CODOF.topic_creator.delete_topic($that);
                });

            }

            CODOF.confirm_popover.popover('toggle');
        } else {

            CODOF.topic_creator.active = true;
            CODOF.topic_creator.delete_post(this);
        }

    });


    $('#codo_posts_container').on('click', ".codo_posts_edit_post", function() {

        var me = this;
        var $that = $(this);

        if ($that.hasClass('codo_post_this_is_topic')) {

            window.location.href = codo_defs.url + 'forum/topic/' + CODOF.pass.tid + '/edit';
        } else {

            var textbox = $('#codo_new_reply_textarea');
            var value = $that.parent().parent().find('.codo_posts_post_imessage').text();

            textbox.val(value);
            CODOF.editor_trigger_preview(textbox);
            $('#codo_new_reply').slideDown(400, function() {

                CODOF.container.css('padding-bottom', $('#codo_new_reply').outerHeight(true));
            });

            CODOF.post_being_edited = true;
            CODOF.topic_creator.edit_post_id = parseInt(me.id.replace('codo_posts_edit_', ''));
        }
    });

    CODOF.topic_creator.delete_topic = function($that) {

        $('.codo_posts_topic_delete .codo_spinner').show();

        var id = CODOF.pass.tid;

        CODOF.codo_spinner = $that.find('.codo_spinner');
        CODOF.codo_spinner.show();

        jQuery.post(codo_defs.url + 'Ajax/forum/topic/' + id + '/delete', {
            token: codo_defs.token
        }, function(resp) {

            if (resp === "success") {

                CODOF.codo_spinner.hide();
                window.location.href = codo_defs.url + 'forum/topics/' + CODOF.pass.cat_alias;
            }
        });

    };

    CODOF.topic_creator.delete_post = function(me) {

        var id = parseInt(me.id.replace('codo_posts_trash_', ''));

        jQuery.post(codo_defs.url + 'Ajax/forum/post/' + id + '/delete', {
            token: codo_defs.token

        }, function(resp) {

            if (resp === "success") {

                var article = $('#post-' + id);
                article.slideUp();
                CODOF.codo_spinner.hide();

                $('<div class="codo_deleted_post"><div class="codo_spinner"></div>' + CODOF.pass.deleted_msg + '<b>' + CODOF.pass.deleted + '</b>\n\
                        <div id="codo_deleted_post_' + id + '"><span>undo</span><div></div></div>\n\
                </div>').insertBefore(article);

                $('#codo_deleted_post_' + id).on('click', function() {

                    if (CODOF.topic_creator.active)
                        return;

                    CODOF.topic_creator.active = true;
                    var that = $(this);
                    var codo_spinner = $(this).parent().find('.codo_spinner');
                    codo_spinner.show();

                    jQuery.post(codo_defs.url + 'Ajax/forum/post/' + id + '/undelete', {
                        token: codo_defs.token

                    }, function(resp) {

                        if (resp === "success") {

                            codo_spinner.hide();
                            that.off(); //remove event handler immediately
                            article.slideDown();
                            that.parent().remove();
                            //activity ended
                        }
                        CODOF.topic_creator.active = false;
                    });
                });

            }

            CODOF.topic_creator.active = false;
        });

    };

    $('#codo_post_cancel').on('click', function() {

        var textbox = $('#codo_new_reply_textarea');
        textbox.val('');
        CODOF.editor_trigger_preview(textbox);
        CODOF.container.css('padding-bottom', 0);
        $('#codo_new_reply').slideUp(400);
    });


    CODOF.submitted = function() {

        //$('#codo_reply_replica').val($('#codo_new_reply_preview').html());

        if (CODOF.editor_reply_post_btn.hasClass('codo_btn_primary')) {
            CODOF.editor_reply_post_btn.removeClass('codo_btn_primary');
            $('#codo_new_reply_loading').show();


            var action = 'Ajax/forum/topic/reply';
            if (CODOF.post_being_edited) {

                action = 'Ajax/forum/post/edit';
            }

            CODOF.req.data = {
                input_txt: $('#codo_new_reply_textarea').val(),
                output_txt: $('#codo_new_reply_preview').html(),
                tid: CODOF.pass.tid,
                end_of_line: $('#end_of_line').val(),
                token: codo_defs.token,
                pid: CODOF.topic_creator.edit_post_id

            };

            CODOF.hook.call('before_req_send');

            $.post(
                    codo_defs.url + action,
                    CODOF.req.data,
                    function(msg) {

                        if (CODOF.post_being_edited) {

                            if (msg === 'success') {

                                var href = codo_defs.url + 'forum/topic/' + CODOF.pass.tid + '/' + CODOF.pass.title + '/' + CODOF.pass.curr_page + "#post-" + CODOF.topic_creator.edit_post_id;

                                if (window.location.href === href) {

                                    window.location.reload();
                                } else {

                                    window.location.href = href;
                                }
                            } else
                                alert(msg);
                        } else {


                            var is_json = true;
                            try
                            {
                                var response = $.parseJSON(msg);
                            }
                            catch (err)
                            {
                                is_json = false;
                            }


                            if (is_json) {

                                var page_no = CODOF.pass.num_pages, reload = false;

                                if (CODOF.pass.new_page === 'yes') {

                                    page_no++;
                                }

                                window.location.href = codo_defs.url + 'forum/topic/' + CODOF.pass.tid + '/' + CODOF.pass.title + '/' + page_no + "#post-" + response.pid;
                                if (CODOF.pass.curr_page === page_no) {

                                    window.location.reload();
                                }


                            } else {
                                alert(msg);
                                CODOF.editor_reply_post_btn.addClass('codo_btn_primary');
                            }
                        }

                        $('#codo_new_reply_loading').hide();
                    }
            );


        }

        return false;
    };

    $(window).scroll(function() {

        var offset = 200;
        if ($(window).scrollTop() + offset > $(document).height() - $(window).height()) {

            //request and get data before the user even reaches end of page

            if (!CODOF.req_started && CODOF.pass.num_pages > CODOF.topic_creator.from) {

                CODOF.req_started = true;
                CODOF.topic_creator.fetch();
            }
        }
    });

    CODOF.editor_ret_pagination = function(curr_page) {

        var constants = {
            cls: 'codo_topics_pagination',
            url: CODOF.pass.url,
            search: JSON.stringify(CODOF.topic_creator.search_data)
        };


        var pages = CODOF.ret_pagination(curr_page, CODOF.pass.num_pages, constants);

        return CODOF.topic_creator.paginate(pages);
    };

    if (CODOF.pass.num_pages > 1) {

        var pagination = CODOF.topic_creator.paginate(CODOF.ret_pagination(CODOF.pass.curr_page, CODOF.pass.num_pages, {
            cls: 'codo_head_navigation',
            url: CODOF.pass.url,
            search: JSON.stringify(CODOF.topic_creator.search_data)
        }));

        $('#codo_topic_title_pagination').append(pagination);

        if (!$.isEmptyObject(CODOF.topic_creator.search_data)) {

            //in search mode
            $('.codo_topics_pagination').remove();
            var pagination = CODOF.editor_ret_pagination(CODOF.pass.curr_page);
            CODOF.topic_creator.container.append(pagination);
        }

    }


    // $('.codo_widget-header > a').css('width', ( $('.codo_widget-header').width() - $('.codo_head_navigation').width() - 10)  + "px");

    (CODOF.topic_creator.dynamic_width_assign = function() {

        var mdt, mdp;
        var sm;

        /**
         *
         * Possible values of width
         * This becomes very very specfic to the theme
         * 112
         * 160
         * 208
         * 272
         * 304
         * 320
         * 352
         * 368
         * 400
         * 416
         * 464
         * 480
         */

        //TODO: Make below calculation independent of theme .
        var pagination = $('#codo_topic_title_pagination');
        var width = pagination.width();
        var hardcode = 80; //this is the only theme dependent value
        mdp = Math.ceil(width / hardcode);

        mdt = 12 - mdp;
        sm = 12;

        var $title = $('.codo_topic_title');

        $title.addClass('col-md-' + mdt + ' col-sm-' + sm);

        //NOTE: does not work on resize . atleast screens as of now are
        //physically inextensible ;)
        if ($title.parent().outerHeight() > $title.outerHeight() + 20) {

            //oops pagination is going in the next line
            //lets make both columns full width
            mdt = 12;
            $title.removeClass();
            //TODO: Instead of adding col-md-* , direct set width: 100% ?
            $title.addClass('codo_topic_title col-md-' + mdt + ' col-sm-' + sm);
            pagination.addClass('codo_pagination_at_full_width');
        } else {

            //its in the same line .
            var p_ht = pagination.parent().outerHeight();
            var ht = pagination.outerHeight();
            if (p_ht > ht) {

                //oh no! , this wont look good now. Lets vertically center
                //the pagination div
                var ht = Math.floor((p_ht - ht) / 2);
                pagination.css('marginTop', ht);
            }
        }

    })();




    $('#codo_search_open_advanced').click(function() {

        $('#codo_advanced_search_li').toggleClass('advanced_search_open');
        $('#codo_search_advanced_options').slideToggle();

        return false;
    }).mousedown(function() {
        return false;
    });

    CODOF.hook.add('before_req_fetch_topics', function() {

        $.extend(CODOF.req.data, CODOF.topic_creator.search_data);
    });

    function codo_create_filter() {


        CODOF.topic_creator.search_data = {
            str: $('#codo_search_keywords').val(),
            cats: CODOF.pass.catid,
            match_titles: CODOF.switch.get('codo_search_titles_switch'),
            sort: $('#codo_search_sort').val(),
            order: CODOF.switch.get('codo_search_order_switch'),
            search_within: $('#codo_search_time').val(),
            get_page_count: 'yes'
        };

        $('.codo_topics_pagination').remove();
        $('#codo_no_topics_display').hide();

        CODOF.topic_creator.search_switch = true;
        CODOF.topic_creator.refresh();
    }

    function scroll_to_first_post() {

        var div = $('#codo_posts_container > article:first');
        if (div.length === 0) {

            div = $('#codo_no_topics_display');
        }
        jQuery('html, body').animate({
            scrollTop: div.offset().top
        }, 500);

    }

    $('#codo_search_keywords').keypress(function(event) {

        if (event.which == 13) {

            scroll_to_first_post()
        }
    });

    $('#codo_search_btn').click(function() {

        scroll_to_first_post();
        codo_create_filter();
        return false;
    });

    $('#codo_search_form').submit(function() {

        codo_create_filter();
        return false;
    });


    setTimeout(function(){$('#codo_search_keywords').focus()},10);
});




function codo_smooth_scroll() {

    var div = jQuery(window.location.hash);
    if (div.length > 0) {
        jQuery('html, body').animate({
            scrollTop: div.offset().top,
        }, 500, function() {

            div.css('background', '#ffff99');
            setTimeout(function() {
                div.css('background', 'white');
            }, 2000);
        });
    }

    return false;
}

codo_smooth_scroll(); //call once after html is loaded
window.onhashchange = function() {

    codo_smooth_scroll();
};

jQuery.get(codo_defs.url + 'Ajax/forum/topic/inc_view', {
    topic_id: CODOF.pass.tid,
    token: codo_defs.token

}, function(resp) {

    if (resp === "success") {

        CODOF.inc_num('codo_topic_views');
    }
});

