<?php

/*
 * @CODOLICENSE
 */

$smarty = \Lib\Smarty\Single::get_instance();

$db = Lib\DB::get_db();
if (isset($_GET['import'])) {

    $_DB = array(
        'DSN' => 'mysql:host=' . $_GET['db_host'] . ';port=3306;dbname=' . $_GET['db_name'],
        'user' => $_GET['db_user'],
        'pass' => $_GET['db_pass'],
        'prefix' => $_GET['tbl_prefix']
    );


    $work = new \Lib\Importer\ImportWorker($_DB, $_GET['import_from']);

    $work->max_rows = (int) $_GET['max_rows'];
    $work->import_admin_mail = $_GET['admin_mail'];
    $work->connect_db();

    $is_admin = $work->isset_admin_account();

    if ($work->connected && $is_admin) {

        $total = 0;

        $time = microtime(true);
        $work->import_cats();
        echo "Categories imported in : ";
        $diff = microtime(true) - $time;
        echo $diff;
        $total += $diff;

        $time = microtime(true);
        $work->import_posts();
        echo "<br/>posts imported in : ";
        $diff = microtime(true) - $time;
        echo $diff;
        $total += $diff;

        $time = microtime(true);
        $work->import_topics();
        echo "<br/>topics imported in : ";
        $diff = microtime(true) - $time;
        echo $diff;
        $total += $diff;


        $time = microtime(true);
        $work->import_users();
        echo "<br/>users imported in : ";
        $diff = microtime(true) - $time;
        echo $diff;
        $total += $diff;
        
        /*$time = microtime(true);
        new \Lib\Importer\Concise();
        echo "<br/>updating all counts : ";
        $diff = microtime(true) - $time;
        echo $diff;
        $total += $diff;
        */

        echo "<br/>import successfull in total time " . $total . " s";
    } else if (!$is_admin) {

        echo "admin e-mail address given does not exists!";
    } else {

        echo "Unable to connect to database";
    }

    exit;
}

$files = array();
if ($handle = opendir(ABSPATH . 'sys/Lib/Importer/Drivers/')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            $entry = str_replace(".php", "", $entry);
            $files[] = $entry;
        }
    }

    closedir($handle);
}


Lib\Util::get_config($db);

$smarty->assign('files', $files);
$content = $smarty->fetch('importer.tpl');
