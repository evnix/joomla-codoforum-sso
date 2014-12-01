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
                <div class="codo_steps_stripe_progress codo_progress_step1"></div>

                <div class="step_body" style="margin-left: 14%">
                    <div class="codo_step codo_step_active">1</div>
                </div>

                <div class="step_body" style="margin-left: 46%">
                    <div class="codo_step" >2</div>
                </div>

                <div class="step_body" style="margin-left: 79%">
                    <div class="codo_step" >3</div>
                </div>
            </div>

            <div class="codo_separator"></div>

            <div class="well well-lg">

                <?php if($already_installed == 'yes')  { ?>

                    It looks like codoforum has been previously installed , if you want to reinstall it , please replace 
                    <br/><br/><code>$installed=true;</code> <br/><br/>by<br/><br/> <code>$installed=false;</code><br/><br/> in sites/default/config.php
                <?php } else { ?>
                    Welcome to codoforum . Please read the below license carefully .

                    <div class="codo_license">
                        <textarea  disabled id="codo_license"></textarea>
                    </div>

                    <div id="gotostep2" class="btn btn-dark">Accept and continue</div>
                <?php } ?>
            </div>

        </div>

    </div>

    <script type="text/javascript">

        jQuery('document').ready(function($) {
            $.get('license.txt', function(data) {

                //process text file line by line
                $('#codo_license').html(data.replace('\n', '<br>'));
            });

            $('#gotostep2').on('click', function() {

                window.location.href = "<?php echo RURI; ?>index.php&step=2&xhash=<?php echo $xhash; ?>";
                        });
                    })
    </script>


<?php
require 'foot.php';
