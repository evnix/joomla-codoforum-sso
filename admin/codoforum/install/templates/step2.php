<?php
/*
* @CODOLICENSE
*/

require 'head.php';
?>

    <div class="container">

        <div class="row">

            <div class="codo_steps">

                <div class="codo_steps_stripe"></div>
                <div class="codo_steps_stripe_progress codo_progress_step2"></div>

                <div class="step_body" style="margin-left: 14%">
                    <div class="codo_step codo_step_complete">1</div>
                </div>

                <div class="step_body" style="margin-left: 46%">
                    <div class="codo_step codo_step_active" >2</div>
                </div>

                <div class="step_body" style="margin-left: 79%">
                    <div class="codo_step" >3</div>
                </div>
            </div>

            <div class="codo_separator"></div>

            <div class="well well-lg">

                <?php if ($permission_error == true)  { ?> 
                    <div class="codo_premission_errors">

                        <b>Please make following files/folders writable</b>
                        <div style="margin-top:10px"></div>

                        <ol>
                            <?php foreach($permits as $permit) { 
                                if ($permit['perm'] == false) { ?>
                                    <li>
                                        <div><?php echo $permit['name']; ?></div> 
                                    </li>
                                <?php }
                            } ?>
                         </ol>
                        <div id="refresh" class="btn btn-dark">Refresh</div>
                    </div>
                <?php } else { ?>

                    <div id="codo_db_not_connect" class="codo_notification codo_notification_error">
                        Could not connect to the database with the given details!
                    </div>
                    <form id="codo_form_step2" role="form" class="form-horizontal" action="<?php echo RURI; ?>index.php&step=3" method="POST">
                        <fieldset>
                            <legend>Database details</legend>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" for="name">Database name</label>
                                <div class="col-sm-8">
                                    <input id="focus_here" type="text" class="codo_input" name="db_name" placeholder="Enter database name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" for="name">username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="codo_input" name="db_user" placeholder="Enter username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" for="name">password</label>
                                <div class="col-sm-8">
                                    <input type="text" class="codo_input" name="db_pass" placeholder="Enter password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" for="name">Database host</label>
                                <div class="col-sm-8">
                                    <input type="text" class="codo_input" name="db_host" placeholder="Enter database host" required>
                                </div>
                            </div>
                            <!--{*<div class="form-group">
                            <label  class="col-sm-2 control-label" for="name">Table prefix</label>
                            <div class="col-sm-8">
                            <input type="text" class="codo_input" name="db_host" placeholder="Enter database host" required>
                            </div>
                            </div>*}-->

                            <div style="margin-top:30px"></div>

                            <legend>Administrator details</legend>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" for="name">Admin username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="codo_input" name="admin_user" placeholder="Enter administrator username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" for="name">Admin password</label>
                                <div class="col-sm-8">
                                    <input type="text" class="codo_input" name="admin_pass" placeholder="Enter administrator password" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" for="name">Admin mail</label>
                                <div class="col-sm-8">
                                    <input type="text" class="codo_input" name="admin_mail" placeholder="Enter administrator email address" required>
                                </div>
                            </div>
                        </fieldset>
                        <div style="margin-top:30px"></div>

                        <input type="hidden" name="db_dsn" id="db_dsn"/>
                        <div id="submit" class="btn btn-dark">Submit</div>
                    </form>
                <?php } ?>

            </div>

        </div>

    </div>

    <script type="text/javascript">

        jQuery('document').ready(function($) {

            $('#codo_db_not_connect').hide();
            $('#focus_here').focus();

            $('body').keypress(function(event) {
                
                
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    
                   return false;
                }
            });

            $('#gotostep3').on('click', function() {

                window.location.href = "<?php echo RURI; ?>index.php&step=3";
            });

            $('#refresh').on('click', function() {

                window.location.reload();
            });

            $('#submit').click(function() {

                var data = $('#codo_form_step2').serialize();
                data += "&post_req=" + encodeURIComponent('yes');

                $.post('<?php echo RURI; ?>index.php&step=3',
                        data
                        , function(data) {

                            if (!data[1]) {

                                $('#codo_db_not_connect').fadeIn().html(data[0]);
                            } else {

                                $('#codo_form_step2').submit();
                            }
                        }, 'JSON');

                //return false;
            });
        });
    </script>

<?php
require 'foot.php';
