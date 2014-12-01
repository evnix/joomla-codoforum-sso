<?php /* Smarty version Smarty-3.1.16, created on 2014-05-10 15:20:29
         compiled from "/opt/lampp/htdocs/codoforum/admin/layout/templates/config.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14566935515311caf6244c32-59221765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54c069a25bef2bacf20aa7d13badeb51babb54dc' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/admin/layout/templates/config.tpl',
      1 => 1399728024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14566935515311caf6244c32-59221765',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5311caf6278b43_80994736',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5311caf6278b43_80994736')) {function content_5311caf6278b43_80994736($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_opt')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.get_opt.php';
?><div class="col-md-6">
<form  action="?page=config" role="form" method="post" enctype="multipart/form-data">
<!--
    Site URL: 
<input type="text" class="form-control" name="site_url" value="<?php echo smarty_modifier_get_opt("site_url");?>
" /><br/>
-->

Site Title:
<input type="text" class="form-control" name="site_title" value="<?php echo smarty_modifier_get_opt("site_title");?>
" /><br/>
 
Site Description:
<input type="text" class="form-control" name="site_description" value="<?php echo smarty_modifier_get_opt("site_description");?>
" /><br/>

Admin Email:
<input type="text" class="form-control" name="admin_email" value="<?php echo smarty_modifier_get_opt("admin_email");?>
" /><br/>

Theme:
<input type="text" class="form-control" name="theme" value="<?php echo smarty_modifier_get_opt("theme");?>
" /><br/>
<!--
Captcha Public Key:
<input type="text" class="form-control" name="captcha_public_key" value="<?php echo smarty_modifier_get_opt("captcha_public_key");?>
" /><br/>

Captcha Private Key:
<input type="text" class="form-control" name="captcha_private_key" value="<?php echo smarty_modifier_get_opt("captcha_private_key");?>
" /><br/>
-->
Password Min Length:
<input type="text" class="form-control" name="register_pass_min" value="<?php echo smarty_modifier_get_opt("register_pass_min");?>
" /><br/>

Num of posts(All topics Page):
<input type="text" class="form-control" name="num_posts_all_topics" value="<?php echo smarty_modifier_get_opt("num_posts_all_topics");?>
" /><br/>

Num of posts(while viewing a category):
<input type="text" class="form-control" name="num_posts_cat_topics" value="<?php echo smarty_modifier_get_opt("num_posts_cat_topics");?>
" /><br/>

Num of posts(While viewing a topic)
<input type="text" class="form-control" name="num_posts_per_topic" value="<?php echo smarty_modifier_get_opt("num_posts_per_topic");?>
" /><br/>

Forum attachment path:
<input type="text" class="form-control" name="forum_attachments_path" value="<?php echo smarty_modifier_get_opt("forum_attachments_path");?>
" /><br/>

Allowed Upload types(comma separated):
<input type="text" class="form-control" name="forum_attachments_exts" value="<?php echo smarty_modifier_get_opt("forum_attachments_exts");?>
" /><br/>

Max Upload size(MB):
<input type="text" class="form-control" name="forum_attachments_size" value="<?php echo smarty_modifier_get_opt("forum_attachments_size");?>
" /><br/>

Allowed Mimetypes:
<input type="text" class="form-control" name="forum_attachments_mimetypes" value="<?php echo smarty_modifier_get_opt("forum_attachments_mimetypes");?>
" /><br/>

<!--
<input type="text" class="form-control" name="forum_attachments_multiple" value="<?php echo smarty_modifier_get_opt("forum_attachments_mimetypes");?>
" /><br/>

<input type="text" class="form-control" name="forum_attachments_parallel" value="<?php echo smarty_modifier_get_opt("forum_attachments_mimetypes");?>
" /><br/>
<input type="text" class="form-control" name="forum_attachments_max" value="<?php echo smarty_modifier_get_opt("forum_attachments_mimetypes");?>
" /><br/>
-->
Min characters for a post:
<input type="text" class="form-control" name="reply_min_chars" value="<?php echo smarty_modifier_get_opt("reply_min_chars");?>
" /><br/>

Sub-Category Dropdown:
<!--<input type="text" class="form-control" name="subcategory_dropdown" value="<?php echo smarty_modifier_get_opt("subcategory_dropdown");?>
" /><br/>
-->
<select name="subcategory_dropdown" class="form-control">
    <option value="shown" <?php if (smarty_modifier_get_opt("subcategory_dropdown")=='shown') {?> selected <?php }?>>Shown</option>
    <option value="hidden"  <?php if (smarty_modifier_get_opt("subcategory_dropdown")=='hidden') {?> selected <?php }?> >Hidden</option>
</select><br/>

<!--
Captcha:
<input type="text" class="form-control" name="captcha" value="<?php echo smarty_modifier_get_opt("captcha");?>
" /><br/>
-->
Await Approval Subject:
<input type="text" class="form-control" name="await_approval_subject" value="<?php echo smarty_modifier_get_opt("await_approval_subject");?>
"/><br/>
Await Approval Message:
<textarea class="form-control" style="height:200px" name="await_approval_message"><?php echo smarty_modifier_get_opt("await_approval_message");?>
</textarea><br/>

Post Notify Subject:
<input type="text" class="form-control" name="post_notify_subject" value="<?php echo smarty_modifier_get_opt("post_notify_subject");?>
"/><br/>
Post Notify Message:
<textarea class="form-control" style="height:200px" name="post_notify_message"><?php echo smarty_modifier_get_opt("post_notify_message");?>
</textarea><br/>



Mail Type:


<select name='smtp_protocol' class="form-control">
    <option value='smtp' <?php if (smarty_modifier_get_opt("mail_type")=='smtp') {?> selected <?php }?>>SMTP</option>
    <option value='mail'  <?php if (smarty_modifier_get_opt("mail_type")=='mail') {?> selected <?php }?>>mail()</option>
    
</select><br>

SMTP Protocol:
<input type="text" class="form-control" name="smtp_protocol" value="<?php echo smarty_modifier_get_opt("smtp_protocol");?>
" />

<br/>

SMTP Server:
<input type="text" class="form-control" name="smtp_server" value="<?php echo smarty_modifier_get_opt("smtp_server");?>
" /><br/>

SMTP Port:
<input type="text" class="form-control" name="smtp_port" value="<?php echo smarty_modifier_get_opt("smtp_port");?>
" /><br/>

SMTP username:
<input type="text" class="form-control" name="smtp_username" value="<?php echo smarty_modifier_get_opt("smtp_username");?>
" /><br/>

SMTP Password:
<input type="text" class="form-control" name="smtp_password" value="<?php echo smarty_modifier_get_opt("smtp_password");?>
" /><br/>




<input type="submit" value="Save" class="btn btn-primary"/>
</form>
<br/>
<br/>
</div><?php }} ?>
