<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Theme;

class Js extends Head {

    static $js = array();
    static $sys_order = 0;

    public static function add_js($name, $data, $type = 'file', $order = null, $position = 'head') {

        if ($order === null) {

            $order = self::$sys_order++;
        }

        self::$js[$name] = array(
            "order" => $order,
            "type" => $type, //can be inline or file
            "pos" => $position, //can be head or body
            "data" => $data
        );

        return true;
    }

    public static function get_js() {

        return self::$js;
    }

    public static function sort_js() {

        uasort(self::$js, array('self', 'order_cmp'));
    }

    /**
     * 
     * @return string concatenates all files/data to be printed in the template
     */
    public static function combine_js($position) {

        $html = '';
        $tab_space = null; //formatting reasons

        foreach (self::$js as $js) {

            if ($js['pos'] != $position) {
                continue;
            }

            if ($js['type'] == 'file') {

                $html .= "$tab_space<script src='" . $js['data'] . "' type='text/javascript'></script>\n";
            } else if ($js['type'] == 'inline') {

                $html .= "\n$tab_space<script type='text/javascript'>" . $js['data'] . "</script>\n";
            }

            if ($tab_space == null) {
                $tab_space = "        "; //formatting reasons
            }
        }

        return $html;
    }

    public static function remove_js($name) {

        if (isset(self::$js[$name])) {
            unset(self::$js[$name]);
        } else {
            return false;
        }

        return true;
    }

}
