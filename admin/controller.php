<?php

/**
 * @package Component codoforum for Joomla! 3.0
 * @author codologic
 * @copyright (C) 2013 - codologic
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

// no direct access

defined('_JEXEC') or die('Restricted access');



jimport( 'joomla.application.component.controller' );

require_once( JPATH_COMPONENT.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'helper.php' );




class CodoforumController extends JControllerLegacy {


    function __construct() {

        //Get View

        if(JRequest::getCmd('view') == '') {

            JRequest::setVar('view', 'default');

        }

        $this->item_type = 'Default';

        parent::__construct();

    }

}

?>
