<?php /* Smarty version Smarty-3.1.16, created on 2014-05-10 15:33:15
         compiled from "/opt/lampp/htdocs/codoforum/admin/layout/templates/sso.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1517551771536e2a681ed179-91012201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd62fd282fa1a3ce4a368c4058f57121e9a16ae3' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/admin/layout/templates/sso.tpl',
      1 => 1399728785,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1517551771536e2a681ed179-91012201',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_536e2a68248e86_54597949',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_536e2a68248e86_54597949')) {function content_536e2a68248e86_54597949($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_opt')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.get_opt.php';
?><div class="col-md-6">
<form  action="?page=sso" role="form" method="post" enctype="multipart/form-data">


SSO Name:
<input type="text" class="form-control" name="sso_name" value="<?php echo smarty_modifier_get_opt("sso_name");?>
" /><br/>
 
SSO Client ID:
<input type="text" class="form-control" name="sso_client_id" value="<?php echo smarty_modifier_get_opt("sso_client_id");?>
" /><br/>

SSO Secret:
<input type="text" class="form-control" name="sso_secret" value="<?php echo smarty_modifier_get_opt("sso_secret");?>
" /><br/>

SSO Get User Path:
<input type="text" class="form-control" name="sso_get_user_path" value="<?php echo smarty_modifier_get_opt("sso_get_user_path");?>
" /><br/>

SSO Login User Path:
<input type="text" class="form-control" name="sso_login_user_path" value="<?php echo smarty_modifier_get_opt("sso_login_user_path");?>
" /><br/>

SSO Logout User Path:
<input type="text" class="form-control" name="sso_logout_user_path" value="<?php echo smarty_modifier_get_opt("sso_logout_user_path");?>
" /><br/>

SSO Register User Path:
<input type="text" class="form-control" name="sso_register_user_path" value="<?php echo smarty_modifier_get_opt("sso_register_user_path");?>
" /><br/>



<input type="submit" value="Save" class="btn btn-primary"/>
</form>
<br/>
<br/>
</div><?php }} ?>
