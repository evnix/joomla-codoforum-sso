<?php /* Smarty version Smarty-3.1.16, created on 2014-05-06 10:20:22
         compiled from "/opt/lampp/htdocs/codoforum/admin/layout/templates/user_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10370232685368830fd5d5f6-94036171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3f630aabeb31710eae6eec680f20740289234d6' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/admin/layout/templates/user_edit.tpl',
      1 => 1399364420,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10370232685368830fd5d5f6-94036171',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5368830fdaf329_29139788',
  'variables' => 
  array (
    'msg' => 0,
    'err' => 0,
    'user' => 0,
    'role_options' => 0,
    'role_selected' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5368830fdaf329_29139788')) {function content_5368830fdaf329_29139788($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/opt/lampp/htdocs/codoforum/sys/Ext/Smarty/plugins/function.html_options.php';
?>
<div class="row">
    <div class="col-lg-12">

        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-table"></i> Edit User</li>
        </ol>

    </div>
    
</div><!-- /.row -->


<br>
<div class="row" id="msg_cntnr">
    <div class="col-lg-6">
        <?php if ($_smarty_tpl->tpl_vars['msg']->value=='') {?>

        <?php } elseif ($_smarty_tpl->tpl_vars['err']->value==1) {?>
            <div class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
        <?php } else { ?>   
            <div class="alert alert-success"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
        <?php }?>

    </div>
</div>

<br/>

<div class="row" id="add_cat" style="">
    <div class="col-lg-6">
        <div class="well well-lg">
            <form action="?page=users&action=edit&user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" value="edit" name="mode"/>
                
                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" name="id"/>
                Username:<br>
                <input type="text" name="user_name"  value="<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
" class="form-control" placeholder="" required />
                <br/>
                
                Display name:<br>
                <input type="text" name="display_name"  value="<?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
" class="form-control" placeholder="" required />
                <br/>

                Email:<br>
                <input type="text" name="email"  value="<?php echo $_smarty_tpl->tpl_vars['user']->value['mail'];?>
" class="form-control" placeholder="" required />
                <br/>                
                
                Role:<br>
             <select class="form-control"  name="role">
                   <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['role_options']->value,'selected'=>$_smarty_tpl->tpl_vars['role_selected']->value),$_smarty_tpl);?>

                </select><br/>
                
                Password (type a pass only if you want to change it):<br>
                <input type="password" name="p1"  value="" class="form-control" placeholder=""  />
                <br/>
                Password Again: (type the same as above)<br>
                <input type="password" name="p2"  value="" class="form-control" placeholder=""  />
                <br/>                
                
                               
                
                
                Category Image(Upload a new one to change it):<br/>
                <img width="200px" draggable="false" src="<?php echo $_smarty_tpl->tpl_vars['user']->value['avatar'];?>
" />
                <br>
                <input type="file" name="user_img" class="form-control"   />
                <br/>
                Signature:<br>
                <textarea name="signature" placeholder="Category Description" class="form-control" ><?php echo $_smarty_tpl->tpl_vars['user']->value['signature'];?>
</textarea>
                <br/>

                <input type="submit" value="Save" class="btn btn-success" />
                <a href="index.php?page=users" class="btn btn-default">Back</a>

            </form>
        </div>
    </div>

</div>
<?php }} ?>
