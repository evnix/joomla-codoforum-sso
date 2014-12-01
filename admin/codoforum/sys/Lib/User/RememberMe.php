<?php

/*
 * @CODOLICENSE
 */

namespace Lib\User;

class RememberMe extends \Lib\Cookie{


    public function __construct($db) {
        $this->db = $db;
    }
    
    public function save_cookie($username) {
        
        $str = uniqid() . $username;
        $token = sha1($str);
        
        $cookie = $token . "|" . $username;
        
        \Lib\Cookie::Set("codo_remember", $cookie);
        
        $qry = "UPDATE codo_users SET token = :token WHERE username = :username";
        $obj = $this->db->prepare($qry);
        $obj->execute(array("token" => $token, "username" => $username));
    }
    
    /**
     * 
     * checks if the user cookie token matches the token stored in db
     * @return boolean 
     */
    
    public function has_cookie() {
        
        $cookie = \Lib\Cookie::Get('codo_remember', false);
        
        if($cookie) {
            
            list($token, $username) = explode("|", $cookie);
            
            $qry = "SELECT token FROM codo_users WHERE username = :username";
            $obj = $this->db->prepare($qry);
            $obj->execute(array("username" => $username));
            
            $result = $obj->fetchObject();
            
            if($result) {
                
                $db_token = $result->token;
                return $db_token == $token;
            }
        }
        
        return false;
    }
    
    public function destroy_cookie() {
        
        \Lib\Cookie::Delete('codo_remember');
        
        $curr_user = CurrentUser\CurrentUser::load_user();
        //Do not take the username from cookie to avoid DOS
        $username = $curr_user->username;
        
    }
}
