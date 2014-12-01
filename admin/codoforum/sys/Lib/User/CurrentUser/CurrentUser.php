<?php

/*
 * @CODOLICENSE
 */


/*
 * 
 * 
 * NOTE: Incomplete class as of now
 * 
 */

namespace Lib\User\CurrentUser;

class CurrentUser {

    /**
     *
     * @var type user object contains complete info
     */
    static protected $user;

    /**
     * 
     * @var type Do we have user info stored in $user ?
     */
    static private $has_user = false;

    /**      
     * Returns an object containing current user information
     * @return \Lib\User\CurrentUser\DefaultUser
     */
    static public function load_user() {


        if (self::$has_user) {

            return self::$user;
        }

        $_user = new DefaultUser();
        $user = false;
        
        if (isset($_SESSION[UID . 'USER']['id']) && $_SESSION[UID . 'USER']['id'] !== "0") {

            $db = \Lib\DB::get_db();
            $u = new \Lib\User\User($db);
            $user = $u->get_user($_SESSION[UID . 'USER']['id']);
        }

        if(!$user) {
            
            $user = $_user;
        }
        
        self::$user = $user;
        self::$has_user = true;

        return $user;
    }

    /**
     * 
     * Returns true if user is logged in else false
     * 
     * @return type boolean
     */
    public static function logged_in() {

        return isset($_SESSION[UID . 'USER']['id']);
    }

    /**
     * 
     * Gets the current user's userid
     * returns 0 if guest
     * @return integer
     */
    public static function get_id() {

        if (self::logged_in()) {
            
            return $_SESSION[UID . 'USER']['id'];
        }
        return 0;
    }
    
    /**
     * 
     * increments number of posts of current user
     * 
     * @param type $db
     */
    public static function inc_posts($db) {


        $uid = $_SESSION[UID . 'USER']['id'];

        $qry = "UPDATE codo_users SET no_posts=no_posts+1 WHERE id=$uid";
        $db->query($qry);
    }

    /**
     * 
     * Decrements number of posts of current user
     * 
     * @param type $db
     */
    public static function dec_posts($db) {


        $uid = $_SESSION[UID . 'USER']['id'];

        $qry = "UPDATE codo_users SET no_posts=no_posts-1 WHERE id=$uid";
        $db->query($qry);
    }

        
    /**
     * 
     * Sets the last access time for the current user
     * @param type $uid
     */
    public static function set_last_access() {
        
        $uid = CurrentUser::get_id();
        $time = time();
        $qry = "UPDATE ".PREFIX."codo_users SET last_access=$time WHERE id=$uid";
        
        $db = \Lib\DB::get_db();
        $db->query($qry);
                
    }

}
