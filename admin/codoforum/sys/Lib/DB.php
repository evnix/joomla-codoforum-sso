<?php

/*
 * @CODOLICENSE
 */

namespace Lib;

defined('IN_CODOF') or die('not defined');

//Assumes config.php has been included before

class DB {

    private static $connection;
    public static $connected = false;
    private static $log_errors = true;
    
    public static $persistent = false;

    public static function connect($DB) {

        try {
            $connection = new \PDO($DB['DSN'], $DB['user'], $DB['pass'], array(
                \PDO::ATTR_PERSISTENT => self::$persistent
            ));
        } catch (PDOException $e) {

            die($e->getMessage());
        }

        self::$connected = true;


        $connection->exec("SET CHARACTER SET utf8");
        $connection->exec("SET NAMES utf8");
        $connection->exec("SET SESSION sql_mode = 'ANSI';");

        self::$connection = $connection;        

        if (self::$log_errors) {

            Util::log("connected to database successfully");
        }
        
    }

    public static function get_db($log_errors = true, $force = false) {

        self::$log_errors = $log_errors;

        if (!self::$connected || $force) {
            //require ABSPATH . 'sites/default/config.php';
            self::connect(\get_codo_db_conf(), $force);
        }

        return self::$connection;
    }

    public static function is_field_present($value, $field) {

        //no need for limit because the fields are always checked for uniqueness
        $qry = "SELECT id FROM codo_users WHERE $field=:value";
        $obj = self::$connection->prepare($qry);
        $obj->execute(array("value" => $value));

        if($obj->rowCount()) {
            
            $res = $obj->fetch();
            return $res['id'];
        }
        
        return false;
    }

}
