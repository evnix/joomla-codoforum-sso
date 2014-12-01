<?php

/* Page dependent stylesheets */

$asset = new \Lib\Asset\Stream();

$col = new \Lib\Asset\Collection('head_col');
$col->add_js('jquery-1.10.2', 'jquery-1.10.2.min.js')
    ->add_js('jquery.rest.js')
    ->add_js('bootstrap.min.js')
    ->add_js('app.js');


$global_css = array('global');

$files = array_merge($global_css, $css_files);
$path = CURR_THEME_PATH . 'css';

//Add page-dependent css files defined by controllers
foreach($files as $file) {

    $col->add_css("$path/$file.css");    
}

$asset->add_collection($col);

$colb = new \Lib\Asset\Collection('body_col');
$colb->position = 'body';
$colb->add_js('handlebars-v1.1.2', 'handlebars-v1.1.2.js')
     ->add_js('css-1.5.0', 'css-1.5.0.min.js');

// Add page-dependent js files defined by controllers 
foreach ($js_files as $js_file) {
    
    $colb->add_js($js_file);
}

$asset->add_collection($colb);

