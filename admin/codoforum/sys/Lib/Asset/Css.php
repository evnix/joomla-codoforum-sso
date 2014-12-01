<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Theme;

class Css extends Head{

    static $css = array();
    static $sys_order = 0;
    
    public static function add_css($name, $data, $type = 'file', $order = 0) {

        if($order === null) {
            
            $order = self::$sys_order++;
        }
        
        self::$css[$name] = array(
            "order" => $order,
            "type" => $type, //can be inline or file
            "data" => $data
        );

        return true;
    }

    public static function get_css() {

        return self::$css;
    }

    /**
     * 
     * @return string concatenates all files/data to be printed in the template
     */
    public static function combine_css() {
        
        uasort(self::$css, array('self', 'order_cmp'));
        
        $html = '';
        $tab_space = ""; //formatting reasons
        $i = 0;

        
        foreach(self::$css as $css) {

            if ($i == 1) {
                $tab_space = "        ";
            }
            
            if($css['type'] == 'file') {
                
                $html .= "$tab_space<link href='".$css['data']."' rel='stylesheet/less' type='text/less'>\n";                
            }else if($css['type'] == 'inline') {
                
                $html .= "$tab_space<style type='text/css'>".$css['data']."</style>\n";
            }
            
            $i++;
        }
        
        return $html;
    }
    
    public static function remove_css($name) {

        if (isset(self::$css[$name])) {
            unset(self::$css[$name]);
        } else {
            return false;
        }

        return true;
    }
    
}
