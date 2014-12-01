<?php

/**
 * @package Component codoforum for Joomla! 3.0
 * @author codologic
 * @copyright (C) 2013 - codologic
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

// no direct access

defined('_JEXEC') or die('Restricted access');



/*

 * Define constants for all pages

 */


// Require the base controller

require_once JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controller.php';



// Require the base controller

require_once JPATH_COMPONENT.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'helper.php';



// Initialize the controller

$controller = new CodoforumController( );



// Perform the Request task

$controller->execute( JRequest::getCmd('task'));

$controller->redirect();

?>
