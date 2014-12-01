<?php

/*
 * @CODOLICENSE
 */

class codoForumAdmin {

    public static $action = array();

    public static function show_layout($index) {
        $smarty = \Lib\Smarty\Single::get_instance();
        if (isset($_SESSION[UID . 'A_loggedin']) && $_SESSION[UID . 'A_loggedin'] == 'admin') {

            //$user = Lib\User\CurrentUser\CurrentUser::load_user();
            //$user=new Lib\User\User(Lib\DB::get_db());
            //$user=$user->get_user($id);
            //var_dump($user);
            $smarty->assign('A_username', $_SESSION[UID.'A_loggedin_username']);

            $smarty->assign('logged_in', 'yes');
        } else {
            $index = 'login';
        }

        require("modules/$index/$index.php");

        if (!isset($_GET['raw'])) { //raw output
            $smarty->assign('A_RURI', A_RURI);
           
            $active=array_fill_keys(codoForumAdmin::$action,'');
            
            if(isset($_GET['page'])){
                
                $active[$_GET['page']]='active';
            }else{
                $active['index']='active';
            }
            
            $smarty->assign('active',$active);
            $smarty->assign('content', $content);
            echo $smarty->fetch('layout.tpl');
        }
    }

    public static function run() {

        $smarty = \Lib\Smarty\Single::get_instance(ABSPATH . 'admin/layout/');

        if (isset($_GET['page']) && isset(codoForumAdmin::$action[$_GET['page']]))
            codoForumAdmin::show_layout(codoForumAdmin::$action[$_GET['page']]);
        else
            codoForumAdmin::show_layout('index');
    }

}
