<?php /* Smarty version Smarty-3.1.16, created on 2014-06-01 14:30:50
         compiled from "/opt/lampp/htdocs/codoforum/admin/layout/templates/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207275127152c178ff025d23-27235157%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27d1617af8a3e3d4c6cdce26f2bb6193bfed9d80' => 
    array (
      0 => '/opt/lampp/htdocs/codoforum/admin/layout/templates/layout.tpl',
      1 => 1401629447,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207275127152c178ff025d23-27235157',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_52c178ff0642a1_20442099',
  'variables' => 
  array (
    'A_RURI' => 0,
    'active' => 0,
    'A_username' => 0,
    'logged_in' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c178ff0642a1_20442099')) {function content_52c178ff0642a1_20442099($_smarty_tpl) {?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - CODOFORUM</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
css/morris-0.4.3.min.css">
    
    <link rel="shortcut icon" type="image/x-icon" href="http://codoforum.com/img/favicon.ico?v=1">
    <link rel="apple-touch-icon" sizes="57x57" href="http://codoforum.com/img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://codoforum.com/img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://codoforum.com/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://codoforum.com/img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://codoforum.com/img/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://codoforum.com/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://codoforum.com/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://codoforum.com/img/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-196x196.png" sizes="196x196">
    <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="http://codoforum.com/img/favicon-32x32.png" sizes="32x32">
    
    <script src="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
js/jquery-1.10.2.js"></script>
    
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">CF Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="<?php echo $_smarty_tpl->tpl_vars['active']->value['index'];?>
"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li  class="<?php echo $_smarty_tpl->tpl_vars['active']->value['users'];?>
"><a href="index.php?page=users"><i class="fa fa-bar-chart-o"></i> Users</a></li>
            <li  class="<?php echo $_smarty_tpl->tpl_vars['active']->value['categories'];?>
"><a href="index.php?page=categories"><i class="fa fa-table"></i> Categories</a></li>
            <!--<li><a href="forms.html"><i class="fa fa-edit"></i> lllll</a></li>
            <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
            <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap Elements</a></li>-->
            <li  class="<?php echo $_smarty_tpl->tpl_vars['active']->value['config'];?>
"><a href="index.php?page=config"><i class="fa fa-wrench"></i> Global Settings</a></li>
            <li  class="<?php echo $_smarty_tpl->tpl_vars['active']->value['sso'];?>
"><a href="index.php?page=sso"><i class="fa fa-file"></i> SSO Settings</a></li>
            <li  class="<?php echo $_smarty_tpl->tpl_vars['active']->value['importer'];?>
"><a href="index.php?page=importer"><i class="fa fa-file"></i> Importer</a></li>
            
            <<!--li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
                <li><a href="#">Another Item</a></li>
                <li><a href="#">Third Item</a></li>
                <li><a href="#">Last Item</a></li>
              </ul>
            </li>-->
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
              <!--
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">7 New Messages</li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
              </ul>
            </li>
            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li>-->
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php if (isset($_smarty_tpl->tpl_vars['A_username']->value)) {?>
                                                                                                                
                                                                                                            <?php echo $_smarty_tpl->tpl_vars['A_username']->value;?>

                                                                                                    <?php } else { ?>
                                                                                                        Hello
                                                                                                    <?php }?><b class="caret"></b></a>
              <?php if (isset($_smarty_tpl->tpl_vars['logged_in']->value)&&$_smarty_tpl->tpl_vars['logged_in']->value=="yes") {?>
              <ul class="dropdown-menu">
                <li><a href="index.php?page=login&logout=true"><i class="fa fa-user"></i> Logout</a></li>
             
              </ul>
              <?php }?>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>


      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <!--
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
    <script src="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
js/raphael-min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
js/morris-0.4.3.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
js/morris/chart-data-morris.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
js/tablesorter/tables.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['A_RURI']->value;?>
js/Nestable/jquery.nestable.js"></script>


  </body>
</html>
<?php }} ?>
