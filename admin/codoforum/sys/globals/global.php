<?php

/* 
 * @CODOLICENSE
 */

/*
 * 
 * This includes all global function that are available to the user
 * So that they don't have to use the namespaces everywhere
 */

$stream = new \Lib\Asset\Stream();


/**
 * 

 */
function add_css($asset, $data = false) {
    
    global $stream;
    $stream->add_css($asset, $data);
}

/**
 * Gets all registered css files 
 */
/*function get_css() {
   
    return \Lib\Theme\Css::get_css();
}

function remove_css($name) {
    
    return \Lib\Theme\Css::remove_css($name);
}*/

function add_js($asset, $data = false) {
    
    global $stream;
    $asset['position'] = 'head';
    $stream->add_js($asset, $data);
}


/**
 * 
 * @param type $name name of the file
 * @param type $data can be inline js or path
 */
function add_js_body($asset, $data = false) {
    
    global $stream;
    $asset['position'] = 'body';
    $stream->add_js($asset, $data);
}

/**
 * Gets all registered css files 
 *//*
function get_js() {
    
    return \Lib\Theme\Js::get_js();
}

function remove_js($name) {
    
    return \Lib\Theme\Js::remove_js($name);
}*/


function add_hook($hook, $function, $args = array(), $priority = 10) {
    
    Lib\Hook::add($hook, $function, $args, $priority);
}

function call_hook($hook, $arg) {
    
    Lib\Hook::call($hook, $arg);
}

function get_hooks() {
    
    Lib\Hook::get_hooks();
}


/**
 * 
 * Get smarty object to assign variables
 */

function get_smarty() {
    
    return Lib\Smarty\Single::get_instance();
}