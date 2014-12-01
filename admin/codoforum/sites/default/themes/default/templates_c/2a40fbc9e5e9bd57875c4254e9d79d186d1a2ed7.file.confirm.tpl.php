<?php /* Smarty version Smarty-3.1.16, created on 2014-02-09 15:45:48
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/user/confirm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149950251752f7688e942f46-62875774%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a40fbc9e5e9bd57875c4254e9d79d186d1a2ed7' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/user/confirm.tpl',
      1 => 1391946623,
      2 => 'file',
    ),
    'e19a14c9e0a1d8063627a23a68a2a861b04ad7e9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/layout.tpl',
      1 => 1391948701,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149950251752f7688e942f46-62875774',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52f7688ea10266_87500419',
  'variables' => 
  array (
    'site_title' => 0,
    'page' => 0,
    'CSRF_token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52f7688ea10266_87500419')) {function content_52f7688ea10266_87500419($_smarty_tpl) {?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title><?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</title>

        <!--[if lte IE 8]>
         <script src="//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.min.js"></script>
        <![endif]-->

        <?php echo $_smarty_tpl->tpl_vars['page']->value['head']['css'];?>


        <script type="text/javascript">
            var codo_defs = {
                url: "<?php echo @constant('RURI');?>
",
                duri: "<?php echo @constant('DURI');?>
",
                reluri: "<?php echo @constant('DATA_REL_PATH');?>
",
                token: "<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
",
                smiley_path: "<?php echo @constant('SMILEY_PATH');?>
"
    };
        </script>

        <?php echo $_smarty_tpl->tpl_vars['page']->value['head']['js'];?>


    </head>

    <body>

        <div class="codo_stripe">
            This is codoforum content

        </div>
        <div class='codo_modal_bg'></div>

    

    <div class="codo_container">

        <div class="row">

            <div class="col-md-6">

                <?php if ($_smarty_tpl->tpl_vars['result']->value=="VAR_NOT_PASSED"||$_smarty_tpl->tpl_vars['result']->value=="VAR_NOT_FOUND") {?>
                    <div class="codo_notification codo_notification_error">
                        <?php echo $_smarty_tpl->tpl_vars['result']->value;?>
<?php echo _("There was some error. Please check your confirmation link");?>

                    </div>
                <?php } else { ?>
                    <div class="codo_notification codo_notification_success">
                        <?php echo _("Email confirmation successfull");?>
<br/>
                        <?php echo _("You will be redirected to your ");?>
<a href="<?php echo @constant('RURI');?>
user/profile"><?php echo _("profile");?>
</a><?php echo _(" in 2 seconds");?>

                    </div>
                <?php }?>


            </div>
        </div>
    </div>

    <script type="text/javascript">

        setTimeout(function() {

            window.location.href = codo_defs.url + "user/profile";
        }, 2000);
    </script>


    <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

</body>

</html>
<?php }} ?>
