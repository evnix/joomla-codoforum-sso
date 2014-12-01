<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Smarty;

// load Smarty library
require ABSPATH . 'sys/Ext/Smarty/Smarty.class.php';

class Single {

    private static $smarty = null;
    private static $instance = null;
    
    private function __construct($path) {

        self::$smarty = new \Smarty();
        $this->load($path);
    }

    public static function get_instance($path = CURR_THEME_PATH) {

        if (!self::$instance) {
            self::$instance = new self($path);
        }
        return self::$instance;
    }

    public function load($path) {

        self::$smarty->setTemplateDir($path . 'templates');
        self::$smarty->setCompileDir($path . 'templates_c/');
        self::$smarty->setConfigDir($path . 'configs/');
        self::$smarty->setCacheDir($path . 'cache/');

        self::$smarty->addPluginsDir(SYSPATH . 'Lib/Smarty/plugins');
        self::$smarty->debugging = FALSE;
        //$this->caching = \Smarty::CACHING_LIFETIME_CURRENT;
    }

    public function assign($var, $value) {
        self::$smarty->assign($var, $value);
    }

    public function display($filename) {
        self::$smarty->display($filename);
    }

    public function fetch($filename) {
        return self::$smarty->fetch($filename);
    }
    
}
