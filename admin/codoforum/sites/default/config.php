<?php

/* 
 * @CODOLICENSE
 */

defined('IN_CODOF') or die();

$installed=false;

function get_codo_db_conf() {

 return array(
    
  'DSN'    => 'mysql:host=localhost;port=3306;dbname=codoforum',
  'user'   => 'root',
  'pass'   => '',
  'prefix' => ''  
);

}

$DB = get_codo_db_conf();

$CONF = array (
    
  'driver' => 'Custom',
  'UID'    => '536de7a985ebd',
  'SECRET' => '536de7a985efe',
  'PREFIX' => ''
);
