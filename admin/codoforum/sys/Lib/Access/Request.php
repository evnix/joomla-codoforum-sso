<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Access;

class Request {

    public static function valid($token) {

        if (!CSRF::valid($token)) {

            $css_files = array();
            $view = "access_denied";
            
            \Lib\Smarty\Layout::load($view, $css_files);
            return false;
        }
        
        return true;
    }

}
