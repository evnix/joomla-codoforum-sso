<?php

/*
 * @CODOLICENSE
 */

namespace Lib\User;

class Login {

    //put your code here

    public $username;
    public $password;
    private $db;

    public function __construct($db = false) {
        $this->db = $db;
    }

    /**
     * 
     * Checks if username and password is not empty
     * Checks if user exists and password matches
     * Logs the user in
     * remember_me() is called
     * 
     * @return type
     */
    public function process_login() {

        //don't neeed much validation since we use prepared queries    
        $username = strip_tags(trim($this->username));

        $hasher = new \Lib\Pass(8, false);
        $password = $this->password;

        $errors = array();

        if (strlen($username) == 0) {
            $errors[]["msg"] = _("username field cannot be left empty");
        }

        if (strlen($password) == 0) {
            $errors[]["msg"] = _("password field cannot be left empty");
        }

        if (strlen($password) < 72 && empty($errors)) {
            $qry = 'SELECT u.id, u.pass, r.rid, r.rname '
                    . ' FROM codo_users AS u '
                    . ' INNER JOIN codo_roles AS r ON r.rid=u.rid '
                    . ' WHERE u.username=:username ';

            $obj = $this->db->prepare($qry);
            $obj->execute(array("username" => $username));

            $user = $obj->fetchObject();

            if ($user && $hasher->CheckPassword($password, $user->pass)) {

                $this->log_me_in($user->id);
                $this->remember_me();
                return json_encode(array("msg" => "success", "uid" => $user->id, "rid" => $user->rid, "role" => $user->rname));
            } else {

                \Lib\Log::info('failed login attempt by ' . $username . 'wrong username/password');
                return json_encode(array("msg" => _("Wrong username or password")));
            }
        } else {
            return json_encode($errors);
        }
    }

    /**
     * 
     * Logs the user in with specified user id and sets its last access time
     * in codo_users table
     * 
     * @param type $id
     */
    public function log_me_in($id, $identifier = 'uid') {

        \Lib\Hook::call('on_user_loggedin', array($id));
        
        //get user id from database when uid is not the identifier
        if(!($identifier == 'uid')) {

            $qry = "SELECT id FROM codo_users WHERE $identifier=:value";            
            $obj = $this->db->prepare($qry);            
            $obj->execute(array('value' => $id));
            
            $res = $obj->fetch();
            $id = $res['id'];
        }
        
        
        $_SESSION[UID . 'USER']['id'] = $id;
        
        CurrentUser\CurrentUser::set_last_access();
    }

    /**
     * Saves cookie 
     */
    public function remember_me() {

        if (isset($_GET['remember']) && $_GET['remember'] == "true") {

            $rem = new RememberMe($this->db);
            $rem->save_cookie($this->username);
        }
    }

}
