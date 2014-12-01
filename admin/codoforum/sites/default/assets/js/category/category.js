/*
 * @CODOLICENSE
 */

'use strict';

jQuery('document').ready(function($) {

    CODOF.editor_form = $('#codo_new_topic_form');
    CODOF.editor_preview_btn = $('#codo_post_preview_btn');
    CODOF.editor_reply_post_btn = $('#codo_new_topic_btn');
    CODOF.topic_creator = {
        container: $('#codo_topics_create'),
        widget: $('#codo_topics_create > .codo_widget'),
        textarea: $('#codo_topic_desc'),
        desc_div: $('#codo_topic_desc_div'),
        title: $('#codo_topic_title'),
        onfocus: $('.codo_topics_on_focus_show'),
        template: Handlebars.compile($("#codo_template").html()),
        paginate: Handlebars.compile($("#codo_pagination").html()),
        from: parseInt(CODOF.pass.curr_page),
        has_built_topics: false,
        ended: false,
        body: $('#codo_lower_containers'),
        unique: 1,
        containers: 2,
        animate_top: 200,
        articles: $(".codo_lower_containers > div > article"),
        search_data: JSON.parse(CODOF.pass.search_data),
        search_switch: false,
        get_div_pos: function(id) {

            //cannot cache them, because everytime a new div is added
            var last_left = $('#codo_topics_container_' + id + ' > article.codo_left_div:last');
            var last_right = $('#codo_topics_container_' + id + ' > article.codo_right_div:last');
            var pos;
            if (last_left.length === 0 && last_right.length === 0) {

                //no div appended yet
                pos = 'left'; //default float to left
            } else {

                if (last_left.length > 0 && last_right.length > 0) {

                    //both div exist, so check height
                    var left_ht = last_left.offset().top + last_left.outerHeight();
                    var right_ht = last_right.offset().top + last_right.outerHeight();
                    if (left_ht > right_ht) {

                        //next div will go to right
                        pos = 'right';
                    } else if (left_ht < right_ht) {

                        //next div will go to left
                        pos = 'left'
                    } else {

                        //both are at same , do by default left
                        pos = 'left';
                    }

                } else if (last_left.length > 0) {

                    //right is empty , next div will go left
                    pos = 'right';
                } else {

                    //left is empty , next div will go right
                    pos = 'right';
                }
            }

            return "codo_" + pos + "_div";
        },
        build_topic: function(context) {

            this.built_topics = this.template(context);
            return this.built_topics;
        },
        extend_first_article: function(saved) {

            if (saved) {

                $('.codo_left_div_first .codo_topics_topic_message')
                        .css('height', CODOF.topic_creator.extra_ht + "px")
                        .css('max-height', CODOF.topic_creator.extra_ht + "px");
                return;
            }

            if (this.unique > 1) {
                //extend the first div to bottom of .codo_catgories
                var extra_ht = ($('.codo_categories').offset().top + $('.codo_categories').outerHeight())
                        - ($('.codo_left_div_first').offset().top + $('.codo_left_div_first').outerHeight());
                var present_ht = $('.codo_left_div_first .codo_topics_topic_message').outerHeight();
                var extra_ht = extra_ht + present_ht - 10; // 20 is margin-bottom
                extra_ht = Math.ceil(extra_ht / 10) * 10;
                $('.codo_left_div_first .codo_topics_topic_message')
                        .css('height', extra_ht + "px")
                //.css('max-height', extra_ht + "px");

                if (typeof CODOF.topic_creator.extra_ht === "undefined")
                    CODOF.topic_creator.extra_ht = extra_ht;
            }

        },
        add_readmore: function(id) {

            var msg = $('#codo_topics_topic_message_' + id);
            if (msg.length > 0 && CODOF.helper.has_text_overflown(msg[0])) {

                $('#codo_topics_topic_more_' + id).show();
                msg.css('margin-bottom', '0');
            }

        },
        fetch: function(search_mode) {

            if (typeof search_mode === "undefined") {

                search_mode = false;
            }

            CODOF.req.data = {
                from: CODOF.topic_creator.from,
                cat_alias: CODOF.pass.cat_alias,
                catid: CODOF.pass.catid,
                token: codo_defs.token
            };
            if (CODOF.topic_creator.search_switch) {

                $('#codo_upper_container').append("<div class='codo_load_more_gif'></div>");
                CODOF.topic_creator.search_switch = false;
            }


            CODOF.hook.call('before_req_fetch_topics', {}, function() {

                $.getJSON(
                        codo_defs.url + 'Ajax/forum/category/get_topics',
                        CODOF.req.data,
                        function(response) {

                            if (response.topics.length > 0) {

                                var html, constants = [];
                                if (response.num_pages != 'not_passed') {

                                    CODOF.pass.num_pages = response.num_pages;
                                    CODOF.req.data.get_page_count = 'no';
                                }
                                var id = CODOF.topic_creator.containers++;
                                CODOF.topic_creator.body.append('<div class="codo_topics" id="codo_topics_container_' + id + '"></div>');
                                var container = $('#codo_topics_container_' + id);
                                for (var key in response.topics) {


                                    if (search_mode) {

                                        response.topics[key].position = '';
                                        if (CODOF.topic_creator.unique == 1) {
                                            response.topics[key].position = 'codo_article_already_visible';
                                        }
                                    } else {

                                        response.topics[key].position = CODOF.topic_creator.get_div_pos(id);
                                    }
                                    response.topics[key].cid = CODOF.topic_creator.unique;
                                    response.topics[key].aid = 'codo_topics_ajax_article_' + CODOF.topic_creator.unique;
                                    for (var k in response)
                                        if (k !== 'topics') {
                                            response.topics[key][k] = response[k];
                                            constants[k] = response[k];
                                        }
                                    //console.log(response.topics[key]);
                                    html = CODOF.topic_creator.build_topic(response.topics[key]);
                                    container.append(html);
                                    CODOF.topic_creator.add_readmore(CODOF.topic_creator.unique);
                                    CODOF.topic_creator.unique++;
                                }

                                //recache all articles
                                CODOF.topic_creator.articles = $(".codo_lower_containers > div > article");
                                constants['search'] = JSON.stringify(CODOF.topic_creator.search_data);
                                console.log(constants);
                                var curr_page = CODOF.topic_creator.from + 1;
                                var pagination = CODOF.topic_creator.ret_pagination(curr_page, constants);
                                container.append(pagination);
                                CODOF.req_started = false;
                                CODOF.topic_creator.from++; //next page

                            } else if($('#codo_category_topics article').length === 0){

                                $('#codo_no_topics_display').css('display', 'inline-block');
                                CODOF.hook.call('after_topics_loaded');
                            }

                            $('.codo_load_more_gif').remove();
                            CODOF.hook.call('after_topics_fetched');
                        }
                );
            }
            );
        },
        refresh: function() {

            $('#codo_upper_container > article').remove();
            $('#codo_lower_containers').html('');
            //start from first container
            this.containers = 1;
            CODOF.req_started = true;
            //reassign ids from first
            this.unique = 1;
            //set page 1
            this.from = 0;
            //fetch all posts/topics
            this.fetch(true);
            (function arrange_articles() {

                if (!CODOF.req_started) {

                    //again set ids from first while processing
                    CODOF.topic_creator.unique = 1;
                    CODOF.topic_creator.arrange_first_topics();
                    CODOF.hook.call('after_topics_loaded');
                } else {
                    setTimeout(arrange_articles, 100);
                }
            })();
        }

    };
    Handlebars.registerHelper('msg', function() {

        return new Handlebars.SafeString(this.message.replace(/\n/g, "<br/>"));
    });
    if (!CODOF.helper) {
        CODOF.helper = {};
    }

    CODOF.helper.has_text_overflown = function(el) {

//Make sure the div has overflow set to hidden
//console.log(el.clientHeight + " " + el.scrollHeight);
        return /*el.clientWidth < el.scrollWidth ||*/ el.clientHeight < el.scrollHeight;
    };
    CODOF.topic_creator.arrange_first_topics = function() {

        var pos;
        $('.codo_topics > article').each(function() {

            if (CODOF.topic_creator.unique === 1) {

                //special condition to avoid one less calculation
                //remove and place first article in upper container
                CODOF.first_div = $(this);
                CODOF.topic_creator.reattach_div($(this));
                CODOF.stop_calling_me = false;
            } else {

                var moved = false;
                if (!CODOF.stop_calling_me) {

                    //once filled no calculation necessary to check if space is left
                    moved = CODOF.topic_creator.set_second_article($(this));
                }

                if (moved) {

                    //we already know the postion , its left
                    pos = 'codo_left_div'
                } else {

                    //calculate based on the last appended div
                    //1st container always
                    pos = CODOF.topic_creator.get_div_pos(1);
                }

                $(this).addClass(pos);
            }

            CODOF.topic_creator.add_readmore(CODOF.topic_creator.unique);
            CODOF.topic_creator.unique++;
        });
        if (CODOF.topic_creator.unique === 2) {

            $('#codo_topics_article_1').addClass('codo_left_div_first');
            $('#codo_topics_ajax_article_1').addClass('codo_left_div_first');
            CODOF.topic_creator.extend_first_article(false);
        }

    };
    //here second article doesnt actually mean only second article
    //but all articles including second article until there is no space
    //left in the left of .codo_categories
    CODOF.topic_creator.set_second_article = function(article) {

        //sometimes the image is not loaded at the time of call of this function
        //so for correct calculations , height is manually set
        var cat_img = $('.codo_cat_img img');
        cat_img.css('height', cat_img.css('width'));
        var this_article_was_moved;
        //first div already added in upper container
        //lets check if there is still space left for one more
        //make sure you compare with max height that can be given

        //height of right from bottom
        var rbottom = $('#codo_categories').position().top + $('#codo_categories').outerHeight(true);
        //get last div's bottom height
        var last_div = $('#codo_topics_article_' + (CODOF.topic_creator.unique - 1));
        //get first ajax article in case it is in search mode
        if (last_div.length === 0) {

            last_div = $('#codo_topics_ajax_article_' + (CODOF.topic_creator.unique - 1));
        }

        var lbottom = last_div.position().top + last_div.outerHeight(true);
        //get the difference and check whether there is still space available
        var diff = rbottom - lbottom;
        if (diff > article.outerHeight(true)) {

            //oh there is some space left
            CODOF.topic_creator.reattach_div(article);
            this_article_was_moved = true;
        } else {

            //no more space left, so extend the last article that was appended
            last_div.addClass('codo_left_div_first');
            CODOF.stop_calling_me = true;
            this_article_was_moved = false;
            CODOF.topic_creator.extend_first_article(false);
        }


        return this_article_was_moved;
    };
    CODOF.topic_creator.reattach_div = function(ele) {

        ele.appendTo('#codo_upper_container');
    };
    CODOF.topic_creator.arrange_first_topics();
    //setTimeout(CODOF.topic_creator.extend_first_article, 1000);

    //Do not show description div if empty
    if ($.trim($('.codo_cat_desc').text()) === "") {

        $('.codo_cat_desc').css("display", "none");
    }

    CODOF.topic_creator.category = $('.codo_categories');
    CODOF.topic_creator.first_article = $('article:first');
    CODOF.topic_creator.animate_article = function(set, hide) {

        if (set) {
            CODOF.topic_creator.extend_first_article(set);
        }

        var top;
        if (typeof hide !== "undefined") {

            top = '0';
        } else {
            top = '0';
        }

        CODOF.topic_creator.first_article.animate({top: '100'}, {
            duration: 500,
            specialEasing: {top: "easeInSine"},
            complete: function() {


                CODOF.topic_creator.category.animate({top: top}, {
                    duration: 1000,
                    specialEasing: {top: "easeOutBounce"}
                });
                CODOF.topic_creator.first_article.animate({top: top}, {
                    duration: 1000,
                    specialEasing: {top: "easeOutBounce"},
                    complete: function() {
                        if (!set)
                            CODOF.topic_creator.extend_first_article(set);
                    }
                });
            }
        });
    };
    $('#codo_topic_desc_div').click(function() {

        if (codo_defs.logged_in === 'no') {

            window.location.href = CODOF.pass.login_url;
            return false;
        }

        CODOF.topic_creator.onfocus.show({
            duration: 'slow'
        });
        $('#codo_new_reply').show();
        CODOF.topic_creator.title.focus();
        CODOF.topic_creator.desc_div.hide();
        CODOF.topic_creator.textarea.show();
        CODOF.topic_creator.container.addClass('codo_topics_item_gigante');
        //$('#codo_topics_virtual').show();

        CODOF.topic_creator.container[0].style.height = "496px";
        //$container.masonry();

        CODOF.topic_creator.category.animate({top: '300'}, {
            duration: 500,
            specialEasing: {top: "easeInSine"}
        });
        $('#codo_topics_create').animate({
            marginLeft: "6%",
            width: "100%"
        }, {
            duration: 500,
            specialEasing: {marginLeft: "easeInOutBack"},
            complete: function() {

                $(this).animate({marginLeft: 0}, 500);
            }
        });
        if (CODOF.topic_creator.first_article.length > 0) {

            CODOF.topic_creator.animate_article(false);
        } else {
            CODOF.topic_creator.category.animate({top: '0', left: '-35%'}, {
                duration: 1000,
                specialEasing: {top: "easeOutBounce"}
            });
        }
    });
    $('#codo_cancel_topic_btn').click(function() {

        CODOF.topic_creator.category.animate({top: '0'}, {
            duration: 500,
            specialEasing: {top: "easeInSine"}
        });
        $('#codo_new_reply').hide();
        $('#codo_topics_create').animate({
            marginLeft: "0",
            width: "68%"
        }, {
            duration: 400,
            specialEasing: {marginLeft: "easeInOutElastic"},
            complete: function() {
                CODOF.topic_creator.container.removeClass('codo_topics_item_gigante');
            }
        });
        CODOF.topic_creator.onfocus.slideUp();
        if (CODOF.topic_creator.first_article.length > 0) {

            CODOF.topic_creator.animate_article(true, true);
        } else {
            CODOF.topic_creator.category.animate({top: '0'}, {
                duration: 1000,
                specialEasing: {top: "easeOutBounce"}
            }).css('left', '0');
        }


        CODOF.topic_creator.title.val('');
        CODOF.topic_creator.desc_div.show();
        CODOF.topic_creator.textarea.hide().val('').css('height', 'auto');
        //$('#codo_topics_virtual').hide();
        CODOF.topic_creator.container[0].style.height = "auto";
        //$container.masonry();

        return false;
    });
    CODOF.submitted = function() {

        //$('#codo_reply_replica').val($('#codo_new_reply_preview').html());

        if (CODOF.editor_reply_post_btn.hasClass('codo_btn_primary') && !CODOF.is_error()) {
            CODOF.editor_reply_post_btn.removeClass('codo_btn_primary');
            $('#codo_new_reply_loading').show();
            CODOF.req.data = {
                title: $.trim($('#codo_topic_title').val()),
                cat: CODOF.pass.catid,
                imesg: $('#codo_new_reply_textarea').val(),
                omesg: $('#codo_new_reply_preview').html(),
                end_of_line: $('#end_of_line').val(),
                token: codo_defs.token

            };
            CODOF.hook.call('before_req_topic_create');
            $.post(
                    codo_defs.url + 'Ajax/forum/topic/create',
                    CODOF.req.data,
                    function(response) {

                        if (response === "success") {

                            window.location.href = codo_defs.url + 'forum/topics/' + CODOF.pass.cat_alias;
                        } else {
                            alert(response);
                            CODOF.editor_reply_post_btn.addClass('codo_btn_primary');
                        }

                        $('#codo_new_topic_loader').hide();
                    }
            );
        }

        return false;
    };
    CODOF.is_error = function() {

        var error = false;
        $('#codo_new_topic_form :input[required=""],#codo_new_topic_form :input[required]').each(function() {

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
    $('#codo_category_topics').on('click', ".codo_posts_trash_post", function() {

        CODOF.moderation.confirm_delete(this);
    });
    $('#codo_category_topics').on('click', ".codo_posts_edit_post", function() {

        var id = parseInt(this.id.replace('codo_posts_edit_', ''));
        //if ($(this).hasClass('codo_post_this_is_topic')) {

        window.location.href = codo_defs.url + 'forum/topic/' + id + '/edit';
        //}
    });
    $(window).scroll(function() {

        var offset = 10;
        if ($(window).scrollTop() + offset > $(document).height() - $(window).height()) {

//request and get data before the user even reaches end of page

            if (!CODOF.req_started) {

                CODOF.req_started = true;
                CODOF.topic_creator.fetch();
            }
        }
    });
    CODOF.topic_creator.ret_pagination = function(curr_page, constants) {

        var pages = CODOF.ret_pagination(curr_page, CODOF.pass.num_pages, constants);
        return CODOF.topic_creator.paginate(pages);
    };
    if (CODOF.pass.curr_page > 1 && CODOF.pass.num_pages > 1) {
        $('.row').prepend(CODOF.topic_creator.ret_pagination(CODOF.pass.curr_page, CODOF.pass.constants));
        $('#codo_search_advanced_options > .row > .codo_topics_pagination').remove();
    }

    if (CODOF.pass.num_pages === 0) {
        $('.codo_topics_pagination').hide();
    }

    CODOF.last_visible_div = false;
    CODOF.last_scroll_top = 0;
    CODOF.odd_even_animate = false;
    CODOF.page_scrolled = false;
    $(window).scroll(function(event) {

        var st = $(this).scrollTop();
        if (st > CODOF.last_scroll_top) {

            CODOF.topic_creator.articles.each(function(i, el) {

                var el = $(el);
                if (el.visible(true) && !el.hasClass('codo_article_already_visible')) {

                    var duration = 1200;
                    if (CODOF.odd_even_animate) {
                        duration = 600;
                    }
                    CODOF.odd_even_animate = !CODOF.odd_even_animate;
                    el.animate({
                        marginTop: 0
                    }, {
                        duration: duration,
                        specialEasing: {marginTop: "easeOutBack"},
                        complete: function() {
                            el.addClass('codo_article_already_visible');
                        }
                    });
                }

            });
        }
        CODOF.last_scroll_top = st;
        if ($(this).scrollTop() > 100 && !CODOF.page_scrolled) {

//initial page scroll
            $(".codo_lower_containers article").each(function(i, el) {

                var el = $(el);
                if (el.visible(true)) {
                    el.addClass("codo_article_already_visible");
                    CODOF.last_visible_div = el;
                    //console.log(CODOF.last_visible_div);
                }
            });
            if (CODOF.last_visible_div && CODOF.last_visible_div.length > 0) {
                CODOF.last_visible_div.addClass('codo_article_already_visible')
                        .prevAll('article').addClass('codo_article_already_visible')
                        .nextAll('article').each(function(i, el) {

                    var el = $(el);
                    if (!el.visible(true)) {
                        el.addClass("codo_ajax_article");
                    }

                });
            }

            CODOF.page_scrolled = true;
        }
    });
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

        var div = $('#codo_topics_ajax_article_1');
        if (div.length === 0) {

            div = $('#codo_no_topics_display');
        }

        jQuery('html, body').animate({
            scrollTop: div.offset().top
        }, 500);
    }

    $('#codo_search_keywords').keypress(function(event) {

        if (event.which == 13) {

            CODOF.hook.add('after_topics_loaded', scroll_to_first_post);
        }
    });
    $('#codo_search_btn').click(function() {

        CODOF.hook.add('after_topics_loaded', scroll_to_first_post);
        codo_create_filter();
        return false;
    });
    $('#codo_search_form').submit(function() {

        codo_create_filter();
        return false;
    });

    setTimeout(function(){$('#codo_search_keywords').focus();},10);

});
