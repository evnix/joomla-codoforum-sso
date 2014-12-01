<?php

/*
 * @CODOLICENSE
 */

/**
 * Description of CSRF
 *
 * @author silva
 */

namespace Lib\Access;

class CSRF {

   
    public static function get_token() {
        
        $user = \Lib\User\CurrentUser\CurrentUser::load_user();
        $id = $user->id;
        
        return md5($id . SECRET);        
    }


    public static function valid($token) {

        $user = \Lib\User\CurrentUser\CurrentUser::load_user();
        $id = $user->id;
        
        return md5($id . SECRET) == $token;
    }

}
