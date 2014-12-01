<?php

/* 
 * @CODOLICENSE
 */

/*
 * Fallback for gettext()
 */

if (!function_exists("gettext")) {

    \Lib\Lang\Lang::init();
    
    function gettext($str, $index = -1) {

        return \Lib\Lang\Lang::gettext($str, $index);
    }

    function _($str) {

		return gettext($str);
    }

    function ngettext($singular, $plural, $no) {

        return gettext($singular, $no);
    }

}else{

setlocale(LC_ALL, LOCALE);
putenv('LANGUAGE='.LOCALE);

$domain = "messages";
bindtextdomain($domain, DATA_PATH . "locale");
//bind_textdomain_codeset($domain, 'UTF-8');

textdomain($domain);
}
