<?php

/**
 * @package Component codoforum for Joomla! 3.0
 * @author codologic
 * @copyright (C) 2013 - codologic
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die;

require 'sso.php';

function get_config($db) {
    // Create a new query object.
    $query = $db->getQuery(true);

    $query->select($db->quoteName(array('option_name', 'option_value')));
    $query->from($db->quoteName('codoforum_config'));
     
    // Reset the query using our newly populated query object.
    $db->setQuery($query);
     
    // Load the results as a list of stdClass objects (see later for more options on retrieving data).
    $results = $db->loadObjectList();

    $conf = array();
    foreach($results as $c) {

        $conf[$c->option_name] = $c->option_value;
    }
    
    return $conf;
}

// Get a db connection.
$db = JFactory::getDbo();
$conf = get_config($db);
 
$settings = array(
    
  "client_id" => $conf['client_id'],
  "secret" => $conf['secret'],
  "timeout" => 6000  
);


$sso = new codoforum_sso($settings);
$user = JFactory::getUser();

$account = array();
if (!$user->guest) {

    $account['uid'] = $user->id;            
    $account['name'] = $user->name;
    $account['username'] = $user->username;
    $account['mail'] = $user->email;
    $account['avatar'] = '';
    
    if($account['name'] == '') $account['name'] = $account['username'];
    
}
$sso->output_jsonp($account); //output above as JSON back to Codoforum
exit();

