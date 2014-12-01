<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Access;

class Access {

    static protected $permissions;
    static protected $has_permissions = false;

    
    /**
     * 
     * @param type $permission
     * @param type $rid
     * @param type $module
     * @return type boolean
     * 
     * Checks if the user with $rid else the current user has
     * permission($permission) for the module(default core)
     *
     * If an array of permissions are passed it returns true if any of them 
     * are satisfied 
     */
    public static function has_permission($permission, $rid = false, $module = 'core') {

        if(!is_array($permission)) {
            
            $permissions = array($permission);
        }else{
            
            $permissions = $permission;
        }
        
        if (!$rid) {

            $user = \Lib\User\CurrentUser\CurrentUser::load_user();
            $rid = $user->rid;
        }

        if (!self::$has_permissions) {

            self::get_permissions();
        }

        if (isset(self::$permissions[$module])) {

            foreach ($permissions as $permission) {
                if (isset(self::$permissions[$module][$permission]) && in_array($rid, self::$permissions[$module][$permission])) {

                    return TRUE;
                }
            }
        }
        
        return FALSE;
    }

    private static function get_permissions() {

        $db = \Lib\DB::get_db();

        $qry = 'SELECT permission,rid,module FROM codo_role_permissions';
        $obj = $db->prepare($qry);
        $obj->execute();
        $result = $obj->fetchAll();

        $permissions = array();
        foreach ($result as $res) {

            $permissions[$res['module']][$res['permission']][] = $res['rid'];
        }

        self::$permissions = $permissions;
        self::$has_permissions = true;
    }

}
