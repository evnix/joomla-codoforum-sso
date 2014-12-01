<?php

/*
 * @CODOLICENSE
 */

namespace Lib;

class Filter {

    /**
     * 
     * Creates url safe alias from string
     * @param type $string
     * @return type
     */
    public static function URL_safe($string) {
        // Remove any '-' from the string since they will be used as concatenaters
        $str = str_replace('-', ' ', $string);

        // Trim white spaces at beginning and end of alias and make lowercase
        $str = trim(mb_strtolower($str));

        // Remove any duplicate whitespace, and ensure all characters are alphanumeric
        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);

        // Trim dashes at beginning and end of alias
        $str = trim($str, '-');

        return $str;
    }

    /**
     * Create html stripped and filtered message
     * @param type $msg
     */
    public static function msg_safe($message) {

        $message = strip_tags($message);
        $message = htmlentities($message);
        $message = filter_var($message, FILTER_SANITIZE_STRING);

        return $message;
    }

    
    public static function clean_username($username) {
        
        $name = str_replace("'", "", $username);
        $clean_name = str_replace(" ", "_", $name);
        $uname = Util::mid_cut($clean_name, 20, "_");

        return preg_replace('/_{2,}/','_',$uname);
        
    }
    
    public static function json_safe($string) {

        $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
        $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
        
        $string = str_replace($escapers, $replacements, $string);
        
        return $string;
    }

}
