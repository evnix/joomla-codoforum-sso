<?php

/*
 * @CODOLICENSE
 */

namespace Controller;

class user {

    public $view = false;
    public $css_files = array();
    public $js_files = array();
    private $smarty;

    public function __construct() {

        $this->db = \Lib\DB::get_db();
        $this->smarty = \Lib\Smarty\Single::get_instance();
    }

    public function login() {

        \Lib\Hook::call('before_controller_login');
        
        $this->view = 'user/login';
        if (isset($_SESSION[UID . 'USER']['id'])) {
            header('Location: ' . \Lib\User\User::get_profile_url());
            exit;
        }
        
        \Lib\Hook::call('after_controller_login');
        \Lib\Store::set('sub_title', _('User login'));
        
    }

    public function logout() {

        \Lib\Hook::call('on_controller_logout');
        
        $user = new \Lib\User\Logout($this->db);
        $user->logout();
        
        if(\Lib\Plugin::is_active('sso')) {
            
            header('Location: ' . \Lib\Util::get_opt('sso_logout_user_path'));
            exit;
        }
        
        header('Location: ' . RURI);
    }

    public function profile($id, $action) {

        $this->view = 'user/profile/view';

        if ($id == null) {

            $id = 0;
        }

        if ($action == null) {

            $action = 'view';
        }

        $profile = new \Lib\User\Profile();
        $uid = $profile->get_uid($id);

        $user = new \Lib\User\User($this->db);
        $iuser = $user->get_user($uid);

        if ($iuser) {
            //pass user object to template
            $this->smarty->assign('user', $iuser);
            $this->smarty->assign('rname', $user->get_rname($iuser->rid));
           
            
            \Lib\Store::set('sub_title', $iuser->username);
            
            if ($action == 'edit') {

                $this->view = $profile->get_edit_view($id, $uid);
                $this->css_files = array('profile_edit');

                $this->smarty->assign('signature_char_lim', \Lib\Util::get_opt('signature_char_lim'));
                
            } else if ($action == 'view') {

                if ($uid != \Lib\User\CurrentUser\CurrentUser::get_id()) {

                    $user->inc_profile_views($uid);
                    $this->smarty->assign('user_is_current', false);
                } else {

                    $this->smarty->assign('user_is_current', true);
                }

                $this->css_files = array('profile_view');
                \Lib\Hook::call('before_profile_load', array($uid));
            } else {

                $this->view = 'access_denied';
            }
        } else {
            $this->view = 'not_found';
        }
    }

    public function edit_profile($id) {

        $edit = new \Lib\User\User($this->db);

        $values = array(
            "name" => $_POST['name'],
            "signature" => $_POST['signature']
        );

        $success = true;

        if (isset($_FILES) && $_FILES['avatar']['error'] != UPLOAD_ERR_NO_FILE) {

            $success = false;
            $result = \Lib\File\Upload::do_upload($_FILES['avatar'], PROFILE_IMG_PATH);

            if (\Lib\File\Upload::$error) {

                $this->smarty->assign('file_upload_error', $result);
            } else {

                $values["avatar"] = $result['name'];
                $success = true;
            }
        }

        $edited = $edit->set_fields($id, $values);


        if (!$edited) {

            Util::log("Failed to update user details profile/id/edit");
            $success = false;
        }

        $this->smarty->assign('user_profile_edit', $success);


        $this->profile($id, 'edit');
    }

    public function register($do) {

        if (isset($_SESSION[UID . 'USER']['id'])) {
            header('Location: ' . \Lib\User\User::get_profile_url());
            exit;
        }

        $this->view = 'user/register';
        $set_fields = array('username', 'password', 'mail');
        $req_fields = array('username', 'password', 'mail');

        if (\Lib\Util::is_set($_REQUEST, $set_fields) && !\Lib\Util::is_empty($_REQUEST, $req_fields) && $do) {

            $register = new \Lib\User\Register($this->db);

            $register->username = $_REQUEST['username'];
            $register->name = null; //$_REQUEST['name'];
            $register->password = $_REQUEST["password"];
            $register->mail = $_REQUEST['mail'];
            $register->rid = 1;

            $errors = $register->get_errors();

            if (empty($errors)) {
                $errors = $register->register_user();

                if (empty($errors)) {
                    header('Location: ' . \Lib\User\User::get_profile_url());
                    exit;
                }
                //set('errors', $errors);             //Limonade function
            }

            $this->smarty->assign('errors', $errors);
        } else {

            $register = new \stdClass();
            $register->username = null;
            $register->name = null; //$_REQUEST['name'];
            $register->password = null;
            $register->mail = null;



            if (\Lib\Util::get_opt('captcha') == "enabled") {

                require ABSPATH . 'sys/Ext/recaptcha/recaptchalib.php';
                $publickey = \Lib\Util::get_opt('captcha_public_key'); // you got this from the signup page
                $this->smarty->assign('recaptcha', recaptcha_get_html($publickey));
            }
        }
        $this->smarty->assign('min_pass_len', \Lib\Util::get_opt('register_pass_min'));
        $this->smarty->assign('min_username_len', \Lib\Util::get_opt('register_username_min'));
        $this->smarty->assign('register', $register);
        
        \Lib\Store::set('sub_title', 'Register');
    }

    public function confirm() {

        $this->view = 'user/confirm';
        $action = array();

        if (empty($_GET['user']) || empty($_GET['token'])) {
            $action['result'] = 'VAR_NOT_PASSED';
            //$action['text'] = 'We are missing variables. Please double check your email.';
        } else {

            //cleanup the variables
            $username = $_GET['user'];
            $token = $_GET['token'];

            //check if the key is in the database
            $qry = "SELECT username FROM  " . PREFIX . "codo_signups WHERE username=:username AND token=:token LIMIT 1 OFFSET 0";
            $stmt = $this->db->prepare($qry);
            $result = $stmt->execute(array("username" => $username, "token" => $token));

            if ($result) {

                //get the confirm info
                $res = $stmt->fetch();

                //confirm the email and update the users database
                $qry = "UPDATE " . PREFIX . "codo_users SET user_status=1, rid=2 WHERE username=:username";
                $stmt = $this->db->prepare($qry);
                $stmt->execute(array("username" => $username));

                //delete the signup rows associated with the selected username
                $qry = "DELETE FROM " . PREFIX . "codo_signups WHERE username = '" . $res['username'] . "'";
                $this->db->query($qry);

                $action['result'] = 'SUCCESS';
            } else {

                $action['result'] = 'VAR_NOT_FOUND';
            }
        }

        $this->smarty->assign('result', $action['result']);
    }
    
    public function forgot() {
        
        $this->view = 'user/forgot';
        \Lib\Store::set('sub_title', _('Request new passsword'));
    }

    
    public static function access_denied() {
        
        $this->view = 'access_denied';
        \Lib\Store::set('sub_title', _('Access Denied'));
    }

    public static function not_found() {
        
        $this->view = 'not_found';
        \Lib\Store::set('sub_title', _('Not found'));
    }

}
