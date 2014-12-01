<?php

/*
 * @CODOLICENSE
 */

namespace Lib\User;

class Register {

    //put your code here


    public $username;
    public $name;
    public $password;
    public $mail;
    public $avatar = '';
    public $oauth_id = 0;
    public $user_status = 0; //pending , 1=approved
    public $rid = 2; //by default a approved user
    private $db;

    public function __construct($storage) {
        
        //set default password as a random value
        $this->password = time() . uniqid() . rand(1000, 5000);
        $this->db = $storage;
    }
    
    public function register_user() {

        $username = $this->username;
        $name = $this->name;
        $password = $this->password;
        $mail = $this->mail;
        $errors = array();

        $hasher = new \Lib\Pass(8, false);
        $hash = $hasher->HashPassword($password);

        if (strlen($hash) >= 20) {

            $fields = array("username" => $username, "name" => $name, "pass" => $hash,
                "mail" => $mail, "created" => time(), "user_status" => $this->user_status, "avatar" => $this->avatar, "rid" => $this->rid, "oauth_id" => $this->oauth_id);

            $qry = 'INSERT INTO codo_users (username, name, pass, mail, created, user_status, avatar, rid, oauth_id) '
                    . 'VALUES(:username, :name, :pass, :mail, :created, :user_status, :avatar, :rid, :oauth_id)';

            $obj = $this->db->prepare($qry);
            if (!$obj->execute($fields)) {

                \Lib\Log::error("Could not register user! \nError:\n " . print_r($obj->errorInfo(), true) . "  \nData:\n" . print_r($fields, true));
                $errors[] = "Could not register user";
            } else {

                $_SESSION[UID . 'USER']['id'] = $this->db->lastInsertId('id');
                
                if ($this->user_status == 0) {

                    $this->add_signup_attempt($fields);
                    $this->send_mail($fields, $errors);
                }

                //TODO: CurrentUser -> store user
                //dont know the security implications when $fields is passed with hook
                \Lib\Hook::call('on_user_registered');
            }
        }

        return $errors;
    }

    /**
     * adds an record in codo_signups with a unique token and username
     * 
     * @param type $user array of user info from User->get_user()
     */
    public function add_signup_attempt($user) {

        $this->token = md5($user['mail'] . time());

        $qry = "INSERT INTO " . PREFIX . "codo_signups (username, token) VALUES(:name,:token)";
        $stmt = $this->db->prepare($qry);

        $stmt->execute(array(":name" => $user['username'], ":token" => $this->token));
    }

    /**
     * 
     * Sends an email for confirming the user . 
     * You must call add_signup_attempt() before calling this method
     * 
     * @param type $fields array of user info from User->get_user()
     * @param type $errors
     */
    public function send_mail($fields, &$errors) {

        $mail = new \Lib\Mail\Mail();
        
        $body = \Lib\Util::get_opt('await_approval_message');
        $sub = \Lib\Util::get_opt('await_approval_subject');

        $confirm_url = RURI . "user/confirm" . "&user=" . $fields['username'] . "&token=" . $this->token;
        $confirm_page = RURI . "user/confirm";

        $mail->curr = array(
            "token" => $this->token,
            "confirm_url" => $confirm_url,
            "confirm_page" => $confirm_page
        );

        $mail->user = $fields;

        $message = $mail->replace_tokens($body);
        $subject = $mail->replace_tokens($sub);

        $to = $fields['mail'];

        $mail->to = $to;
        $mail->subject = $subject;
        $mail->message = $message;
        
        $mail->send_mail();

        if (!$mail->sent) {

            $errors[] = $mail->error;
        }
    }

    /**
     * 
     * Get different possible errors before registering an user
     * @return Array errors
     */
    public function get_errors() {

        $constraints = new \Lib\Constraints\User;
        $constraints->username($this->username);
        $constraints->password($this->password);
        $constraints->mail($this->mail);
        
        $errors = $constraints->get_errors();

        if (\Lib\Util::get_opt('captcha') == "enabled") {

            require_once ABSPATH . 'sys/Ext/recaptcha/recaptchalib.php';

            $privatekey = \Lib\Util::get_opt("captcha_private_key");
            $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

            if (!$resp->is_valid) {
                $errors[] = _("capcha entered was wrong");
            }
        }

        return $errors;
    }

}
