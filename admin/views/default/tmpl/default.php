<?php

/**
 * @package Component codoPM for Joomla! 3.0
 * @author codologic
 * @copyright (C) 2013 - codologic
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/


defined('_JEXEC') or die('Restricted access');

JToolBarHelper::title(JText::sprintf('COM_CODOFORUM_END_TITLE'), 'codoforum.png');

// Get a db connection.
$db = JFactory::getDbo();

function get_config($db) {
    // Create a new query object.
    $query = $db->getQuery(true);

    // Select all records from the user profile table where key begins with "custom.".
    // Order it by the ordering field.
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

//Load configuration in $conf 
$conf = get_config($db);

if(isset($_POST)) {


    
    foreach($conf as $key => $value) {

        if(isset($_POST[$key])) {

            $fields = $conditions = array();
            $fields[] = $db->quoteName('option_value') . '=' . $db->quote($_POST[$key]);        
            $conditions[] = $db->quoteName('option_name') . '=' . $db->quote($key);
            
            // Create a new query object.
            $query = $db->getQuery(true);            
            $query->update($db->quoteName('codoforum_config'))->set($fields)->where($conditions);     
            $db->setQuery($query); 
            $db->query();

        }
    }


}

//Load updated configuration in $conf 
$conf = get_config($db);
?>



<style type="text/css">

.codopm_form label {

    font-weight: normal;
    display: block;
    width: 100%;
}


.codopm_form hr {
    margin: 18px 0;
    border: 0;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #fff;
    width: 100%;
}


</style>

<!--<h2 align="center">Configuration</h2>-->
<form class="codopm_form" role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="adminForm">

    
    <fieldset>
        <legend>General</legend>
        <div class="form-group">
            <label for="msgs_per_page">Codoforum client id</label>
            <input type="text" name="client_id" value="<?php echo $conf['client_id']; ?>" />
        </div>
        <hr/>
        
        <div class="form-group">
            <label for="conv_per_page">Codoforum secret </label>
            <input type="text" name="secret" value="<?php echo $conf['secret']; ?>" />
        </div>         
    </fieldset>
    <hr/>
        <em>Above values must be same as set in the SSO plugin in Codoforum backend</em>
  <div class="form-actions">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Save</button>
    </div>
  </div>
</form>
