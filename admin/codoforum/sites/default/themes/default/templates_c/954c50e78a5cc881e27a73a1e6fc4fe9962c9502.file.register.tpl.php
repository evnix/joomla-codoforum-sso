<?php /* Smarty version Smarty-3.1.16, created on 2014-02-13 16:07:08
         compiled from "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/user/register.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181461333352f4c95e75ee65-55077548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '954c50e78a5cc881e27a73a1e6fc4fe9962c9502' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/user/register.tpl',
      1 => 1392304025,
      2 => 'file',
    ),
    'e19a14c9e0a1d8063627a23a68a2a861b04ad7e9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/themes/default/templates/layout.tpl',
      1 => 1392303945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181461333352f4c95e75ee65-55077548',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52f4c95e8e6681_48593235',
  'variables' => 
  array (
    'site_title' => 0,
    'page' => 0,
    'CSRF_token' => 0,
    'site_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52f4c95e8e6681_48593235')) {function content_52f4c95e8e6681_48593235($_smarty_tpl) {?>
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


        <style type="text/css">

            .navbar {

                border-radius: 0;

            }
            .navbar-clean {

                background: white;
                box-shadow: 0 1px 5px #cccccc;
            }
            .nav > li > a:hover, .nav > li > a:focus {

                background: white;
                color: #1471af;
            }

            .nav > li > a {

                color: #3794db;

            }

            .navbar-clean .container-fluid {

                padding-left: 20px;
                padding-right: 30px;
            }

            .codo_forum_title {

                font-family: Oswald, Helvetica;
                color: #333 !important;

            }

            .codo_forum_title:hover {
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;  
            }

        </style>

    </head>

    <body>


        <nav class="navbar navbar-clean" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand codo_forum_title" href="<?php echo @constant('RURI');?>
<?php echo $_smarty_tpl->tpl_vars['site_url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="<?php echo @constant('RURI');?>
user/register"><?php echo _("Register");?>
</a></li>
                        <li><a href="<?php echo @constant('RURI');?>
user/login"><?php echo _("Login");?>
</a></li>
                    </ul>                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class='codo_modal_bg'></div>

    

    <style type="text/css">

        .container {

            margin-top: 10px;
            background: white;
            box-shadow: 1px 1px 5px #ccc;
        }

        .codo_reg_error {
            position: absolute;
            background: #d14836;
            border: 1px solid #d14836;
            color: white;
            padding: 5px;
            border-radius: 1px;
            display: none;
        }

        .codo_reg_error_block .codo_reg_error {

            position: static;
            display: block;

        }

        #password {

            padding-right: 27px;
        }

        #codo_reg_pass { 
            position: relative;
        }
        #letterViewer { 
            position: absolute;
            left: 228px;
            top: 0;
            width: 100px;
            font: bold 30px Helvetica, Sans-Serif;
        }  

        .codo_already_registered {

            color: #585858;
            display: inline-block;
            margin-left: 4px;
        }
    </style>

    <div class="container">

        <?php if (!empty($_smarty_tpl->tpl_vars['errors']->value)) {?>
            <div class="codo_reg_error_block">
                <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
                    <div class='codo_reg_error'> <?php echo $_smarty_tpl->tpl_vars['error']->value;?>
 </div>

                <?php } ?>
            </div>
        <?php }?>

        <form id="codo_register_form" action="<?php echo @constant('RURI');?>
user/register" method="POST" >
            <div class="row">

                <div class="col-md-6">            
                    <input data-length="<?php echo $_smarty_tpl->tpl_vars['min_username_len']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['register']->value->username;?>
" class="codo_input" id="reg_username" type="text" name="username" placeholder="<?php echo _("username");?>
" required/>
                    <div class="codo_reg_error"></div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-6">          
                    <div id="codo_reg_pass">
                        <input data-length="<?php echo $_smarty_tpl->tpl_vars['min_pass_len']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['register']->value->password;?>
" class="codo_input" id="password" type="password" name="password" placeholder="<?php echo _("password");?>
" required/>
                        <div class="codo_reg_error"></div>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">            
                    <input value="<?php echo $_smarty_tpl->tpl_vars['register']->value->mail;?>
" class="codo_input" type="email" id="reg_mail" name="mail" placeholder="<?php echo _("email");?>
" required=""/>
                    <div class="codo_reg_error"></div>                
                </div>

            </div>

            <?php if (isset($_smarty_tpl->tpl_vars['recaptcha']->value)) {?>        
                <div class="row col-md-12">

                    <?php echo $_smarty_tpl->tpl_vars['recaptcha']->value;?>

                </div>
            <?php }?>

            <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
" />
            <div class="row">

                <div class="col-md-12">
                    <button class="codo_btn codo_btn_primary" id="codo_register"><?php echo _("Register");?>
</button>
                    <div class="codo_already_registered">
                        <?php echo _("Already registered?");?>
 <a  class="codo_login_register_link" href="<?php echo @constant('RURI');?>
user/login"><?php echo _("Login here");?>
</a>      
                    </div>
                </div>
            </div>

        </form>

    </div>

    <script type="text/javascript">

        codo_defs.register = {
            pass_min: parseInt('<?php echo $_smarty_tpl->tpl_vars['min_pass_len']->value;?>
'),
            username_min: parseInt('<?php echo $_smarty_tpl->tpl_vars['min_username_len']->value;?>
')
        };

        CODOF.pass = {
            trans: {
                username_short: '<?php echo _("username cannot be less than ");?>
' + codo_defs.register.username_min + '<?php echo _(" characters");?>
',
                username_exists: '<?php echo _("username already exists");?>
',
                password_short: '<?php echo _("passowrd cannot be less than ");?>
' + codo_defs.register.pass_min + '<?php echo _(" characters");?>
',
                mail_exists: '<?php echo _("mail already exists");?>
'

            }
        }

    </script>

    <!-- could have placed inline , but this looks better -->
    <script type="text/javascript" src="<?php echo @constant('DURI');?>
assets/js/user/register.js"></script>


    <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

</body>

</html>
<?php }} ?>
