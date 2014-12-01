
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
        {if $msg eq ""}

        {elseif $err==1}
            <div class="alert alert-danger">{$msg}</div>
        {else}   
            <div class="alert alert-success">{$msg}</div>
        {/if}

    </div>
</div>

<br/>

<div class="row" id="add_cat" style="">
    <div class="col-lg-6">
        <div class="well well-lg">
            <form action="?page=users&action=edit&user_id={$user.id}" role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" value="edit" name="mode"/>
                
                <input type="hidden" value="{$user.id}" name="id"/>
                Username:<br>
                <input type="text" name="user_name"  value="{$user.username}" class="form-control" placeholder="" required />
                <br/>
                
                Display name:<br>
                <input type="text" name="display_name"  value="{$user.name}" class="form-control" placeholder="" required />
                <br/>

                Email:<br>
                <input type="text" name="email"  value="{$user.mail}" class="form-control" placeholder="" required />
                <br/>                
                
                Role:<br>
             <select class="form-control"  name="role">
                   {html_options options=$role_options selected=$role_selected}
                </select><br/>
                
                Password (type a pass only if you want to change it):<br>
                <input type="password" name="p1"  value="" class="form-control" placeholder=""  />
                <br/>
                Password Again: (type the same as above)<br>
                <input type="password" name="p2"  value="" class="form-control" placeholder=""  />
                <br/>                
                
                               
                
                
                Category Image(Upload a new one to change it):<br/>
                <img width="200px" draggable="false" src="{$user.avatar}" />
                <br>
                <input type="file" name="user_img" class="form-control"   />
                <br/>
                Signature:<br>
                <textarea name="signature" placeholder="Category Description" class="form-control" >{$user.signature}</textarea>
                <br/>

                <input type="submit" value="Save" class="btn btn-success" />
                <a href="index.php?page=users" class="btn btn-default">Back</a>

            </form>
        </div>
    </div>

</div>
