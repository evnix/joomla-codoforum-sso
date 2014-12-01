<?php

/*
 * @CODOLICENSE
 */

if($_GET['xhash'] == $_SESSION['xhash']) {
 
    $_SESSION['LICENSE_ACCEPTED'] = true;
}

if(!isset($_SESSION['LICENSE_ACCEPTED'])) {
    exit('license not accepted');
}

class Permission {

    private $dir = "sites/default/";
    public $permission_error = false;
    public $permits = array();

    public function __construct() {

        $this->files = array("config.php");
        $this->dirs = array("assets/img/attachments/", "assets/img/cats/", "assets/img/profiles/");
    }

    private function ret_is_writable($file) {

        $path = ABSPATH . $this->dir . $file;

        if (is_writable($path)) {

            return TRUE;
        }

        $this->permission_error = true;    
        return FALSE;
    }

    private function set_permits($file) {

        $this->permits[] = array(
            "name" => $this->dir.$file,
            "perm" => $this->ret_is_writable($file)
        );
    }

    private function check_file_permissions() {

        foreach ($this->files as $file) {
            
            $this->set_permits($file);
        }
    }

    private function check_folder_permissions() {

        foreach ($this->dirs as $file) {
            
            $this->set_permits($file);
        }
    }
    
    public function get_permits() {
        
        $this->check_file_permissions();
        $this->check_folder_permissions();
        
        return $this->permits;
    }
    
}

$perms = new Permission();
$permits = $perms->get_permits();

//$smarty->assign("permits", $permits);
$permission_error = $perms->permission_error;
