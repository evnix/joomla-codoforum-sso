<?php

/*
 * @CODOLICENSE
 */
//phpinfo();

//sleep(1); //debugging purposes
ini_set('xdebug.var_display_max_depth', '100');  
ini_set("display_errors", "on");
date_default_timezone_set('Europe/London'); 

error_reporting(-1);

define('IN_CODOF', true);

//contains config.php and path definitions
require 'sys/load.php';

//everything related to routing
require 'routes.php';
