<?php

/*
 * @CODOLICENSE
 */

defined('IN_CODOF') or die();


dispatch_post('sso/authorize', function() {

    //CSRF protection  
    if (\Lib\Access\Request::valid($_POST['token'])) {

        //$id = $_POST['uid'];      
        $username = $_POST['name'];
        $mail = $_POST['mail'];

        $db = Lib\DB::get_db();

        if (!Lib\User\User::mail_exists($mail)) {

            //this user does not have an account in codoforum
            $reg = new \Lib\User\Register($db);
            if(\Lib\User\User::username_exists($username)) {
                
                $username .= time();
            }
            $reg->username = $username;
            $reg->name = $username;
            $reg->mail = $mail;
            $reg->user_status = 1;
            $ret = $reg->register_user();
            
            if(!empty($ret)) {
                
                echo "error";
            }
        } else {

            $log = new \Lib\User\Login($db);
            $log->log_me_in($mail, 'mail');
        }
    }
});

function add_sso_js() {

    add_js('sso.js', PLUGIN_PATH . 'sso/assets/js/sso.js');
    add_css('sso.css', PLUGIN_PATH . 'sso/assets/css/sso.css');
}

//lets write the req info in divs
//so that they can be fetched later using javascript
function add_sso_defs($dom) {

    $container = $dom->getElementById('codo_js_php_defs');

    $sso_token = md5(time() . Lib\Util::get_opt('sso_secret'));
    $sso_client_id = Lib\Util::get_opt('sso_client_id');
    $sso_get_user_path = Lib\Util::get_opt('sso_get_user_path');
    $sso_login_user_path = Lib\Util::get_opt('sso_login_user_path');

    $auto_login = 'no';
    if (isset($_GET['sso']) && $_GET['sso'] == 'login') {

        $auto_login = 'yes';
    }

    $html = <<<EOD
        <div id="_codo_sso_token">$sso_token</div>      
        <div id="_codo_sso_auto_login">$auto_login</div>    
        <div id="_codo_sso_client_id">$sso_client_id</div>
        <div id="_codo_sso_get_user_path">$sso_get_user_path</div>
        <div id="_codo_sso_login_user_path">$sso_login_user_path</div>
            
EOD;

    //prepend our code
    $container->innertext = $html . $container->innertext;


    $container = $dom->getElementById('codo_navbar_content');

    $html = <<<EOD
        <div class="codo_login_loading"></div>       
EOD;

    //prepend our code
    $container->innertext = $html . $container->innertext;
        
}

function add_login_as($dom) {
    
        $container = $dom->getElementById('codo_login_container');

        $sso_name = Lib\Util::get_opt('sso_name');
        
        $html = <<<EOD
        <div class="row codo_sso">
          <div class="codo_sso_login_btn codo_sso_login_btn" id="codo_login_with_sso">with <span>$sso_name</span></div>
        </div>   
EOD;

        //prepend our code
        $container->innertext = $html . $container->innertext;
    
}

Lib\Hook::add('tpl_after_user_login', "add_login_as");

//Below hooks are called on all pages
Lib\Hook::add('before_site_head', "add_sso_js");
Lib\Hook::add('after_site_head', "add_sso_defs");

