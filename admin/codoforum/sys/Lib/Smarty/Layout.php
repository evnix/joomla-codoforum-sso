<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Smarty;

class Layout {

    public static function load($tpl, $css_files = array(), $js_files = array()) {

        $db = \Lib\DB::get_db();
        \Lib\Util::inc_global_views($db);

        
        //This sets all variables which will be used by the theme
        require CURR_THEME_PATH . 'theme.php';

        $page = array();

        \Lib\Hook::call('before_site_head');
        \Lib\Hook::call('tpl_before_' . str_replace("/", "_", $tpl));

        $asset = new \Lib\Asset\Stream();
   
        $page["head"]["css"] = $asset->dump_css();

        //\Lib\Theme\Js::sort_js();

        $page["head"]["js"] = $asset->dump_js('head');
        $page["body"]["js"] = $asset->dump_js('body');

        //after all modification its time for smarty to display the mod data
        $smarty = Single::get_instance();
        $smarty->assign('site_title', \Lib\Util::get_opt('site_title'));
        $smarty->assign('sub_title', \Lib\Store::get('sub_title'));
        $smarty->assign('home_title', \Lib\Store::get('home_title', _('All topics')));
        
        $smarty->assign('site_url', \Lib\Util::get_opt('site_url'));
        $smarty->assign('logged_in', \Lib\User\CurrentUser\CurrentUser::logged_in());

        $smarty->assign('login_url', \Lib\User\User::get_login_url());
        $smarty->assign('logout_url', \Lib\User\User::get_logout_url());
        $smarty->assign('register_url', \Lib\User\User::get_register_url());
        $smarty->assign('profile_url', \Lib\User\User::get_profile_url());
        
        $smarty->assign('page', $page);
        $smarty->assign('CSRF_token', \Lib\Access\CSRF::get_token());
        $smarty->assign('php_time_now', time());
        
        $logged = 'no';
        if(\Lib\User\CurrentUser\CurrentUser::logged_in()) {
            
            $logged = 'yes';
        }
        
        $smarty->assign('is_logged_in', $logged);
        
        
        $html = $smarty->fetch("$tpl.tpl");

        require_once SYSPATH . 'Ext/simplehtmldom/simple_html_dom.php';

        $dom = new \simple_html_dom();
        $dom->load($html, true, false);

        //let plugins modify html
        \Lib\Hook::call('tpl_after_' . str_replace("/", "_", $tpl), $dom);
        \Lib\Hook::call('after_site_head', $dom);
        
        echo $dom->save();
    }

    public static function not_found() {

        $css_files = array();
        $view = "not_found";

        Layout::load($view, $css_files);
    }
    
}
