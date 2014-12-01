<?php

/*
 * @CODOLICENSE
 */

namespace Lib;

class Plugin {

    private static $plugin;

    public function __construct() {
        $this->db = DB::get_db();
    }

    public function init() {

        $qry = 'SELECT * FROM codo_plugins';
        $result = $this->db->query($qry)->fetchAll();

        foreach ($result as $res) {

            $path = PLUGIN_DIR . $res['plg_name'] . '/' . $res['plg_name'] . '.php';
            if ($res['plg_status'] == 1 && file_exists($path)) {

                require $path;
                
            }
            
            self::$plugin[$res['plg_name']] = array("status" => $res['plg_status']);
        }
    }

    /**
     * 1 -> active
     * Returns status of the plugin
     * @param type $plg_name
     * @return type int
     */
    public static function is_active($plg_name) {

        return self::$plugin[$plg_name]["status"];
    }
    
    public static function tpl($tpl) {

        $caller  = debug_backtrace();
        $first_caller = $caller[0];
        $caller_path = $first_caller['file'];
        $parts = explode("/", $caller_path);        
        $caller_plg = str_replace(".php", "", end($parts));
        
        \Lib\Smarty\Layout::load('file:' . PLUGIN_DIR  . $caller_plg . '/' . $tpl);
    }

}
