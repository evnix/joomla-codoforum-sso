<?php /* Smarty version Smarty-3.1.16, created on 2014-02-02 18:32:19
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/plugins/uni_login/test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13735263352ee7f1c788831-32157970%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6966f0996a26dafe08746ca93b4036d06d34b8f3' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/plugins/uni_login/test.tpl',
      1 => 1391362337,
      2 => 'file',
    ),
    'e19a14c9e0a1d8063627a23a68a2a861b04ad7e9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/layout.tpl',
      1 => 1389623697,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13735263352ee7f1c788831-32157970',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52ee7f1c819f10_72868657',
  'variables' => 
  array (
    'site_title' => 0,
    'page' => 0,
    'CSRF_token' => 0,
    'register_pass_min' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ee7f1c819f10_72868657')) {function content_52ee7f1c819f10_72868657($_smarty_tpl) {?>
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
",
                register: {
                    pass_min: "<?php echo $_smarty_tpl->tpl_vars['register_pass_min']->value;?>
"
                }
            };
        </script>

        <?php echo $_smarty_tpl->tpl_vars['page']->value['head']['js'];?>


    </head>

    <body>

        <div class="codo_stripe">
            This is codoforum content

        </div>
        <div class='codo_modal_bg'></div>

    

    hey its working <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
!! 


    <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

</body>

</html>
<?php }} ?>
