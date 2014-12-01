<?php

/*
 * @CODOLICENSE
 */

/*

This class provides an API to create HTML forms through PHP

Status: Incomplete 

*/
namespace Lib\Form;

class Form {

    private $blocks;

    public function __construct() {

        ;
    }

    public function add($name, $type, $attrs = '') {

        $str = '';
        
        foreach($attrs as $attr=>$val) {
            
            $str .= " $attr='$val' ";
        }
        
        $html = "<input type='$type' name='$name' $str />";

        return $this;
    }

    public function create_block($name, $str) {

        if (!in_array($name, $this->blocks)) {

            $this->blocks[$name] = $str;

            return new $this();
        }
    }

}
