<?php

/*
 * @CODOLICENSE
 */
$smarty= \Lib\Smarty\Single::get_instance();

$db = Lib\DB::get_db();


$query="SELECT * FROM " . PREFIX . "codo_config";



if(isset($_POST['sso_secret'])){
    
    $cfgs=array();
    foreach($_POST as $key=>$value){
        
        
    $query="UPDATE ".PREFIX."codo_config SET option_value=:value WHERE option_name=:key";
    $ps=$db->prepare($query);
    $ps->execute(array(':key'=>$key,':value'=>$value));
    //echo $query."<br>\n";    
    
    }
    
    
}


Lib\Util::get_config($db);
$content=$smarty->fetch('sso.tpl');
