<?php

define('IN_CODOF', true);

//contains valuable db information
require 'config.php';

//contains utility class
require 'util.php';

//contains DB connection class
require 'server/db.php';

//create db connection
$db = DB::get_connection($DB);


class Plugin {

    public function __construct($db) {
        $this->db = $db;
    }

    public function create_list() {

        $dirs = array();

        foreach (new DirectoryIterator(PLUGIN_DIR) as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                $dirs[] = $file->getFilename();
            }
        }
        
        
        $path = PLUGIN_DIR;

        foreach ($dirs as $dir) {

            $path .= $dir . '/' . $dir . '.php';
            
            if($this->is_valid_plugin($path)) {

                $qry = 'INSERT IGNORE INTO codo_plugins (plg_name,plg_status,plg_weight) VALUES(:filename, :status, :weight)';
                $q = $this->db->prepare($qry);
                $q->execute(array(':filename'=>$path,':status'=>1,':weight'=>0));

            }
        }
    }

    public function is_valid_plugin($path) {
        
        if (file_exists($path)) {
            include $path;

            $cls = explode("/",$path);
            $cls_name = str_replace(".php","",end($cls));
            if (class_exists($cls_name)) {
                
                return true;
            }
        }
        
        return false;
    }

}

$plugin = new Plugin($db);
$plugin->create_list();
