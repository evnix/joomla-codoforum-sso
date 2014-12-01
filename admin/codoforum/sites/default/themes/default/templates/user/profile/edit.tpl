{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}
    <div class="codo_container">

        <div id="profile_edit_status" class="codo_notification" style="display: none"></div>

        <div class="row">

            <div class="col-md-8">
                <div class="codo_edit_profile">


                    {if isset($file_upload_error)}

                        <div class="codo_notification codo_notification_error">{$file_upload_error}</div>
                    {/if}

                    {if isset($user_profile_edit) AND $user_profile_edit}
                        <div class="codo_notification codo_notification_success">{_("user profile edits saved successfully")}</div>
                    {/if}
                    <form action="{$smarty.const.RURI}user/profile/{$user->id}/edit" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">{_("username")}</label>
                            <div class="col-sm-8">
                                <input type="text" name="username" class="codo_input codo_input_disabled" id="username"  value="{$user->username}" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="display_name" class="col-sm-2 control-label">{_("display name")}</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="codo_input" id="codo_display_name" placeholder="" value="{$user->name}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="display_name" class="col-sm-2 control-label">{_("avatar")}</label>
                            <div class="col-sm-8 codo_avatar">

                                <img class="codo_avatar_img" draggable="false" src="{$user->avatar}" />
                                <input class="codo_change_avatar" id="codo_avatar_file" type="file" name="avatar" />
                                <div style="display: none" id="codo_new_avatar_selected_name"></div>
                                <img class="codo_right_arrow" id="codo_right_arrow" src="{$smarty.const.CURR_THEME}img/arrow-right.jpg" />
                                <img class="codo_avatar_preview" src="" id="codo_avatar_preview"/>
                                <div class="codo_btn codo_btn_def">{_("Change")}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="display_name" class="col-sm-2 control-label">{_("signature")}</label>
                            <div class="col-sm-8">
                                <textarea name="signature" maxlength="{$signature_char_lim}" id="codo_signature_textarea" class="codo_input">{$user->signature}</textarea>
                            </div>
                            <span id="codo_countdown_signature_characters">{$signature_char_lim}</span>
                        </div>


                        <div id="codo_before_save_user_profile">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="codo_btn codo_btn_primary">{_("Save edits")}</button>
                            </div>
                        </div>

                        <input type="hidden" name="token" value="{$CSRF_token}" />
                    </form>
                </div>
            </div>


            <div class="col-md-4 codo_edit_profile">

                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" name="curr_pass" class="codo_input" id="curr_pass"  placeholder="{_("Current password")}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" name="new_pass" class="codo_input" id="new_pass"  placeholder="{_("New password")}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" name="confirm_new_pass" class="codo_input" id="confirm_pass"  placeholder="{_("Confirm password")}" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button id="change_pass" type="submit" class="codo_btn codo_btn_primary">{_("Change password")}</button>
                        <span id="codo_pass_no_match_txt" class="codo_pass_no_match_txt">{_("passwords do not match!")}</span>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">

        jQuery(document).ready(function($) {

            $('#codo_display_name').focus();

            $(document).keypress(function(e) {
                
                if(e.which === 13 && $('#confirm_pass').is(":focus")) {
                    
                    $('#change_pass').trigger('click');
                }
            });

            $('#change_pass').click(function() {

                CODOF.req.data = {
                    curr_pass: $('#curr_pass').val(),
                    new_pass: $('#new_pass').val(),
                    confirm_pass: $('#confirm_pass').val(),
                    token: codo_defs.token
                };

                CODOF.util.add_error_class_if_blank('curr_pass');
                CODOF.util.add_error_class_if_blank('new_pass');
                CODOF.util.add_error_class_if_blank('confirm_pass');

                var no_pass_txt = $('#codo_pass_no_match_txt');

                if (CODOF.req.data.new_pass !== CODOF.req.data.confirm_pass) {

                    if (no_pass_txt.hasClass('codo_pass_no_match_txt_twice')) {

                        CODOF.ui.saccade(no_pass_txt);
                    }

                    else if (no_pass_txt.hasClass('codo_pass_no_match_txt_again')) {

                        no_pass_txt.addClass('codo_pass_no_match_txt_twice');
                    }

                    else if (no_pass_txt.is(":visible")) {

                        no_pass_txt.addClass('codo_pass_no_match_txt_again');
                    } else {

                        no_pass_txt.show();
                    }
                    
                    return false;
                }
                CODOF.hook.call('before_change_pass');

                $.getJSON(
                        codo_defs.url + 'Ajax/user/edit/change_pass',
                        CODOF.req.data,
                        function(response) {

                            CODOF.util.update_response_status(response, $('#profile_edit_status'), true);
                        }
                );
            });

            function calculate_len(textarea) {

                var len = textarea.val().length;
                console.log(len);
                var allowed_len = parseInt('{$signature_char_lim}');

                var count = allowed_len - len;

                $('#codo_countdown_signature_characters').html(count);

            }

            $('#codo_signature_textarea').keyup(function() {

                calculate_len($(this));
            });

            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#codo_avatar_preview').show().attr('src', e.target.result);
                        $('#codo_right_arrow').show('slow');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#codo_avatar_file').change(function() {

                if (window.File && window.FileReader && window.FileList) {

                    //can show file preview
                    readURL($(this)[0]);
                } else {

                    $('#codo_new_avatar_selected_name').html($(this).val().match(/[^\/\\]+$/)).show('slow');
                }



            });
            calculate_len($('#codo_signature_textarea'));
        });
    </script>
{/block}
