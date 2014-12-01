<?php

/**
 * @package Component codoPM for Joomla! 3.0
 * @author codologic
 * @copyright (C) 2013 - codologic
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die;

get_user();

function get_user() {



    //$clientID = variable_get('orchid_vanilla_clientid','1234');
    //$secret = variable_get('orchid_vanilla_secret','1234');
    //$avatar_shared = variable_get('orchid_avatar_sync',false);
    //$avatar_size = variable_get('orchid_avatar_style','thumbnail');

    /* if (is_numeric($user->picture)) {
      $user->picture = file_load($user->picture);
      } */

    $sso = new codoforum_sso();

    $account = $sso->get_user_details();
    $sso->output_jsonp($account);
    exit();
}


class codoforum_sso {

    private $client_id = "SSO_CLIENT_ID";
    private $secret = "SSO_SECRET";
    private $timeout = 6000;

    public function __construct() {
    
        // Get a db connection.
        $db = JFactory::getDbo();
        $conf = $this->get_config($db);

        $this->client_id = $conf['cleint_id']; 
        $this->secret = $conf['secret'];
    }

    function get_config($db) {
        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from the user profile table where key begins with "custom.".
        // Order it by the ordering field.
        $query->select($db->quoteName(array('option_name', 'option_value')));
        $query->from($db->quoteName('codopm_config'));
         
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


    public function gateway() {

        if (!isset($_GET['client_id'])) {

            return array('error' => 'client_id parameter is missing');
        } else if ($_GET['client_id'] != $this->client_id) {

            return array('error' => 'client_id does not match');
        } else if (!isset($_GET['timestamp']) || !is_numeric($_GET['timestamp'])) {

            return array('error' => 'The timestamp provided is invalid or missing');
        } else if (!isset($_GET['token'])) {

            return array('error' => 'No token provided');
        } elseif (abs($_GET['timestamp'] - time()) > $this->timeout) {

            return array('error' => 'The timestamp is invalid.');
        } else {
            // Make sure the timestamp hasn't timed out.
            $token = md5($_GET['timestamp'] . $this->secret);
            if ($token != $_GET['token']) {
                return array('error' => 'Invalid token');
            }
        }
    }

    public function get_user_details() {
    
        $user = JFactory::getUser();

        $account = array();
        if (!$user->guest) {

            $account['uid'] = $user->id;            
            $account['name'] = $user->name;
            $account['username'] = $user->username;
            $account['mail'] = $user->email;
            $account['avatar'] = '';
            
            if($account['name'] == '') $account['name'] = $account['username'];
            
            /* if($avatar_shared) {
              $account['photourl'] = ($user->picture && $user->picture->uri) ? file_create_url(image_style_path($avatar_size,$user->picture->uri)) : '';
              } */
        }else {
            
            $accout['f'] = 'f';
        }

        return $account;    
    }

    public function output_jsonp($data, $secure = false) {

        $this->user = $data;
        
        $res = $this->gateway();
        
        if(isset($res['error'])) {
            
            $data = $res['error'];
        }
        
        $resp = json_encode($data);

        if (isset($_GET['callback'])) {

            header("Content-Type: application/javascript");
            echo "{$_GET['callback']}($resp);";
        }
    }

}

?>

