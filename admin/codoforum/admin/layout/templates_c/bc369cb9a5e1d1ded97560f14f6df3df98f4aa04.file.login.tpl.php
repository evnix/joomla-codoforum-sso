<?php /* Smarty version Smarty-3.1.16, created on 2014-01-06 09:03:46
         compiled from "/opt/lampp/htdocs/codoforum/admin/layout/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173893034252ca63624bf462-51883856%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc369cb9a5e1d1ded97560f14f6df3df98f4aa04' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/admin/layout/templates/login.tpl',
      1 => 1388314316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173893034252ca63624bf462-51883856',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52ca6362597580_57099776',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ca6362597580_57099776')) {function content_52ca6362597580_57099776($_smarty_tpl) {?><div class="row">
    <div class="col-lg-12">

        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-table"></i> Login</li>
        </ol>

    </div>
</div>



<div class="row" id="msg_cntnr">
    <div class="col-lg-4"><!-- just an empty tag so that the next div looks centeres--> </div>
    <div class="col-lg-4">
        <?php if ($_smarty_tpl->tpl_vars['msg']->value=='') {?>

        <?php } else { ?>
            <div class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
        <?php }?>

    </div>
</div>
<br/>


<div class="row" id="add_cat">
    <div class="col-lg-4"><!-- just an empty tag so that the next div looks centeres--> </div>
    
    <div class="col-lg-4">
        <div class="well well-lg">
            <form action="?page=login" role="form" method="post" enctype="multipart/form-data">
               
                <input type="text" name="username"  value="" class="form-control" placeholder="Username" required />
                <br/>
                <input type="password" name="password"  value="" class="form-control" placeholder="Password" required />
                <br/>
                <input type="submit" value="Login" class="btn btn-success" />

            </form>
        </div>
    </div>

</div><?php }} ?>
