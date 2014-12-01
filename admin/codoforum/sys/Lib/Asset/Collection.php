<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Asset;

class Collection{

    /**
     * Where will the collection of assets be dumped in head or body ?
     * @var string
     */
    public $position = 'head';

    /**
     * Name of this collection
     * @var string
     */
    public $name;
    
    /**
     * 
     */
    public $type = 'file';
    
    /**
     * Global Order of all collection
     * @var int
     */
    private static $sys_order;
    
    /**
     * Order of this collection
     * @var int
     */
    public $order;
    
    /**
     * Stores css files of collection
     * @var array
     */
    public $css = array();
    
    /**
     * Stores js files of collection
     * @var array
     */
    public $js = array();
    
    /**
     * Manager object to use methods that manage assets
     * @var object
     */
    private $manager;

//------------------------------------------------------------------------------
    
    public function __construct($name, $order = false) {
        
        $this->name = $name;
        
        if(!$order) {
            
            $order = self::$sys_order++;
        }
        
        $this->order = $order;
        $this->manager = new Manager;
    }
    
    public function add_css($asset, $data = false) {
        
        $this->css[] = $this->manager->add($asset, $data);
        
        return $this;
    }
    
    public function add_js($asset, $data = false) {

        $this->js[] = $this->manager->add($asset, $data);
        
        return $this;                
    }
    
}