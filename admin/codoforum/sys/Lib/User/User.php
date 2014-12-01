<?php

/*
 * @CODOLICENSE
 */

/*
 * 
 * Utitlity functions for user
 */

namespace Lib\User;

class User {

    private $db;

    public function __construct($db) {

        $this->db = $db;
    }

    public static function get_login_url() {

        if (\Lib\Plugin::is_active('sso')) {

            return \Lib\Util::get_opt('sso_login_user_path');
        }

        return RURI . 'user/login';
    }

    public static function get_logout_url() {

        /* if(\Lib\Plugin::is_active('sso')) {

          return \Lib\Util::get_opt('sso_logout_user_path');
          } */

        return RURI . 'user/logout';
    }

    public static function get_register_url() {

        if (\Lib\Plugin::is_active('sso')) {

            return \Lib\Util::get_opt('sso_register_user_path');
        }

        return RURI . 'user/register';
    }

    public static function get_profile_url() {

        return RURI . 'user/profile';
    }

    public function get_user_obj($qry, $vals) {

        $obj = $this->db->prepare($qry);
        $obj->execute($vals);

        $user = false;

        if ($obj->rowCount()) {
            $user = $obj->fetchObject();
            $user->avatar = \Lib\Util::get_avatar_path($user->avatar);
        } else {
            var_dump($this->db->query('SELECT * FROM codo_users')->fetchAll());
            \Lib\Util::log('Unable to fetch user data User.php:39 vals= ' . print_r($vals, true) . ' ' . print_r($_SESSION, true));
        }

        return $user;
    }

    /**
     * 
     * Gets general user information from codo_users table
     * @param type $id userid of the user
     */
    public function get_user($id) {

        $qry = 'SELECT * FROM codo_users WHERE id=:id';
        $vals = array("id" => $id);

        return $this->get_user_obj($qry, $vals);
    }

    /**
     *  Gets user information from passed username or email id
     * @param type $credential username or email
     * @return type
     */
    public function get_user_by_username_or_mail($credential) {

        $qry = 'SELECT * FROM codo_users WHERE username=:username OR mail=:mail';
        $vals = array(":username" => $credential, ":mail" => $credential);

        return $this->get_user_obj($qry, $vals);
    }

    /**
     * 
     * Gets the role id of the user from passed userid
     * 
     * @param type $id user id
     * @return boolean role id of user
     */
    public function get_rid($id) {

        $id = (int) $id;
        $qry = "SELECT rid FROM codo_users WHERE id=$id";
        $res = $this->db - query($qry);

        if ($res) {

            $result = $res->fetchObject();
            return $result->rid;
        }

        return false;
    }

    /**
     * Gets the role name from  passed role id of user
     * 
     * @param type $rid
     * @return String role name of user
     */
    public function get_rname($rid) {

        $rid = (int) $rid;

        static $roles = false;

        if (!$roles) {

            $qry = "SELECT rid,rname FROM codo_roles";
            $res = $this->db->query($qry);

            if ($res) {

                $roles = $res->fetchAll();
            }
        }

        if ($roles) {

            foreach ($roles as $role) {

                if ($role['rid'] == $rid) {

                    return $role['rname'];
                }
            }
        }

        return false;
    }

    /**
     * 
     * Increments profile view by 1 of user
     * @param type $uid userid of user
     */
    public function inc_profile_views($uid) {

        $qry = "UPDATE " . PREFIX . "codo_users SET profile_views=profile_views+1 WHERE id=$uid";

        $this->db->query($qry);
    }

    /**
     * 
     * $values is associative array to update the user
     * Array{ $field => $value }
     * if $id is not passed , the current user is updated
     * @param type $id -> userid of the user
     * @param type $values 
     */
    public function set_fields($values, $id = false, $identifier = 'id') {

        $update_arr = array();

        if (!$id) {

            $id = CurrentUser\CurrentUser::get_id();
        }

        foreach ($values as $field => $value) {

            $update_arr[] = "$field=:$field";
        }

        $update_str = implode(",", $update_arr);


        $qry = "UPDATE " . PREFIX . "codo_users SET $update_str WHERE $identifier=:imported_$identifier";

        $stmt = $this->db->prepare($qry);

        $values = array_merge($values, array("imported_$identifier" => $id));
//        var_dump($values);
        $stmt->execute($values);
//        var_dump($stmt->errorInfo());
        return true;
    }

    /**
     * 
     * Checks if the password passed, matches the password of the current user
     * @param string $password
     * @return boolean
     */
    public function match_password($password) {

        $hasher = new \Lib\Pass(8, false);
        $id = CurrentUser\CurrentUser::get_id();

        if ($id) {

            $qry = 'SELECT pass FROM ' . PREFIX . 'codo_users WHERE id=' . $id;
            $obj = $this->db->query($qry);

            if ($obj) {

                $res = $obj->fetch();
                $stored_hash = $res['pass'];

                return $hasher->CheckPassword($password, $stored_hash);
            }
        }

        return FALSE;
    }

    /**
     * 
     * Updates the password of the current user
     * @param string $new_pass
     * @param string $old_pass
     * @return boolean true if password was updated
     */
    public function update_password($new_pass, $old_pass) {

        if ($old_pass != $new_pass) {

            //verified user 
            $hasher = new \Lib\Pass(8, false);
            $hash = $hasher->HashPassword($new_pass);

            //update the new hashed password
            return $this->set_fields(array("pass" => $hash));
        }

        return FALSE;
    }

    /**
     * Updates password of the user whose userid is passed with the new password
     * @param type $new_pass
     * @param type $id
     */
    public function update_password_by_id($new_pass, $id) {
        
            //verified user 
            $hasher = new \Lib\Pass(8, false);
            $hash = $hasher->HashPassword($new_pass);

            //update the new hashed password
            return $this->set_fields(array("pass" => $hash), $id);
    }
    
    public static function username_exists($username) {

        return \Lib\DB::is_field_present($username, 'username');
    }

    public static function mail_exists($mail) {

        return \Lib\DB::is_field_present($mail, 'mail');
    }

}
