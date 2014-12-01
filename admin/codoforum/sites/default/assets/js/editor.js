/*
 * @CODOLICENSE
 */

//avoid alt+e and alt+f key combinations

CODOF.mark = {
    linker: {
        eventsAttached: false,
        show: function(markItUp) {

            CODOF.mark.linker.bind_events(markItUp);
            jQuery('#codo_modal_link_text').val('');
            jQuery('#codo_modal_link_url').val('');
            jQuery('#codo_modal_link_title').val('');
            setTimeout(function() {
                jQuery('#codo_modal_link_url').focus();
            }, 100);
            $('#codo_modal_link').modal();

        },
        bind_events: function(markItUp) {


            if (CODOF.mark.linker.eventsAttached) {
                return;
            }
            CODOF.mark.linker.eventsAttached = true;

            jQuery('#codo_modal_link_submit').bind('click', function(event) {
                event.stopPropagation();
                event.preventDefault();


                var text = jQuery('#codo_modal_link_text').val();
                var url = jQuery('#codo_modal_link_url').val();
                var title = jQuery('#codo_modal_link_title').val();

                if (url === "") {

                    jQuery('#codo_modal_link_url').addClass('boundary-error').focus();
                    return;
                }

                var md = '';

                if (url.indexOf('://') === -1) {

                    url = "http://" + url;
                }

                if (title === "" && text === "") {

                    md = url;
                } else if (title === "") {

                    md = '[' + text + '](' + url + ')';
                } else if (text === "") {

                    md = '[' + title + '](' + url + ' "' + title + '")';
                } else {

                    md = '[' + text + '](' + url + ' "' + title + '")';

                }

                md += " ";
                jQuery(markItUp.textarea).trigger('insertion', [{replaceWith: md}]);
                $('#codo_modal_link').modal('hide');

            });
        }
    },
    upload: {
        show: function(markitup) {

            $('#codo_modal_upload').modal().on('hidden.bs.modal', function() {

                if (typeof CODOF.dz !== "undefined") {

                    CODOF.dz.removeAllFiles(true);
                }
            });

            CODOF.markitup = markitup;
            //jQuery('.dropzone.dz-clickable .dz-message span').fitText(1, {minFontSize: '20px', maxFontSize: '40px'});
            $('.dropzone.dz-clickable .dz-message span ').replaceWith(function() {
                return $("<h2 />", {html: $(this).html()});
            });
        }
    },
    smiley: {
        show: function(markitup) {

            $('#codo_markitup_smileys').slideToggle();
            CODOF.markitup = markitup;

        },
        hide: function() {
            $('#codo_markitup_smileys').slideToggle();
        }

    }
};




CODOF.editor_settings = {
    onEnter: {keepDefault: false, replaceWith: '  \n'},
    onShiftEnter: {keepDefault: false, openWith: '\n\n'},
    onTab: {keepDefault: false, replaceWith: '    '},
    markupSet: [
        {name: 'Bold', key: 'B', openWith: '**', closeWith: '**'},
        {name: 'Italic', key: 'I', openWith: '_', closeWith: '_'},
        {separator: '---------------'},
        {name: 'Bulleted List', openWith: '- '},
        {name: 'Numeric List', openWith: function(markItUp) {
                return markItUp.line + '. ';
            }},
        {separator: '---------------'},
        //{name: 'Picture', key: 'P', replaceWith: '![[![Alternative text]!]]([![Url:!:http://]!] "[![Title]!]")'},
        //{name: 'Link', key: 'L', openWith: '[', closeWith: ']([![Url:!:http://]!] "[![Title]!]")', placeHolder: 'Your text to link here...'},
        {name: 'Picture', key: 'U', replaceWith: function(markItUp) {
                CODOF.mark.upload.show(markItUp);
                return false;
            }
        },
        {name: 'Link', replaceWith: function(markItUp) {
                CODOF.mark.linker.show(markItUp);
                return false;
            }
        },
        {separator: '---------------'},
        {name: 'Quotes', key: 'Q', openWith: '> '},
        {name: 'Code Block / Code', openWith: '\n```` \r', closeWith: '\r\n````'},
        {separator: '---------------'},
        {name: 'Smiley', beforeInsert: function(markItUp) {
                CODOF.mark.smiley.show(markItUp);
                return false;
            }
        },
        {name: 'Preview', call: 'preview', className: "preview"},
        {name: 'Headers', className: "heading", dropMenu: [
                {name: 'Header 1', key: '1', className: "header1", placeHolder: 'Your title here...', closeWith: function(markItUp) {
                        return CODOF.editor.markdowntitle(markItUp, '=')
                    }},
                {name: 'Header 2', key: '2', className: "header2", placeHolder: 'Your title here...', closeWith: function(markItUp) {
                        return CODOF.editor.markdowntitle(markItUp, '-')
                    }},
                {name: 'Header 3', key: '3', className: "header3", openWith: '### ', placeHolder: 'Your title here...'},
                {name: 'Header 4', key: '4', className: "header4", openWith: '#### ', placeHolder: 'Your title here...'},
                {name: 'Header 5', key: '5', className: "header5", openWith: '##### ', placeHolder: 'Your title here...'},
                {name: 'Header 6', key: '6', className: "header6", openWith: '###### ', placeHolder: 'Your title here...'}
            ]
        }
    ],
    previewInElement: jQuery('#codo_new_reply_preview'),
    previewParser: function(content) {

        var markdown = marked(content, {
            highlight: function(code, lang) {
                return hljs.highlightAuto(code).value;
            }
            , sanitize: true
        });

        return markdown;
    }
};

