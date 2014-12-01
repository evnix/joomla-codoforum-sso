<?php

namespace Lib;

class Format {

    //put your code here



    public static function message($mesg) {

        //convert relative path back to absolute url
        return str_replace("CODOF_RURI_" . UID . "_", RURI, $mesg);
    }

    
    public static function imessage($mesg) {

        $mesg = str_replace("<", "&lt;", $mesg);
        $mesg = str_replace(">", "&gt;", $mesg);

        return $mesg;
    }

    public static function omessage($mesg) {

        $html = new \Ext\Html();

        //$imesg; no escaping required
        $mesg = $html->filter($mesg);

        return $mesg;
    }
    
}
