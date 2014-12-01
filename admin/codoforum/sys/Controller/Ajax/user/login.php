<?php

/*
 * @CODOLICENSE
 */

namespace Controller\Ajax\user;

class login {

    public function __construct() {
        $this->db = \Lib\DB::get_db();
    }

    public function dologin() {

        if (isset($_GET['username']) && isset($_GET['password'])) {

            $login = new \Lib\User\Login($this->db);
            \Lib\Hook::add('on_user_loggedin', array($this, 'login_user'));

            $login->username = $_GET['username'];
            $login->password = $_GET['password'];
            echo $login->process_login();
        }
    }

    public function login_user() {
        
    }

    public function req_pass() {


        $errors = array();

        //assign a predictable password but it is difficult to predict the
        //password unless you know the user personally ;)
        $new_pass = uniqid();

        $mail = new \Lib\Mail\Mail();

        //update the user's password with the generated password
        $user = new \Lib\User\User($this->db);

        $me = $user->get_user_by_username_or_mail($_GET['ident']);
        if (!$me) {

            $errors[] = _("User does not exist with the given username/mail");
        }

        if (empty($errors)) {

            if (!$user->update_password_by_id($new_pass, $me->id)) {

                $errors[] = _("Unable to reset password");
            }

            $body = \Lib\Util::get_opt('password_reset_message');
            $sub = \Lib\Util::get_opt('password_reset_subject');


            $mail->user = array(
                "password" => $new_pass
            );

            $message = $mail->replace_tokens($body);
            $subject = $mail->replace_tokens($sub);



            $mail->to = $me->mail;
            $mail->subject = $subject;
            $mail->message = $message;

            $mail->send_mail();

            if (!$mail->sent) {

                $errors[] = $mail->error;
            }
        }
        $resp = array("status" => "success", "msg" => "E-mail sent successfully");
        if (!empty($errors)) {

            $resp = array("status" => "fail", "msg" => $errors);
        }

        echo json_encode($resp);
    }

}
