<?php

/*
 * @CODOLICENSE
 */
defined('IN_CODOF') or die();

define('ABSPATH', dirname(dirname(__FILE__)) . '/');

$local = true;

if (!defined('CODO_SITE')) {
    if (!$local) {

        require ABSPATH . '../fodologic.com/includes/config.php';
        require ABSPATH . '../fodologic.com/includes/DB.php';

        DB::connect($DB);
        $db = DB::get_db();

        $host = $_SERVER['HTTP_HOST'];

        $qry = 'SELECT s.version,s.path FROM codo_sites s JOIN codo_site_info i
             ON i.site_id=s.id WHERE i.alias=:host';

        $stmt = $db->prepare($qry);
        $stmt->execute(array(":host" => $host));

        $res = $stmt->fetch();

        if ($res) {


            define('CODO_SITE', $res['path']);
            //define('CODO_VER',  $res['version']);
            define('CODOFORUM_PATH', '');
        }
    } else {

        define('CODO_SITE', 'default');
        define('CODOFORUM_PATH', '');
    }
}




spl_autoload_register(function($class) {

    if (0 === strpos($class, 'Smarty')) {
        return;
    }

    $className = explode('\\', $class);
    $class = array_pop($className);
    $namespace = implode("/", $className);
    $file = ABSPATH . "sys/" . $namespace . "/" . $class . '.php';

    if (is_file($file)) {
        require $file;
    } else {
        echo 'Unable to require ' . $file;
    }
});




if (@$_SERVER["HTTPS"] == "on") {
    $protocol = "https://";
} else {
    $protocol = "http://";
}

$path = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];


require ABSPATH . 'sites/' . CODO_SITE . '/constants.php';

\Constants::pre_config($path);

if (file_exists(DATA_PATH . 'config.php')) {

    //contains valuable db information
    require DATA_PATH . 'config.php';
    Constants::post_config($CONF);

    //contains routing system
    //require ABSPATH . 'sys/Ext/limonade/limonade.php';

    //initiate all plugins
    //Now the plugins can work on the data available
    //$plg = new \Lib\Plugin($db);
    //$plg->init();

    \Lib\Hook::call('after_config_loaded');
    Lib\Util::$use_normal_sessions = true;
    //\Lib\Util::start_session();

    require DATA_PATH . 'locale/lang.php';

    \Constants::post_boot('themes/' . \Lib\Util::get_opt('theme') . "/");

} else {

    die('codo forums not installed!');
}

//print_r(get_defined_constants(true));