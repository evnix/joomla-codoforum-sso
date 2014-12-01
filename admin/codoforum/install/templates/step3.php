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
                <div class="codo_steps_stripe_progress codo_progress_step3"></div>

                <div class="step_body" style="margin-left: 14%">
                    <div class="codo_step codo_step_complete">1</div>
                </div>

                <div class="step_body" style="margin-left: 46%">
                    <div class="codo_step codo_step_complete" >2</div>
                </div>

                <div class="step_body" style="margin-left: 79%">
                    <div class="codo_step codo_step_active" >3</div>
                </div>
            </div>

            <div class="codo_separator"></div>

            <div class="well well-lg">

                codoforum has been successfully installed . 

                <br/>Please rename/remove the <em>install/</em>  folder for security reasons    
                <br/><br/>
                <div>
                    <a href="<?php echo HOME; ?>" class="btn btn-dark">View site</a>
                    <a href="<?php echo HOME; ?>admin/" class="btn btn-dark">View backend</a>
                </div>                
            </div>

        </div>

    </div>

    <script type="text/javascript">

        jQuery('document').ready(function($) {


            $('#gotostep3').on('click', function() {

                window.location.href = "<?php echo RURI; ?>index.php&step=2";
            });
        })
    </script>


<?php
require 'foot.php';
