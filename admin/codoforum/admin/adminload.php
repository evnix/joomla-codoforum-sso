<?php

/*
 * @CODOLICENSE
 */
defined('IN_CODOF') or die();

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

define('ABSPATH', dirname(dirname(__FILE__)) . '/');

if (!defined('CODO_SITE')) {

    define('CODO_SITE', 'default');
    //  define('CODO_SITE', 'default');
        define('CODOFORUM_PATH', '');
}

require ABSPATH . 'sites/' . CODO_SITE . '/constants.php';

\Constants::pre_config($path);

if (file_exists(DATA_PATH . 'config.php')) {

    //contains valuable db information
    require DATA_PATH . 'config.php';
    //contains routing system
    //require ABSPATH . 'sys/Ext/limonade/limonade.php';

    Constants::post_config($CONF);
    Lib\Util::start_session();
    require DATA_PATH . 'locale/lang.php';
} else {

    die('codo forums not installed!');
}
