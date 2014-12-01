<?php

defined('IN_CODOF') or die();

/*
 * @CODOLICENSE
 */

/*
 * Easy reference to all constants used by codoforum
 */

/*
 * Assumes load.php includes this file
 */

/*
 * defined in index.php
 */

define('CODO_DEBUG', 1);
define('DISPLAY_ERRORS', 'ON');

define('SEF', 0); //Search engine freindly urls , 1=> enable , 0=> disable
define('LOCALE', 'en_US');
define('SYSPATH', ABSPATH . 'sys/');
define('CONTROLLERS_DIR', SYSPATH . 'Controller/');

define('DATA_REL_PATH',  'sites/' . CODO_SITE . '/');
define('DATA_PATH', ABSPATH . DATA_REL_PATH); //user data is stored
define('ASSET_DIR', DATA_PATH . 'assets/');
define('CAT_IMGS', 'assets/img/cats/'); //path where category images are stored
define('DEF_AVATAR', 'assets/img/profiles/def/user.png'); //path where default avatar is stored
define('SMILEY_PATH', 'assets/img/smileys/');

define('PROFILE_IMG_PATH', 'assets/img/profiles/');

define('VERSION', '1.3');

class Constants {

    public static function pre_config($path) {

        define('THEME_DIR', DATA_PATH . 'themes/');
        define('PLUGIN_DIR', DATA_PATH . 'plugins/');

        $ruri = str_replace("index.php", "", $path);
        

        define('SALT', 'd4F54@4ed!!ef');
        
        //this is defined simply to remind that it is going to be variable in the future
        define('USER_ROLL_ID', 2);

        
        $duri = $ruri . CODOFORUM_PATH;
        
        if (!SEF) {
            define('RURI', $ruri . 'index.php?u=/');
        } else {
            define('RURI', $ruri);
        }
        
        
        define('DURI', $duri . 'sites/' . CODO_SITE . '/');
        define('ASSET_URL', DURI . 'assets/');
        define('PLUGIN_PATH',  DURI . 'plugins/');

    }

    public static function post_config($CONF) {
        
        define('UID', $CONF['UID']);
        define('SECRET', $CONF['SECRET']);
        define('PREFIX', $CONF['PREFIX']);               
    }

    public static function post_boot($views_dir) {

        
        define('CURR_THEME', DURI . $views_dir);
        define('CURR_THEME_PATH', DATA_PATH . $views_dir);
    }

}
