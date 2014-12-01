<?php /* Smarty version Smarty-3.1.16, created on 2014-01-05 00:45:29
         compiled from "C:\wamp\www\codoforum\sites\default\themes\default\templates\user\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2403252c8ab2967eee6-16073631%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c174561dd8c15f23c378e714ee501381fbfc4126' => 
    array (
      0 => 'C:\\wamp\\www\\codoforum\\sites\\default\\themes\\default\\templates\\user\\login.tpl',
      1 => 1388873479,
      2 => 'file',
    ),
    '8007d09e56da6cce98fb5b3fdc538250d44b71b2' => 
    array (
      0 => 'C:\\wamp\\www\\codoforum\\sites\\default\\themes\\default\\templates\\layout.tpl',
      1 => 1388882337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2403252c8ab2967eee6-16073631',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'site_title' => 0,
    'page' => 0,
    'CSRF_token' => 0,
    'register_pass_min' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52c8ab297df6d0_81103439',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c8ab297df6d0_81103439')) {function content_52c8ab297df6d0_81103439($_smarty_tpl) {?>
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
                token: "<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
",
                smiley_path: "assets/img/smileys/",
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
        
    <div class="container">

        <div class="row">

            <div class="col-md-6">            
                <label for="username"><?php echo _("username");?>
: </label>
            </div>
            <div class="col-md-6">            
                <input type="text" id="name" maxlength="60"/>
            </div>

        </div>
        <div class="row">

            <div class="col-md-6">            
                <label for="password"><?php echo _("password:");?>
 </label>
            </div>
            <div class="col-md-6">            
                <input type="password" id="pass" maxlength="128"/>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6"><a href="<?php echo @constant('RURI');?>
user/register"><?php echo _("Register");?>
</a></div>
            <div class="col-md-6"><a href="<?php echo @constant('RURI');?>
user/forgot"><?php echo _("I forgot my password");?>
</a></div>

        </div>

        <div class="row">

            <div class="col-md-6"><input id="remember_me" type="checkbox" /></div>
            <div class="col-md-6"><?php echo _("Remember me");?>
</div>

        </div>

        <div class="row">

            <div class="col-md-12">
                <button id="codo_login"><?php echo _("Login");?>
</button>
            </div>
        </div>



    </div>
    <script type="text/javascript">

        jQuery('document').ready(function($) {

            $('#codo_login').on('click', function() {

                $.getJSON(
                        codo_defs.url + 'Ajax/user/login/dologin',
                        {
                            username: $.trim($('#name').val()),
                            password: $.trim($('#pass').val()),
                            remember: $('#remember_me').is(":checked"),
                            token: codo_defs.token
                        },
                function(response) {

                    if (response.msg === "success") {

                        window.location.href = codo_defs.url + 'user/profile';
                    } else {
                        var len = response.length;
                        while (len--) {
                            alert(response[len].msg);
                        }
                    }
                }
                );

            });


        });

    </script>

        
        <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

    </body>

</html>
<?php }} ?>
