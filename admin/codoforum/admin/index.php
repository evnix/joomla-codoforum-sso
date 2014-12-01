<?php

/*
 * @CODOLICENSE
 */

define('IN_CODOF',TRUE);
error_reporting(-1);
ini_set("display_errors",1);

date_default_timezone_set('Europe/London'); 

require "adminload.php";
require "Lib.php";

$ruri = str_replace("index.php?u=/","",RURI);
define('A_RURI',$ruri); //http://root URI
define('A_DURI',str_replace("admin/","",DURI)); // http://~sites/
//define('DEFAULT_PATH',)//http://localhost/codoforum/sites/default/

//DATAPATH:  "/opt/lampp/htdocs/codoforum/sites/2013/12/20/xyz/"
//ABSPATH:  "/opt/lampp/htdocs/codoforum/"
Constants::post_boot('');

codoForumAdmin::$action["index"]="index";
codoForumAdmin::$action["categories"]="categories";
codoForumAdmin::$action["login"]="login";
codoForumAdmin::$action["users"]="users";
codoForumAdmin::$action["config"]="config";
codoForumAdmin::$action["sso"]="sso";
codoForumAdmin::$action["importer"]="importer";



//start 
codoForumAdmin::run();
