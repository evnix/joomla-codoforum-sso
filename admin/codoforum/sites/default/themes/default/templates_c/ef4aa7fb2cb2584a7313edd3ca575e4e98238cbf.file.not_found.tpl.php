<?php /* Smarty version Smarty-3.1.16, created on 2014-01-05 07:10:34
         compiled from "C:\wamp\www\codoforum\sites\default\themes\default\templates\not_found.tpl" */ ?>
<?php /*%%SmartyHeaderCode:857252c89b724ac622-01822779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef4aa7fb2cb2584a7313edd3ca575e4e98238cbf' => 
    array (
      0 => 'C:\\wamp\\www\\codoforum\\sites\\default\\themes\\default\\templates\\not_found.tpl',
      1 => 1388873479,
      2 => 'file',
    ),
    '8007d09e56da6cce98fb5b3fdc538250d44b71b2' => 
    array (
      0 => 'C:\\wamp\\www\\codoforum\\sites\\default\\themes\\default\\templates\\layout.tpl',
      1 => 1388905711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '857252c89b724ac622-01822779',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52c89b7258a962_71980188',
  'variables' => 
  array (
    'site_title' => 0,
    'page' => 0,
    'CSRF_token' => 0,
    'register_pass_min' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c89b7258a962_71980188')) {function content_52c89b7258a962_71980188($_smarty_tpl) {?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        
        <base href="<?php echo @constant('RURI');?>
">
        
        
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

        
    Really not found

        
        <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

    </body>

</html>
<?php }} ?>
