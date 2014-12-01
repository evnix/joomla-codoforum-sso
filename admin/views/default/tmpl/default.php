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
            $query->update($db->quoteName('codopm_config'))->set($fields)->where($conditions);     
            $db->setQuery($query); 
            $db->query();

        }
    }


}

//Load updated configuration in $conf 
$conf = get_config($db);



$uploads_dir = JPATH_SITE . '/components/com_codopm/client/uploads';

if(!is_writable($uploads_dir)) { ?>
    
<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> The uploads dir is not writable . Please chmod permissions of 
  components/com_codopm/client/uploads/ to 0777
</div>    
<?php } ?>

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
            <label for="msgs_per_page">No. of messages displayed per page in Inbox </label>
            <input type="text" name="msgs_per_page" value="<?php echo $conf['msgs_per_page']; ?>" />
        </div>
        <hr/>
        
        <div class="form-group">
            <label for="conv_per_page">Initial no. of messages displayed for user after which <i>load older messages</i> button will be shown </label>
            <input type="text" name="conv_per_page" value="<?php echo $conf['conv_per_page']; ?>" />
        </div>        
        <hr/>
        
        <div class="form-group">
            <label for="conv_load_offset">No. of messages to load on clicking <i>load older messages</i> button</label>
            <input type="text" name="conv_load_offset" value="<?php echo $conf['conv_load_offset']; ?>" />
        </div>        
    </fieldset>
    
    <br/>

    <fieldset>
        <legend>File upload</legend>    
        <div class="form-group">
            <label for="max_filename_len">Maximum length of filename </label>
            <input type="text" name="max_filename_len" value="<?php echo $conf['max_filename_len']; ?>" />
        </div>
        <hr/>

        <div class="form-group">
            <label for="max_filename_len">Maximum allowed size of each file </label>
            <div class="input-prepend">
              <input type="text" class="form-control" name="per_filesize_limit" value="<?php echo $conf['per_filesize_limit']; ?>" />
              <span class="add-on">KB</span>
            </div>    
        </div>
        <hr/>

        <div class="form-group">
            <label for="per_filesize_limit">Maximum allowed total size of all files </label>
            <div class="input-prepend">
              <input type="text" class="form-control" name="total_filesize_limit" value="<?php echo $conf['total_filesize_limit']; ?>" />
              <span class="add-on">KB</span>
            </div>
        </div>
        <hr/>

        <div class="form-group">
            <label for="exts">Allowed file extensions</label>
            <input type="text" name="valid_exts" value="<?php echo $conf['valid_exts']; ?>" />
            <!--<span class="help-block"> List all extensions separated by comma </span>-->
        </div>
    </fieldset>
        
  <div class="form-actions">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Save</button>
    </div>
  </div>
</form>
