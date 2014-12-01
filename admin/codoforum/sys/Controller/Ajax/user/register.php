<?php

/*
 * @CODOLICENSE
 */

namespace Controller\Ajax\user;

class register {

    public function __construct() {


        global $DB;
        \Lib\DB::connect($DB);
        $this->db = \Lib\DB::get_db();
    }

    public function username_exists() {

        if (isset($_GET['username'])) {

            $response = array("exists" => false);

            $username = $_GET['username'];
            if ($_GET['username'] != '' && \Lib\User\User::username_exists($username)) {
                $response['exists'] = true;
            }

            echo json_encode($response);
        }
    }

    public function mail_exists() {

        if (isset($_GET['mail'])) {

            $response = array("exists" => false);

            $mail = $_GET['mail'];
            if ($_GET['mail'] != '' && \Lib\User\User::mail_exists($mail)) {
                $response['exists'] = true;
            }

            echo json_encode($response);
        }
    }

    public function resend_mail() {

        if (\Lib\User\CurrentUser\CurrentUser::logged_in()) {
            
            $user = new \Lib\User\User($this->db);

            //some stupid guy i.e me, has made foll. method to return object instead of an array
            $details = (array)$user->get_user(\Lib\User\CurrentUser\CurrentUser::get_id());
            
            $errors = array();
            
            $reg = new \Lib\User\Register($this->db);
            
            $reg->add_signup_attempt($details);
            $reg->send_mail($details, $errors);
            
            if(empty($errors)) {
                
                echo 'success';
            }else{
                
                echo $errors[0];
            }
        } 
        
    }

}
