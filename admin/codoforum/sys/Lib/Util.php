<?php

/*
 * @CODOLICENSE
 */

namespace Lib;

defined('IN_CODOF') or die();

//Assumes config.php has been included before

class Util {

    //Not used now, since logging is done in the database
    public static $log = 'logs/file.log';
    private static $options = array();
    
    public static $use_normal_sessions = false;

    /**
     * 
     * Logger function
     * @param type $message
     */
    public static function log($message) {

        if (CODO_DEBUG) {

            Log::info($message);
        }
    }

    /**
     * 
     * Gets all configuration information 
     * @param type $db -> DB connection
     */
    public static function get_config($db) {

        $qry = 'SELECT * FROM codo_config';
        $res = $db->query($qry);
        $conf = $res->fetchAll();

        $info = array();
        foreach ($conf as $c) {

            $info[$c['option_name']] = self::valid_JSON($c['option_value']);
        }
        self::$options = $info;
    }

    public static function get_smileys($db) {

        $qry = 'SELECT symbol, image_name FROM codo_smileys';
        $res = $db->query($qry);
        $smileys = $res->fetchAll();

        return $smileys;
    }

    /**
     * 
     * starts custom session that works on database rather than file
     * for faster access/write speed
     */
    public static function start_session() {

        //initiate/update/destroy user sessions
        if (!self::$use_normal_sessions) {
            
            new \Lib\Session();
        }
        session_start();
    }

    /**
     * 
     * Validates json
     * 
     * @param type $str
     * @return type
     * 
     * returns decoded json if valid string else returns the string itself
     */
    public static function valid_JSON($str) {

        //we want associative array so pass true
        $json = json_decode($str, true);

        if ($json == null) {
            return $str;
        } else {
            return $json;
        }
    }

    public static function get_opt($option) {

        if (empty(self::$options) || !isset(self::$options[$option])) {
            return 'The option '.$option.' does not exist in the table';
        } else {
            return self::$options[$option];
        }
    }

    public static function trim($str, $len) {

        //make sure trimmed string does not exceed given length
        return (strlen(trim($str)) > $len);
    }

    /**
     * 
     * Checks if all $req_fields are present in $array
     * @param {array} $array
     * @param {array} $req_fields
     * @return boolean
     */
    public static function is_set($array, $req_fields) {

        foreach ($req_fields as $req_field) {

            if (!array_key_exists($req_field, $array)) {
                return false;
            }
        }

        return true;
    }

    public static function is_empty($array, $req_fields) {

        foreach ($req_fields as $req_field) {

            if (trim($array[$req_field]) == "") {
                return true;
            }
        }

        return false;
    }

    public static function br2nl($string) {

        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    }

    /**
     * 
     * Abbreviates a big number with k,m,b,t
     * 
     * @param type $number -> input number
     * @param type $decPlaces -> precision
     * @return string -> abbreviated number
     */
    public static function abbrev_no($number, $decPlaces) {

        // 2 decimal places => 100, 3 => 1000, etc
        $decPlaces = pow(10, $decPlaces);

        // Enumerate number abbreviations
        $abbrev = array("k", "m", "b", "t");
        $i = 3; //size of above array
        // Go through the array backwards, so we do the largest first
        while ($i--) {

            // Convert array index to equivalent "1000", "1000000", etc
            $size = pow(10, ($i + 1) * 3);

            // If the number is bigger or equal do the abbreviation
            if ($size <= $number) {
                // Here, we multiply by decPlaces, round, and then divide by decPlaces.
                // This gives us nice rounding to a particular decimal place.

                $number = round($number * $decPlaces / $size) / $decPlaces;
                //              echo " ".$number. " ";
//                echo " ".($number/10);
                // Handle special case where we round up to the next abbreviation
                if (($number == 1000) && ($i < 3)) {
                    $number = 1;
                    $i++;
                }

                // Add the letter for the abbreviation
                //echo $number;
                $number .= $abbrev[$i];

                // We are done... stop
                break;
            }
        }

        return $number;
    }

    public static function inc_global_views($db) {

        $qry = 'INSERT INTO codo_views(date, views) VALUES(CURDATE(), 1) ON DUPLICATE KEY UPDATE views=views+1';
        $db->query($qry);
    }

    public static function re_array_files(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

    /**
     * Replaces any parameter placeholders in a query with the value of that
     * parameter. Useful for debugging. Assumes anonymous parameters from 
     * $params are are in the same order as specified in $query
     *
     * @param string $query The sql query with parameter placeholders
     * @param array $params The array of substitution parameters
     * @return string The interpolated query
     */
    public static function interpolate_query($query, $params) {
        $keys = array();

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }
        }

        $query = preg_replace($keys, $params, $query, 1, $count);

        //trigger_error('replaced '.$count.' keys');

        return $query;
    }

    public static function count_children($cat) {

        if (property_exists($cat, 'children')) {

            //find no of children upto single nest
            //we need to convert the object into array first
            //to use count()
            return count((array) $cat->children);
        }

        return 0;
    }

    /*
     * Shortens text by cutting middle portion and substituting the omitted
     * text by ...
     * For eg. The fox jumped over cat --> The fox j... cat
     */

    public static function mid_cut($text, $max_chars, $mid = "...") {

        $text_len = strlen($text);

        if ($text_len > $max_chars) {

            return substr_replace($text, $mid, $max_chars / 2, $text_len - $max_chars);
        } else {

            return $text;
        }
    }
    
    public static function get_avatar_path($name) {
        
        if($name == null) {
            
            return DURI . DEF_AVATAR;
        } 
        
        if(strpos($name, "http") !== FALSE) {
            
            return $name;
        }
        
        return DURI . PROFILE_IMG_PATH . $name;
    }

    /**
     * 
     * just a dummy echo function
     * @param type $message
     */
    public static function e($message) {

        echo $message;
    }

}
