
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
        {if $msg eq ""}

        {elseif $err==1}
            <div class="alert alert-danger">{$msg}</div>
        {else}   
            <div class="alert alert-success">{$msg}</div>
        {/if}

    </div>
</div>
<br/>






<br/>

<div class="row" id="add_cat" style="">
    <div class="col-lg-6">
        <div class="well well-lg">
            <form action="?page=categories&action=edit&cat_id={$cat_id}" role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" value="edit" name="mode"/>
                <input type="hidden" value="{$cat_id}" name="id"/>
                <input type="text" name="cat_name"  value="{$cat.cat_name}" class="form-control" placeholder="Category name" required />
                <br/>
                
                Category Image(Upload a new one to change it):<br/>
                <img width="200px" draggable="false" src="{$smarty.const.A_DURI}{$smarty.const.CAT_IMGS}{$cat.cat_img}" />
                <br>
                <input type="file" name="cat_img" class="form-control"   />
                <br/>
                <textarea name="cat_description" placeholder="Category Description" class="form-control" >{$cat.cat_description}</textarea>
                <br/>

                <input type="submit" value="Save" class="btn btn-success" />
                <a href="index.php?page=categories" class="btn btn-default">Back</a>

            </form>
        </div>
    </div>

</div>
<br/>