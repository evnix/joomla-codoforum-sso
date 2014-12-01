<?php
/*
 * @CODOLICENSE
 */

defined('IN_CODOF') or die();

use Lib\Hook,
    Lib\Util;

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo Util::get_opt('site_title'); ?></title>

        <?php Hook::call('before_site_head'); ?>  

        <!--[if lte IE 8]>
         <script src="/path/to/json2.js"></script>
        <![endif]-->
        
        <?php
        
            if(!isset($css_files)) {
                $css_files = array();
            }
        ?>
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
       
        <link rel="stylesheet/less" href="<?php echo CURR_THEME; ?>less/app.less.php?css_files=<?php echo urlencode(json_encode($css_files)); ?>"/>



        <script src="<?php echo DURI; ?>client/js/jquery-1.10.2.min.js"></script>
        <?php Hook::call('after_jq_loaded'); ?>

        <script src="<?php echo DURI; ?>client/js/jquery.rest.js"></script>
        <script src="<?php echo DURI; ?>client/js/bootstrap.min.js"></script>
        
        <!--
            Contains js defs required by codoforum 
            Acts as a bridge between js and php
        -->
        <?php require ABSPATH . 'client/js/app.js.php'; ?>

        <!-- Contains general js functions required by codoforum -->
        <script type="text/javascript" src="<?php echo DURI; ?>client/js/app.js"></script>
        
        <?php Hook::call('after_site_head'); ?>

    </head>

    <body>

        <div class="codo_stripe"></div>
        <?php
        Hook::call('site_body');
        $html = render('templates/' . $view);
        echo $html;
        Hook::call('site_footer', $html);
        ?>
        <script src="<?php echo DURI; ?>client/js/less-1.5.0.min.js"></script>
        <script src="<?php echo DURI; ?>client/js/handlebars-v1.1.2.js"></script>
        
    </body>

</html>