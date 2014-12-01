
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
               
                <input type="hidden" value="{$CSRF}" name="CSRF"/>
                
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
                <input type="text" name="username"  value="{$entered_username}" class="form-control" placeholder="Enter Username"  />
                <br/>
                <select class="form-control"  name="role">
                   {html_options options=$role_options selected=$role_selected}
                </select><br/>
                <select  class="form-control" name="status">
                   {html_options options=$status_options selected=$status_selected}
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
                      <th><a href="{$sort_url}&sort_by=username">Username</a> </th>
                      <th><a href="{$sort_url}&sort_by=status">Status</a> </th>
                      <th>Role </th>
                      <th><a href="{$sort_url}&sort_by=no_posts">Posts</a> </th>
                      <th><a href="{$sort_url}&sort_by=created">Created</a> </th>
                    <th>Option </th>
                  </tr>
                </thead>
                <tbody>
               {foreach from=$users item=user}
                  <tr>
                    <td>{$user.username}</td>
                    <td>{if $user.user_status eq 1 }
                        Active
                        {else}
                        Blocked
                        {/if}
                    </td>
                    <td>{$user.role}</td>
                     <td>{$user.no_posts}</td>
                    <td>{$user.created|get_pretty_time}</td>
                    <td><a href="index.php?page=users&action=edit&user_id={$user.id}">Edit</a></td>
                  </tr>
               {/foreach}
                </tbody>
              </table>
            </div>
                <br/>
                <div class="pagination_links">
                {$pagination_links}
                </div>
</div>
          
</div>