// jQuery plugin: PutCursorAtEnd 1.0
// http://plugins.jquery.com/project/PutCursorAtEnd
// by teedyay
//
// Puts the cursor at the end of a textbox/ textarea

// codesnippet: 691e18b1-f4f9-41b4-8fe8-bc8ee51b48d4
(function($)
{
    jQuery.fn.putCursorAtEnd = function()
    {
        return this.each(function()
        {
            $(this).focus()

            // If this function exists...
            if (this.setSelectionRange)
            {
                // ... then use it
                // (Doesn't work in IE)

                // Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
                var len = $(this).val().length * 2;
                this.setSelectionRange(len, len);
            }
            else
            {
                // ... otherwise replace the contents with itself
                // (Doesn't work in Google Chrome)
                $(this).val($(this).val());
            }

            // Scroll to the bottom, in case we're in a tall textarea
            // (Necessary for Firefox and Google Chrome)
            this.scrollTop = 999999;
        });
    };
})(jQuery);



jQuery('document').ready(function($) {

    CODOF.editor = {
        chars_left_div: $('#codo_reply_min_chars_left'),
        chars_left_div_hidden: false,
        color_change: false,
        new_reply_preview: $("#codo_new_reply_preview"),
        add_file_tomarkup: function() {


            var up = '';
            var file;
            for (var k in CODOF.files) {

                file = CODOF.files[k];

                if (file.type.match(/image.*/))
                    up += '![' + file.name + '](serve/attachment&path=' + file.name + ')  \n';
                else
                    up += '[' + file.realname + '](serve/attachment&path=' + file.name + ')  \n';
            }

            CODOF.files = [];
            $(CODOF.markitup.textarea).trigger('insertion', [{replaceWith: up}]);

        },
        calc_chars: function(val_len) {

            var chars_left = CODOF.pass.reply_min_chars - val_len;

            if (chars_left > 0) {

                CODOF.editor.chars_left_div.html(chars_left);

                if (CODOF.editor.chars_left_div_hidden) {

                    CODOF.editor.chars_left_div.parent().show();
                    CODOF.editor.chars_left_div_hidden = false;
                    CODOF.editor_reply_post_btn.removeClass('codo_btn_primary');
                }
            } else {

                CODOF.editor.chars_left_div.parent().hide();
                CODOF.editor.chars_left_div_hidden = true;
                CODOF.editor_reply_post_btn.addClass('codo_btn_primary');
            }


        },
        markdowntitle: function(markItUp, char) {

            var heading = '';
            var n = $.trim(markItUp.selection || markItUp.placeHolder).length;
            for (var i = 0; i < n; i++) {
                heading += char;
            }
            return '\n' + heading;
        }

    };



    $("#codo_new_reply_textarea").markItUp(CODOF.editor_settings).bind('input propertychange', function() {

        CODOF.editor_trigger_preview($(this));
    });

    //reset height of editor if window is small
    
    var win_ht = $(window).outerHeight();
    var editor_ht = $('#codo_new_reply').outerHeight();
    if(win_ht < editor_ht) {
        
        //var diff = editor_ht - win_ht;
        $('#codo_reply_box').css('height', (win_ht - 100) + "px" ).css('min-height', "0px");
    }


    $('#codo_post_preview_btn_resp').click(function() {
       
        $('#markItUpCodo_new_reply_textarea').slideToggle();
        $(this).toggleClass('codo_post_preview_bg codo_post_preview_bg_hide');
    }); 

    CODOF.editor.calc_chars($("#codo_new_reply_textarea").val().length);

    function is_touching_bottom(el) {

        var sc_top = el.scrollTop;
        var sc_ht = el.scrollHeight;
        var off_ht = el.offsetHeight;

        return (sc_ht <= (sc_top + off_ht));

    }

    CODOF.editor_trigger_preview = function(me) {

        $('#codo_markitup_smileys').html(CODOF.smiley.smileylist(CODOF.pass.smileys));

        CODOF.editor.preview.trigger('mouseup');
        var $textarea = $("#codo_new_reply_textarea");

        if (is_touching_bottom($textarea[0]) ||
                is_touching_bottom(CODOF.editor.new_reply_preview[0])) {
            CODOF.editor.new_reply_preview.stop().animate({scrollTop: CODOF.editor.new_reply_preview[0].scrollHeight}, 500);
        }

        CODOF.editor.calc_chars(me.val().length);
    };

    /*
     
     (CODOF.sync = function() {
     
     var $textarea = $('#codo_new_reply_textarea');
     var $preview = CODOF.editor.new_reply_preview[0];
     
     $textarea.on('scroll', function() {
     
     var sc_top = this.scrollTop;
     var sc_ht = this.scrollHeight;
     var off_ht = this.offsetHeight;
     var percentage;
     
     if (sc_ht <= (sc_top + off_ht)) {
     
     percentage = 1;
     } else {
     
     percentage = sc_top / (sc_ht - off_ht);
     percentage = (percentage > 1) ? 1 : percentage;//dont let it excced 1
     }
     
     if(percentage === 1) {
     
     $preview.scrollTop = $preview.scrollHeight;
     }else{
     
     $preview.scrollTop = percentage * ($preview.scrollHeight - $preview.offsetHeight);                
     }
     });
     })();
     
     */
    CODOF.editor.preview = $('a[title="Preview"]');


    $('#codo_new_reply_textarea').show();


    $('a[title="Preview"]').trigger('mouseup');

    $('#codo_reply_box').gripHandler({
        cursor: 'ns-resize',
        gripClass: 'codo_reply_resize_handle'
    });

    CODOF.editor_preview_btn.click(function() {

        $(this).toggleClass('codo_post_preview_bg codo_post_preview_bg_hide');
        $('#codo_new_reply_preview_container').toggle();
        $('#markItUpCodo_new_reply_textarea').toggleClass('markitUp_width_half markitUp_width_full');
        return false;
    });


    CODOF.editor_form.submit(function() {
        return false;
    });

    CODOF.editor_reply_post_btn.on('click', function() {

        if (!CODOF.editor.chars_left_div_hidden) {

            clearTimeout(CODOF.editor.color_change);

            CODOF.editor.chars_left_div.css('color', '#800000');

            CODOF.editor.color_change = setTimeout(function() {
                CODOF.editor.chars_left_div.css('color', 'grey');
            }, 800);

            return false;

        }

        CODOF.submitted();
    });

    Dropzone.autoDiscover = false;
    $('#codomyawesomedropzone').dropzone({
        url: codo_defs.url + "Ajax/forum/topic/upload",
        dictDefaultMessage: CODOF.pass.dropzone.dictDefaultMessage,
        dictFallbackMessage: "",
        paramName: "file",
        maxFilesize: CODOF.pass.dropzone.max_file_size, //MB
        acceptedFiles: CODOF.pass.dropzone.allowed_file_mimetypes,
        autoProcessQueue: false,
        addRemoveLinks: true,
        uploadMultiple: false, // CODOF.pass.dropzone.forum_attachments_multiple,
        parallelUploads: CODOF.pass.dropzone.forum_attachments_parallel,
        maxFiles: CODOF.pass.dropzone.forum_attachments_max,
        init: function() {
            var dz = this;
            CODOF.dz = dz;
            CODOF.files = [];


            dz.on("addedfile", function() {

                $("#codo_modal_upload_submit").addClass('codo_btn_primary');
            });

            dz.on("removedfile", function() {

                if (!CODOF.dz.files.length)
                    $("#codo_modal_upload_submit").removeClass('codo_btn_primary');

            });

            $("#codo_modal_upload_submit").on('click', function() {

                if (!CODOF.dz.files.length)
                    return false;

                var me = $(this);

                if (!me.hasClass('codo_btn_primary'))
                    return false;

                me.removeClass('codo_btn_primary');
                if (dz.filesQueue) {
                    for (var i = 0; i < dz.files.length; i++) {
                        dz.filesQueue.push(dz.files[i]);
                    }
                }

                dz.processQueue();

            });


            dz.on("success", function(file, response) {

                response = JSON.parse(response);

                for (var i = 0; i < response.length; i++) {

                    // if (!CODOF.files[response[i].name])
                    CODOF.files.push({
                        name: response[i].name,
                        type: file.type,
                        realname: file.name
                    });

                }

            });


            dz.on("complete", function(file) {

                if (!dz.filesQueue
                        && dz.getUploadingFiles().length === 0 && dz.getQueuedFiles().length > 0) {

                    dz.processQueue();
                }

                if (dz.getQueuedFiles().length === 0 && dz.getUploadingFiles().length === 0
                        && !$("#codo_modal_upload_submit").hasClass('codo_btn_primary')) {
                    // File finished uploading, and there aren't any left in the queue.

                    $('#codo_modal_upload').modal('hide');
                    //CODOF.modal.hide('codo_modal_upload');
                    dz.removeAllFiles();

                    CODOF.editor.add_file_tomarkup();
                    $("#codo_modal_upload_submit").addClass('codo_btn_primary');
                }
            });


        }
    });
});