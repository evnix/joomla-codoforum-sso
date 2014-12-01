<?php

/*
 * @CODOLICENSE
 */


namespace Lib\User;

class Logout {

    /**
     *
     * @var type PDO resource
     */
    protected $db;


    public function __construct($db) {
        
        $this->db = $db;
    }
    
    
    public function logout() {
        
        unset($_SESSION[UID . 'USER']);
        \Lib\Cookie::Delete('codo_remember');
    }
}
