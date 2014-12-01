<?php

/*
 * @CODOLICENSE
 */

/*
 * 
 * This defines the default values for default user i.e guest
 */

namespace Lib\User\CurrentUser;

class DefaultUser {

    /**
     *
     * @var type userid of the user
     */
    public $id = 0;
    
    /**
     *
     * @var type username
     */
    public $username;
    
    /**
     *
     * @var type email id of user
     */
    public $mail;
    
    /**
     * 1 => guest
     * @var type role id of user
     */
    public $rid = 1;
    
}
