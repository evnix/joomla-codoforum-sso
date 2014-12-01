<div class="col-md-6">
<form  action="?page=config" role="form" method="post" enctype="multipart/form-data">
<!--
    Site URL: 
<input type="text" class="form-control" name="site_url" value="{"site_url"|get_opt}" /><br/>
-->

Site Title:
<input type="text" class="form-control" name="site_title" value="{"site_title"|get_opt}" /><br/>
 
Site Description:
<input type="text" class="form-control" name="site_description" value="{"site_description"|get_opt}" /><br/>

Admin Email:
<input type="text" class="form-control" name="admin_email" value="{"admin_email"|get_opt}" /><br/>

Theme:
<input type="text" class="form-control" name="theme" value="{"theme"|get_opt}" /><br/>
<!--
Captcha Public Key:
<input type="text" class="form-control" name="captcha_public_key" value="{"captcha_public_key"|get_opt}" /><br/>

Captcha Private Key:
<input type="text" class="form-control" name="captcha_private_key" value="{"captcha_private_key"|get_opt}" /><br/>
-->
Password Min Length:
<input type="text" class="form-control" name="register_pass_min" value="{"register_pass_min"|get_opt}" /><br/>

Num of posts(All topics Page):
<input type="text" class="form-control" name="num_posts_all_topics" value="{"num_posts_all_topics"|get_opt}" /><br/>

Num of posts(while viewing a category):
<input type="text" class="form-control" name="num_posts_cat_topics" value="{"num_posts_cat_topics"|get_opt}" /><br/>

Num of posts(While viewing a topic)
<input type="text" class="form-control" name="num_posts_per_topic" value="{"num_posts_per_topic"|get_opt}" /><br/>

Forum attachment path:
<input type="text" class="form-control" name="forum_attachments_path" value="{"forum_attachments_path"|get_opt}" /><br/>

Allowed Upload types(comma separated):
<input type="text" class="form-control" name="forum_attachments_exts" value="{"forum_attachments_exts"|get_opt}" /><br/>

Max Upload size(MB):
<input type="text" class="form-control" name="forum_attachments_size" value="{"forum_attachments_size"|get_opt}" /><br/>

Allowed Mimetypes:
<input type="text" class="form-control" name="forum_attachments_mimetypes" value="{"forum_attachments_mimetypes"|get_opt}" /><br/>

<!--
<input type="text" class="form-control" name="forum_attachments_multiple" value="{"forum_attachments_mimetypes"|get_opt}" /><br/>

<input type="text" class="form-control" name="forum_attachments_parallel" value="{"forum_attachments_mimetypes"|get_opt}" /><br/>
<input type="text" class="form-control" name="forum_attachments_max" value="{"forum_attachments_mimetypes"|get_opt}" /><br/>
-->
Min characters for a post:
<input type="text" class="form-control" name="reply_min_chars" value="{"reply_min_chars"|get_opt}" /><br/>

Sub-Category Dropdown:
<!--<input type="text" class="form-control" name="subcategory_dropdown" value="{"subcategory_dropdown"|get_opt}" /><br/>
-->
<select name="subcategory_dropdown" class="form-control">
    <option value="shown" {if "subcategory_dropdown"|get_opt == 'shown' } selected {/if}>Shown</option>
    <option value="hidden"  {if "subcategory_dropdown"|get_opt == 'hidden' } selected {/if} >Hidden</option>
</select><br/>

<!--
Captcha:
<input type="text" class="form-control" name="captcha" value="{"captcha"|get_opt}" /><br/>
-->
Await Approval Subject:
<input type="text" class="form-control" name="await_approval_subject" value="{"await_approval_subject"|get_opt}"/><br/>
Await Approval Message:
<textarea class="form-control" style="height:200px" name="await_approval_message">{"await_approval_message"|get_opt}</textarea><br/>

Post Notify Subject:
<input type="text" class="form-control" name="post_notify_subject" value="{"post_notify_subject"|get_opt}"/><br/>
Post Notify Message:
<textarea class="form-control" style="height:200px" name="post_notify_message">{"post_notify_message"|get_opt}</textarea><br/>



Mail Type:


<select name='smtp_protocol' class="form-control">
    <option value='smtp' {if "mail_type"|get_opt == 'smtp' } selected {/if}>SMTP</option>
    <option value='mail'  {if "mail_type"|get_opt == 'mail' } selected {/if}>mail()</option>
    
</select><br>

SMTP Protocol:
<input type="text" class="form-control" name="smtp_protocol" value="{"smtp_protocol"|get_opt}" />

<br/>

SMTP Server:
<input type="text" class="form-control" name="smtp_server" value="{"smtp_server"|get_opt}" /><br/>

SMTP Port:
<input type="text" class="form-control" name="smtp_port" value="{"smtp_port"|get_opt}" /><br/>

SMTP username:
<input type="text" class="form-control" name="smtp_username" value="{"smtp_username"|get_opt}" /><br/>

SMTP Password:
<input type="text" class="form-control" name="smtp_password" value="{"smtp_password"|get_opt}" /><br/>




<input type="submit" value="Save" class="btn btn-primary"/>
</form>
<br/>
<br/>
</div>