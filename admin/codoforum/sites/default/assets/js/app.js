/*
 * @CODOLICENSE
 */

'use strict';

//Why MS ? ;)
if (!console) {

    console = {
        log: function() {
        }
    };
}

jQuery.fn.visible = function(partial) {

    var $t = $(this),
            $w = $(window),
            viewTop = $w.scrollTop(),
            viewBottom = viewTop + $w.height(),
            _top = $t.offset().top,
            _bottom = _top + $t.height(),
            compareTop = partial === true ? _bottom : _top,
            compareBottom = partial === true ? _top : _bottom;

    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

};

//workaroud for $.browser for jQuery 1.9
jQuery.browser = {};
jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());


codo_defs.get = function(key) {

    var id = "_codo_" + key;

    return jQuery('#' + id).html();
};

var CODOF = {
    //Thanks to SO
    abbr_num: function(number, decPlaces) {

        // 2 decimal places => 100, 3 => 1000, etc
        decPlaces = Math.pow(10, decPlaces);

        // Enumerate number abbreviations
        var abbrev = ["k", "m", "b", "t"];

        // Go through the array backwards, so we do the largest first
        for (var i = abbrev.length - 1; i >= 0; i--) {

            // Convert array index to "1000", "1000000", etc
            var size = Math.pow(10, (i + 1) * 3);

            // If the number is bigger or equal do the abbreviation
            if (size <= number) {
                // Here, we multiply by decPlaces, round, and then divide by decPlaces.
                // This gives us nice rounding to a particular decimal place.
                number = Math.round(number * decPlaces / size) / decPlaces;

                // Handle special case where we round up to the next abbreviation
                if ((number == 1000) && (i < abbrev.length - 1)) {
                    number = 1;
                    i++;
                }

                // Add the letter for the abbreviation
                number += abbrev[i];

                // We are done... stop
                break;
            }
        }

        return number;
    },
    inc_num: function(id) {

        var div = jQuery('#' + id);

        var inc_no = parseInt(div.data('number')) + 1; //contains non-abbrev. no.
        var abbrev_no = CODOF.abbr_num(inc_no, 2);

        div.fadeOut(function() {

            jQuery(this).text(abbrev_no).fadeIn();
        });
    },
    ret_pagination: function(curr_page, num_pages, constants) {

        var times = 5 + (curr_page - 2),
                cnt = 1,
                i;
        var pages = {
            page: []
        };
        num_pages = parseInt(num_pages);

        if (num_pages < times) {

            times = num_pages;
        }

        if (curr_page > 5) {

            pages.page.push({
                page: cnt,
                first: true
            });

            cnt += (curr_page - 4);
        }

        var active;
        for (i = cnt; i <= times; i++) {

            active = false;
            if (curr_page === i) {
                active = true;
            }

            pages.page.push({
                page: i,
                active: active
            });

        }

        if (num_pages > times) {
            pages.page.push({
                page: num_pages,
                last: true
            });
        }

        pages.constants = constants;

        return pages;

    },
    util: {
        /**
         *  Adds codo_input_error class to blank input field else removes them
         * @param {type} id
         * @returns {undefined}
         */
        add_error_class_if_blank: function(id) {

            var el = jQuery('#' + id);

            if (el.val() === '') {

                el.addClass('codo_input_error');
            } else {

                el.removeClass('codo_input_error');
            }
        },
        update_response_status: function(response, el, saccade) {

            //default to error notification class
            var addclass = 'codo_notification_error', removeclass = 'codo_notification_success';
            if (response.status === "success") {

                //swap with success notification class
                var swap = addclass;
                addclass = removeclass;
                removeclass = swap;

            } else {

                var len = response.msg.length, msg = "<ol>";

                while (len--) {

                    msg += "<li>" + response.msg[len] + "</li>";
                }

                msg += "</ol>";
                response.msg = msg;
            }

            el.html(response.msg)
                    .addClass(addclass)
                    .removeClass(removeclass)
                    .show('slow');

            if (typeof saccade !== "undefined") {
                //shake it 
                CODOF.ui.saccade(el);
            }
        }

    },
    ui: {
        animating: false,
        /**
         * 
         * @param {jQuery object} el
         * @returns {undefined}
         */
        saccade: function(el) {

            if (!this.animating) {

                this.animating = true;

                el.css('position', 'relative')
                        .animate({"left": "+=30px"})
                        .animate({"left": "-=60px"})
                        .animate({"left": "+=30px"},
                        {
                            complete: function() {
                                CODOF.ui.animating = false;
                            }
                        });
            }
        }
    },
    modal: {
        show: function(id) {

            var modal = jQuery('#' + id);

            modal.show();

            if (modal.hasClass('animated')) {
                modal.removeClass('bounceOutUp')
                        .addClass('bounceInDown');
            }
            jQuery('.codo_modal_bg').show();

        },
        hide: function(id, callback) {

            if (typeof callback === "undefined")
                callback = CODOF.callback;

            var modal = jQuery('#' + id);

            if (modal.hasClass('animated')) {
                modal.removeClass('bounceInDown')
                        .addClass('bounceOutUp')
            }
            modal.fadeOut('slow', callback);

            jQuery('.codo_modal_bg').hide();

        }
    },
    callback: function() {
    },
    make_url: function(name) {

        return codo_defs.duri + codo_defs.smiley_path + name;
    },
    smiley: {
        smileylist: function(smileys)
        {
            var i = 0;

            var sm_array = [];

            for (i = 0; i < smileys.length; i++) {
                sm_array[i] = smileys[i].symbol;
            }

            var str;

            str = '<span class="smileylist">' + this.mksmileyurl(sm_array) + '</span>';


            return str;

        },
        mksmileyurl: function(name)
        {
            var namelen = name.length;
            var i = 0;
            var str = '';
            var j = 0;

            for (i = 0; i <= namelen; i++)
            {
                if (name[i] === null || typeof name[i] === "undefined")
                {
                    break;
                }

                str += '<li><div class="frei_smiley_image">' + this.gen_smiley(name[i]) + '</div></li>';
                j++;
            }

            return '<ul>' + str + '</ul>';
        },
        gen_smiley: function(name, no_click) {

            var replaced_mesg = name;

            if (typeof no_click === "undefined") {
                no_click = false;
            }

            var smileys = CODOF.pass.smileys;
            var i = 0;
            for (i = 0; i < smileys.length; i++) {

                if (no_click) {

                    replaced_mesg = replaced_mesg.codo_smiley_replace(smileys[i].symbol,
                            '<img src="' + CODOF.make_url(smileys[i].image_name, codo_defs.smiley_path) + '" alt="smile" />');
                } else {

                    replaced_mesg = replaced_mesg.codo_smiley_replace(smileys[i].symbol,
                            '<img onclick="CODOF.smiley.add_smiley(\'' + smileys[i].symbol.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&") + '\')" src="'
                            + CODOF.make_url(smileys[i].image_name, codo_defs.smiley_path) + '" alt="smile" />');
                }
                //   break;
            }
            return replaced_mesg;

        },
        add_smiley: function(name) {

            jQuery.markItUp(
                    //{replaceWith: '!['+name+'](' + codo_defs.url + 'serve/smiley?path=' + name + ') '}
                            {replaceWith: name + ' '}
                    );

                    CODOF.mark.smiley.hide();
                }

    },
    BBcode2html: function(s) {

        function rep(re, str) {
            s = s.replace(re, str);
        }
        ;

        // example: [b] to <strong>
        rep(/\n/gi, "<br />");
        rep(/\[b\]/gi, "<strong>");
        rep(/\[\/b\]/gi, "</strong>");
        rep(/\[i\]/gi, "<em>");
        rep(/\[\/i\]/gi, "</em>");
        rep(/\[u\]/gi, "<u>");
        rep(/\[\/u\]/gi, "</u>");
        rep(/\[url=([^\]]+)\](.*?)\[\/url\]/gi, "<a href=\"$1\">$2</a>");
        rep(/\[url\](.*?)\[\/url\]/gi, "<a href=\"$1\">$1</a>");
        rep(/\[img\](.*?)\[\/img\]/gi, "<img src=\"$1\" />");
        rep(/\[color=(.*?)\](.*?)\[\/color\]/gi, "<font color=\"$1\">$2</font>");
        rep(/\[code\](.*?)\[\/code\]/gi, "<span class=\"codeStyle\">$1</span>&nbsp;");
        rep(/\[quote.*?\](.*?)\[\/quote\]/gi, "<span class=\"quoteStyle\">$1</span>&nbsp;");

        return s;
    },
    moderation: {
        active: false,
        confirm_delete: function(me) {

            //use local mod instead of relying on the unreliable this
            var mod = this;

            if (mod.active)
                return;


            var $that = $(me);
            //activity started
            this.codo_spinner = $that.find('.codo_spinner');
            this.codo_spinner.show();

            if ($that.hasClass('codo_post_this_is_topic')) {

                //if (CODOF.topics.topic_active)
                //  return;

                //CODOF.topics.topic_active = true;
                mod.codo_spinner.hide();
                if (mod.last_confirm_popover !== me.id) {


                    if (typeof mod.confirm_popover !== "undefined") {
                        mod.confirm_popover.popover('hide');
                    }

                    mod.last_confirm_popover = me.id;
                    mod.confirm_popover = $that.popover({
                        html: true,
                        placement: function() {
                            if (document.documentElement.clientWidth < 320) {

                                return 'bottom';
                            } else if (document.documentElement.clientWidth > 320) {

                                if (mod.arrow)
                                    mod.arrow.show();
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
                            mod.arrow = popover.find('.arrow')
                                    .hide();
                        }
                    });

                    $that.parent().on('click', '.codo_modal_delete_topic_cancel', function() {

                        mod.confirm_popover.popover('hide');
                        mod.codo_spinner.hide();
                        //CODOF.topics.topic_active = false;

                    });

                    $that.parent().on('click', '.codo_modal_delete_topic_submit', function() {

                        mod.delete_topic($that);
                    });
                    mod.confirm_popover.popover('show');
                }

            }

        },
        delete_topic: function($that) {

            //use local mod instead of relying on the unreliable this
            var mod = this;

            $('.codo_posts_topic_delete .codo_spinner').show();

            var id = parseInt($that.attr('id').replace('codo_posts_trash_', ''));

            mod.codo_spinner = $that.find('.codo_spinner');
            mod.codo_spinner.show();

            jQuery.post(codo_defs.url + 'Ajax/forum/topic/' + id + '/delete', {
                token: codo_defs.token
            }, function(resp) {

                if (resp === "success") {

                    mod.codo_spinner.hide();
                    $that.parents('article').fadeOut();
                }
            });

        }

    },
    switch : {
        get: function(id) {

            var el = $('#' + id);
            if (el.hasClass('codo_switch_off')) {

                return el.find('span.codo_switch_off').html();
            }

            return el.find('span.codo_switch_on').html();
        }
    },
    /**
     * 
     * Simple Hook system to manage events . 
     * Before some requests there is a system hook , if you add your function
     * to that hook , then you can access and manipulate all the data for that
     * request in the variable CODOF.req.data
     * @type type
     * 
     */
    hook: {
        hooks: [],
        /**
         * 
         * args must be an object 
         * 
         * @param {string} hook
         * @param {function} func
         * @param {Object} args
         * @returns {undefined}
         * 
         */
        add: function(myhook, func, args) {

            var i = 0;

            if (typeof args === "undefined") {

                args = {};
            }

            if (typeof CODOF.hook.hooks[myhook] !== "undefined") {

                i = CODOF.hook.hooks[myhook].length;
            } else {

                CODOF.hook.hooks[myhook] = [];
            }

            CODOF.hook.hooks[myhook][i] = {
                func: func,
                args: args
            };
        },
        /**
         * 
         * args must be an object
         * 
         * @param {type} myhook
         * @param {Object} args
         * @returns {undefined}
         */
        call: function(myhook, args, func) {

            if (typeof CODOF.hook.hooks[myhook] !== "undefined") {

                var len = CODOF.hook.hooks[myhook].length,
                        curr;

                for (var i = 0; i < len; i++) {

                    curr = CODOF.hook.hooks[myhook][i];
                    jQuery.extend(args, args, curr.args);
                    curr.func(args);
                }
            }

            if (typeof func !== "undefined")
                func(args); //since javascript is asynchronous we defer the function 
        }
    },
    req: {
        data: {}
    }
};


jQuery(document).mouseup(function(e) {

    var container = jQuery('#codo_markitup_smileys')
    if (container.has(e.target).length === 0)
    {
        container.hide();
    }

}).ready(function($) {

    $('.codo_switch').click(function() {
        $(this).toggleClass('codo_switch_on').toggleClass('codo_switch_off');
    });

});


// Stop the animation if the user scrolls. Defaults on .stop() should be fine
jQuery('html, body').bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e) {
    if (e.which > 0 || e.type === "mousedown" || e.type === "mousewheel") {
        jQuery('html, body').stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup'); // This identifies the scroll as a user action, stops the animation, then unbinds the event straight after (optional)
    }
});



String.prototype.codo_smiley_replace = function(name, value) {
    name = name.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");

    var re = new RegExp(name, "g");
    return this.replace(re, value);
};