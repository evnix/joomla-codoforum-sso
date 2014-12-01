<?php

$smarty= \Lib\Smarty\Single::get_instance();
$smarty->assign('msg','');

global $CONF;

if(isset($_GET['logout'])){
    
    session_destroy();
    $smarty->assign('logged_in','no');
    $smarty->assign('A_username','Hello');
    
}

if(isset($_POST['username'])){
    
    $login=new \Lib\User\Login(Lib\DB::get_db());
    
    $login->username=$_POST['username'];
    $login->password=$_POST['password'];
   
    $result=$login->process_login();
    $uobj=  json_decode($result);
   
    if($uobj->msg=='success'){
        
        if($uobj->role!='administrator'){
            
            $smarty->assign('msg','You do not have enough permissions');
        }else{
            
            //var_dump($uobj);
            
            $_SESSION[UID.'A_loggedin_username']=$login->username;
            $_SESSION[UID.'A_loggedin']='admin';//($_SESSION[UID.'USER']['id']);
            //var_dump($_SESSION);
            header("Location: index.php");
        }
        
    }else{
    $smarty->assign('msg','Invalid Username or Password');
    }
    
}


$content=$smarty->fetch('login.tpl');

