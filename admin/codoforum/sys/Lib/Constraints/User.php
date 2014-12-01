<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Constraints;

/**
 * 
 * Constraints defined for an user 
 * 
 * What is a constraint ?
 * A constraint is anything which restricts free change of data normall defined
 * by the user
 * 
 * Why a separate class ?
 * Reusability , etc etc 
 */
class User {

    /**
     * All errors are pushed into this array
     * @var type 
     */
    private $errors = array();

    /**
     * Return all trapped errors
     * @return type
     */
    public function get_errors() {

        return $this->errors;
    }

    /**
     * Constraints defined for password of a user
     * @param string $pass
     */
    public function password($pass) {

        $errors = array();
        $pass_len = strlen($pass);
        $min_len = \Lib\Util::get_opt('register_pass_min');

        ///this is useful during hashing 
        if ($pass_len > 72) {
            $errors[] = _("password cannot be greater than 72 characters!");
        }

        //i know this leads to hardcoded translation problem; but i am lazy ;)
        if ($pass_len < $min_len) {
            $errors[] = _("password cannot be less than $min_len characters!");
        }
        
        $this->errors = $errors;
        if(empty($errors)) {
            
            return TRUE; //passed
        }
        
        return FALSE; //Fail
    }

    /**
     * Constraints defined for username
     * @param type $username
     */
    public function username($username) {

        $username_len = strlen($username);
        $min_username_len = \Lib\Util::get_opt('register_username_min');

        if ($username_len < $min_username_len) {
            $this->errors[] = _("username cannot be less than $min_username_len characters!");
        }

        if (preg_match('/^\w$/', $username)) {

            $this->errors[] = _("username can have only letters digits and underscores");
        }

        if (\Lib\User\User::username_exists($username)) {
            $this->errors[] = _("user already exists");
        }
    }

    public function mail($mail) {

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = _("email address not formatted correctly");
        }
        
        if (\Lib\User\User::mail_exists($mail)) {
            $this->errors[] = _("email address is already registered");
        }

    }

}
