<?php /* Smarty version Smarty-3.1.16, created on 2014-05-06 08:28:51
         compiled from "/opt/lampp/htdocs/codoforum/admin/layout/templates/users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1124523952c179b56540d6-13670676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a95c842261468ebfa2f8b17484cb07e5cb7f91d9' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/admin/layout/templates/users.tpl',
      1 => 1399357711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1124523952c179b56540d6-13670676',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52c179b568b182_14776926',
  'variables' => 
  array (
    'CSRF' => 0,
    'entered_username' => 0,
    'role_options' => 0,
    'role_selected' => 0,
    'status_options' => 0,
    'status_selected' => 0,
    'sort_url' => 0,
    'users' => 0,
    'user' => 0,
    'pagination_links' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c179b568b182_14776926')) {function content_52c179b568b182_14776926($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/opt/lampp/htdocs/codoforum/sys/Ext/Smarty/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_get_pretty_time')) include '/opt/lampp/htdocs/codoforum/sys/Lib/Smarty/plugins/modifier.get_pretty_time.php';
?>
<div class="row">
    <div class="col-lg-12">

        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-table"></i> Users</li>
        </ol>

    </div>
</div><!-- /.row -->

<div class="row" id="add_cat">
    <div class="col-lg-4"> 
            <div class="well well-lg">
            
                <form action="index.php?page=users" role="form" id="add_user_form" method="post">
               
                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['CSRF']->value;?>
" name="CSRF"/>
                
                <input type="text" name="a_username"  value="" class="form-control" placeholder="Enter Username"  required="required"/>
                <br/>
                <input type="email" name="a_email"  value="" class="form-control" placeholder="Enter Email"  required="required" />
                <br/>
                <input type="password" name="a_password" id="a_password" value="" class="form-control" placeholder="Enter Password" required="required" />
                <br/>
                <input type="password" name="a_repassword" onblur="" id="a_repassword"  value="" class="form-control" placeholder="Re-Enter Password" required="required" />
                <br/>
                <input type="button"  onclick="add_user()" value="Add user" class="btn btn-success" />
                
            </form>
                
                <script>
                var is_form_valid=false;
                $('#add_user_form').submit(function(){
                
                    //return false;
                });
                
                function checkpass(){
                    var p1=$('#a_password').val();
                    var p2=$('#a_repassword').val();
                    
                    if(p1===p2 && p1!==""){
                        
                       is_form_valid=true;
                        
                    }else{
                        
                        alert("Error: Passwords do not match!");
                    }
                    
                }
                
                function add_user(){
                   checkpass(); 
                    
                    if(is_form_valid)
                $('#add_user_form').submit();    
                    
                }
                    
                </script>
            
        </div>
    
    </div>
    
    <div class="col-lg-4">
        <div class="well well-lg">
            
            <form action="index.php" role="form" method="get">
               
                
                <input type="hidden" name="page" value="users" />
                <input type="text" name="username"  value="<?php echo $_smarty_tpl->tpl_vars['entered_username']->value;?>
" class="form-control" placeholder="Enter Username"  />
                <br/>
                <select class="form-control"  name="role">
                   <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['role_options']->value,'selected'=>$_smarty_tpl->tpl_vars['role_selected']->value),$_smarty_tpl);?>

                </select><br/>
                <select  class="form-control" name="status">
                   <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['status_options']->value,'selected'=>$_smarty_tpl->tpl_vars['status_selected']->value),$_smarty_tpl);?>

                </select><br/>
                <input type="submit" value="Search" class="btn btn-success" />
                
            </form>
            
        </div>
    </div>
</div>

<div class="row">
<div class="col-lg-12">
      
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped">
                <thead>
                  <tr>
                      <th><a href="<?php echo $_smarty_tpl->tpl_vars['sort_url']->value;?>
&sort_by=username">Username</a> </th>
                      <th><a href="<?php echo $_smarty_tpl->tpl_vars['sort_url']->value;?>
&sort_by=status">Status</a> </th>
                      <th>Role </th>
                      <th><a href="<?php echo $_smarty_tpl->tpl_vars['sort_url']->value;?>
&sort_by=no_posts">Posts</a> </th>
                      <th><a href="<?php echo $_smarty_tpl->tpl_vars['sort_url']->value;?>
&sort_by=created">Created</a> </th>
                    <th>Option </th>
                  </tr>
                </thead>
                <tbody>
               <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
                  <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['user']->value['user_status']==1) {?>
                        Active
                        <?php } else { ?>
                        Blocked
                        <?php }?>
                    </td>
                    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['role'];?>
</td>
                     <td><?php echo $_smarty_tpl->tpl_vars['user']->value['no_posts'];?>
</td>
                    <td><?php echo smarty_modifier_get_pretty_time($_smarty_tpl->tpl_vars['user']->value['created']);?>
</td>
                    <td><a href="index.php?page=users&action=edit&user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">Edit</a></td>
                  </tr>
               <?php } ?>
                </tbody>
              </table>
            </div>
                <br/>
                <div class="pagination_links">
                <?php echo $_smarty_tpl->tpl_vars['pagination_links']->value;?>

                </div>
</div>
          
</div><?php }} ?>
