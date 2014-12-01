<?php /* Smarty version Smarty-3.1.16, created on 2014-05-15 19:27:21
         compiled from "/opt/lampp/htdocs/codoforum/admin/layout/templates/categories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:97705362252ca6ec42a8057-08941058%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb6f2ca627ec4046be745c44f02d03ecf5dc7531' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/admin/layout/templates/categories.tpl',
      1 => 1400178415,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97705362252ca6ec42a8057-08941058',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52ca6ec432bce3_16604979',
  'variables' => 
  array (
    'msg' => 0,
    'err' => 0,
    'cats' => 0,
    'CSRF' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ca6ec432bce3_16604979')) {function content_52ca6ec432bce3_16604979($_smarty_tpl) {?>
<div class="row">
    <div class="col-lg-12">

        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-table"></i> Categories</li>
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


<div class="row" id="add_cat_btn">
    <div class="col-lg-6">
        <button class="btn btn-success" onclick="$('#add_cat').show();
                $('#add_cat_btn').hide()">+Add Category</button>
    </div>
</div>




<br/>

<div class="row" id="add_cat" style="display: none">
    <div class="col-lg-6">
        <div class="well well-lg">
            <form action="?page=categories" role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" value="new" name="mode"/>
                <input type="text" name="cat_name"  value="" class="form-control" placeholder="Category name" required />
                <br/>
                Category Image:<br/>
                <input type="file" name="cat_img" class="form-control"  required />
                <br/>
                <textarea name="cat_description" placeholder="Category Description" class="form-control" required ></textarea>
                <br/>

                <input type="submit" value="Save" class="btn btn-success" />
                <span class="btn btn-warning"  onclick="$('#add_cat_btn').show();
                        $('#add_cat').hide()">Cancel</span>

            </form>
        </div>
    </div>

</div>
<br/>
<hr/>
<div class="row">

    <div class="col-lg-12">

        <?php echo $_smarty_tpl->tpl_vars['cats']->value;?>


    </div>
</div><!-- /.row -->
<br/>
<br/>
<div class="row">
    <div class="col-lg-4">
        <button value="Save" class="btn btn-primary" id="save_order_btn" onclick="save_order()">Save Order</button>
    </div>
</div>
<style type="text/css">

    .dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

    .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
    .dd-list .dd-list { padding-left: 30px; }
    .dd-collapsed .dd-list { display: none; }

    .dd-item,
    .dd-empty,
    .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

    .dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
                 background: #fafafa;
                 background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
                 background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
                 background:         linear-gradient(top, #fafafa 0%, #eee 100%);
                 -webkit-border-radius: 3px;
                 border-radius: 3px;
                 box-sizing: border-box; -moz-box-sizing: border-box;
    }
    .dd-handle:hover { color: #2ea8e5; background: #fff; }

    .dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
    .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
    .dd-item > button[data-action="collapse"]:before { content: '-'; }

    .dd-placeholder,
    .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
    .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
                background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                    -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), 
                    linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
                background-size: 60px 60px;
                background-position: 0 0, 30px 30px;
    }

    .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
    .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
    .dd-dragel .dd-handle {
        -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
        box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
    }

    /**
     * Nestable Draggable Handles
     */

    .dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
                   background: #fafafa;
                   background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
                   background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
                   background:         linear-gradient(top, #fafafa 0%, #eee 100%);
                   -webkit-border-radius: 3px;
                   border-radius: 3px;
                   box-sizing: border-box; -moz-box-sizing: border-box;
    }
    .dd3-content:hover { color: #2ea8e5; background: #fff; }

    .dd-dragel > .dd3-item > .dd3-content { margin: 0; }

    .dd3-item > button { margin-left: 30px; }

    .dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
                  border: 1px solid #aaa;
                  background: #ddd;
                  background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
                  background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
                  background:         linear-gradient(top, #ddd 0%, #bbb 100%);
                  border-top-right-radius: 0;
                  border-bottom-right-radius: 0;
    }
    .dd3-handle:before { content: '\02261'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
    .dd3-handle:hover { background: #ddd; }
</style>


<form id="delete_cat_form" method="post" action="index.php?page=categories&action=delete">
    <input type="hidden" id="CSRF_TOKEN" value="<?php echo $_smarty_tpl->tpl_vars['CSRF']->value;?>
" name="CSRF_TOKEN"/>
    <input type="hidden" id="del_cat_id" name="del_cat_id" value=""/>
</form>
<script>
    window.onload = function() {
        console.log('s')
        jQuery('.dd').nestable({ /* config options */});
    };


    function save_order() {
        var d = jQuery('.dd').nestable('serialize');
        d = JSON.stringify(d);
        $('#save_order_btn').html('Saving.......');
        $.post('?page=categories&action=reorder', { data: d }, function(data) {

            //console.log(data);
            $('#save_order_btn').html('Save Order');
            alert('order saved!');
        });

    }

    function delete_cat(id) {


        var r = confirm("Are you sure, you want to delete?");
        if (r === true)
        {

            $('#del_cat_id').val(id + '');
            $('#delete_cat_form').submit();

        }
        else
        {
            return;
        }

    }


</script><?php }} ?>
