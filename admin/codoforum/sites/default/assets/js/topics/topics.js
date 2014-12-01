/*
 * @CODOLICENSE
 */

jQuery('document').ready(function($) {
    CODOF.context = (CODOF.pass.topics);
    CODOF.topics = {
        body: $('.codo_topics_body'),
        articles: $('.codo_topics_body > article'),
        img_shown: false,
        req_started: false,
        has_built_topics: false,
        built_topics: '',
        from: parseInt(CODOF.pass.num_posts_per_page),
        ended: false,
        active: false,
        template: Handlebars.compile($("#codo_template").html()),
        build_topics: function(context) {

            this.built_topics = this.template(context);
            return this.built_topics;
        },
        insert: function() {

            if (CODOF.topics.has_built_topics) {

                CODOF.topics.body.append(this.built_topics);
                CODOF.topics.has_built_topics = false;
                CODOF.req_started = false;
                //after inserting remove the loader image
                $('.codo_load_more_gif').remove();
                CODOF.img_shown = false;
            }
        },
        fetch: function() {

            if (!CODOF.req_started) {

                CODOF.req_started = true;

                CODOF.req.data = {
                    from: CODOF.topics.from,
                    token: codo_defs.token
                };

                CODOF.hook.call('before_req_fetch_topics', {}, function() {

                    $.getJSON(
                            codo_defs.url + 'Ajax/forum/topics/get_topics',
                            CODOF.req.data,
                            function(response) {

                                if (response.num_posts) {


                                    //if (!CODOF.topics.from) {
                                    //CODOF.topics.from += 2 * response.num_posts;
                                    //} else {
                                    CODOF.topics.from += response.num_posts;
                                    //}

                                    //build the next N results but don't show them yet
                                    //because we don't know if user will scroll to
                                    //bottom or not

                                    CODOF.topics.build_topics(response);
                                    CODOF.topics.has_built_topics = true;
                                    if (CODOF.img_shown) {

                                        //this means user has reached end of page
                                        //so you can now show the next N results
                                        CODOF.topics.insert();
                                    }

                                }

                                if (response.topics.length === 0 && !CODOF.topics.ended) {

                                    if (CODOF.context.topics.length) {

                                        if ($('#codo_topics_body .codo_topics_topic_message').length > 0) {
                                            CODOF.topics.body.append('<article class="codo_topics_end">' + CODOF.pass.no_more_posts + '</article>');
                                        } else {
                                            CODOF.topics.body.append('<article class="codo_topics_end">' + CODOF.pass.no_posts + '</article>');
                                        }
                                    }
                                    CODOF.topics.end = $('.codo_topics_end');
                                    CODOF.topics.end.fadeIn('slow');
                                    CODOF.topics.ended = true;
                                }

                            }
                    );

                });

            }

        }
    };
    // console.log(CODOF.context);


    var html = CODOF.topics.template(CODOF.context);

    if (!CODOF.context.topics.length) {
        $('#codo_no_topics_display').show();
    }

    if (CODOF.pass.subcategory_dropdown === 'shown') {

        $('.codo_category_children_container .codo_category_children')
                .css('display', 'block');
    }

    $('#codo_topics_body').append(html);

    $('.codo_category_children_shower').on('click', function(e) {

        if (!$(e.target).hasClass('codo_category_title') && $(e.target).find('.codo_no_children_present').length === 0) {

            //e.stopPropagation();
            var children_container = $(this).next();
            var sub_cat;

            if (children_container.hasClass('codo_category_children_container')) {

                //this click was from parent category
                //so go inside one step
                sub_cat = children_container.children(".codo_category_children");
            } else {

                //container itself is the subcat
                sub_cat = children_container.parent().children(".codo_category_children");
            }

            //show/hide this sub_cat
            sub_cat.slideToggle();


            //cancel parent link
            return false;
        } else {

            var target = $(e.target);
            if (!target.hasClass('codo_category_children_shower')) {

                target = target.parents('.codo_category_children_shower');
            }

            window.location.href = target.find('a').attr('href');
        }
    });

    $('#codo_topics_body').on('click', ".codo_posts_trash_post", function() {

        CODOF.moderation.confirm_delete(this);
    });


    $('#codo_topics_body').on('click', ".codo_posts_edit_post", function() {

        var id = parseInt(this.id.replace('codo_posts_edit_', ''));


        //if ($(this).hasClass('codo_post_this_is_topic')) {

        window.location.href = codo_defs.url + 'forum/topic/' + id + '/edit';
        //}
    });


    $(window).scroll(function() {

        var offset = 500;
        if ($(window).scrollTop() + offset > $(document).height() - $(window).height()) {

            //request and get data before theu user even reaches end of page
            CODOF.topics.fetch();
        }
        if ($(window).scrollTop() >= $(document).height() - $(window).height()) {

            if (!CODOF.img_shown && !CODOF.topics.ended) {

                CODOF.topics.body.append("<div class='codo_load_more_gif'></div>");
                CODOF.img_shown = true;
                if (CODOF.topics.has_built_topics) {

                    //has loaded topics before reaching bottom
                    CODOF.topics.insert();
                }
            }

            if (CODOF.topics.ended) {

                CODOF.ui.saccade(CODOF.topics.end);
            }
        }
    });

    $('#codo_search_open_advanced').click(function() {

        $('#codo_advanced_search_li').toggleClass('advanced_search_open');
        $('#codo_search_advanced_options').slideToggle();

        return false;
    }).mousedown(function() {
        return false;
    });

    function codo_create_filter() {


        var data = {
            str: $('#codo_search_keywords').val(),
            cats: $('#codo_search_cats').val(),
            search_subcats: CODOF.switch.get('codo_search_sub_cats_switch'),
            match_titles: CODOF.switch.get('codo_search_titles_switch'),
            sort: $('#codo_search_sort').val(),
            order: CODOF.switch.get('codo_search_order_switch'),
            search_within: $('#codo_search_time').val()
        };

        CODOF.topics.from = 0; //reset page no.
        CODOF.topics.insert();
        $('#codo_topics_body').html('');
        CODOF.topics.body.append("<div class='codo_load_more_gif'></div>");
        CODOF.img_shown = true;
        CODOF.topics.ended = false;

        CODOF.hook.add('before_req_fetch_topics', function() {

            $.extend(CODOF.req.data, data);
        });

        CODOF.topics.fetch();
    }

    function scroll_to_first_post() {

        jQuery('html, body').animate({
            scrollTop: $('#codo_topics_body').offset().top
        }, 500);

    }

    $('#codo_search_keywords').keypress(function(event) {

        if (event.which == 13 && $('#codo_search_advanced_options').is(':visible')) {

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
function codo_create_topic() {

    window.location.href = codo_defs.url + 'forum/new_topic';
}
