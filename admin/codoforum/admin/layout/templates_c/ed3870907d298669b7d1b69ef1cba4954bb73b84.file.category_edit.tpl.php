<?php /* Smarty version Smarty-3.1.16, created on 2014-05-05 19:29:29
         compiled from "/opt/lampp/htdocs/codoforum/admin/layout/templates/category_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53284849953650223c60658-83495493%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed3870907d298669b7d1b69ef1cba4954bb73b84' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/admin/layout/templates/category_edit.tpl',
      1 => 1399310966,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53284849953650223c60658-83495493',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53650223cd9283_69158993',
  'variables' => 
  array (
    'msg' => 0,
    'err' => 0,
    'cat_id' => 0,
    'cat' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53650223cd9283_69158993')) {function content_53650223cd9283_69158993($_smarty_tpl) {?>
<div class="row">
    <div class="col-lg-12">

        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-table"></i> Edit Category</li>
        </ol>

    </div>
</div><!-- /.row -->


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






<br/>

<div class="row" id="add_cat" style="">
    <div class="col-lg-6">
        <div class="well well-lg">
            <form action="?page=categories&action=edit&cat_id=<?php echo $_smarty_tpl->tpl_vars['cat_id']->value;?>
" role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" value="edit" name="mode"/>
                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['cat_id']->value;?>
" name="id"/>
                <input type="text" name="cat_name"  value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_name'];?>
" class="form-control" placeholder="Category name" required />
                <br/>
                
                Category Image(Upload a new one to change it):<br/>
                <img width="200px" draggable="false" src="<?php echo @constant('A_DURI');?>
<?php echo @constant('CAT_IMGS');?>
<?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_img'];?>
" />
                <br>
                <input type="file" name="cat_img" class="form-control"   />
                <br/>
                <textarea name="cat_description" placeholder="Category Description" class="form-control" ><?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_description'];?>
</textarea>
                <br/>

                <input type="submit" value="Save" class="btn btn-success" />
                <a href="index.php?page=categories" class="btn btn-default">Back</a>

            </form>
        </div>
    </div>

</div>
<br/><?php }} ?>
