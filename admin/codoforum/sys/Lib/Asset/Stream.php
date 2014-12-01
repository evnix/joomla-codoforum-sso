<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Asset;

/**
 * 
 * Asset manager 
 * -------------
 * 
 * Manages assets like js, css 
 * Minifies assets and caches them . 
 * 
 * 
 * Collection
 * ----------
 * 
 * Collection can contain 1 or more than one asset .
 * Collection is used to concatenate multiple files into one file .
 * 
 * Stream
 * ------
 * 
 * Everything in Stream will be part of html output
 */
class Stream {

    /**
     * Path where assets are stored . This path will be used eveytime a 
     * relative url is passed while adding a new asset
     * @var string
     */
    public $asset_dir = ASSET_DIR;
    public $asset_url = ASSET_URL;

    /**
     * Directory relative to asset_dir where js files are stored
     * no trailing slash
     * @var string
     */
    public $js_dir = 'js';

    /**
     * Directory relative to asset_dir where css files are stored
     * no trailing slash
     * @var string
     */
    public $css_dir = 'css';

    /**
     * Directory where minified/concatenated files are cached
     * @var string 
     */
    public $cache_dir = 'cache';

    /**
     * Stores css files of collection
     * @var array
     */
    public static $css = array();

    /**
     * Stores js files of collection
     * @var array
     */
    public static $js = array();
    private static $collections = array();

    /**
     * Manager object to use methods that manage assets
     * @var object
     */
    private $manager;

//------------------------------------------------------------------------------

    public function __construct() {

        $this->manager = new Manager;
    }

    public function add_css($asset, $data = false) {

        self::$css[] = $this->manager->add($asset, $data);

        return $this;
    }

    public function add_js($asset, $data = false) {

        self::$js[] = $this->manager->add($asset, $data);

        return $this;
    }

    public function dump_js($pos) {

        $ujs = array_merge(self::$js, self::$collections);
        uasort($ujs, array($this->manager, 'order_cmp'));

        $html = '';
        foreach ($ujs as $_js) {

            $js = (array) $_js;

            if ($js['position'] != $pos) {
                continue;
            }

            if (is_object($_js)) {

                $html .= $this->pipeline($_js->js, 'js');
            } else {

                $html .= $this->mk_script($js['data'], $js['type']);
            }
        }

        return $html;
    }

    public function dump_css() {

        $ucss = array_merge(self::$css, self::$collections);

        uasort($ucss, array($this->manager, 'order_cmp'));

        $html = '';

        foreach ($ucss as $_css) {

            $css = (array) $_css;

            if (is_object($_css)) {

                $html .= $this->pipeline($_css->css, 'css');
            } else {

                $html .= $this->mk_link($css['data'], $css['type']);
            }
        }

        return $html;
    }

    private function pipeline($files, $type) {

        $contents = '';
        $urls = array();
        $html = '';

        foreach ($files as $file) {

            if (!$file)
                continue;

            if ($this->is_remote($file['data'])) {

                //oops we can't get contents of this remote file
                $urls[] = $file['data'];
                continue;
            }

            if(!file_exists($file['data'])) {
                
                $file['data'] = $this->asset_dir . $this->js_dir . '/' . $file['data'];
            }
            
//            $file['data'] = $this->build_path($file['data'], $type);

            $contents .= file_get_contents($file['data']);
        }

        if ($contents != '') {

            $name = md5($contents) . '.' . $type;

            if ($type == 'js') {
                $url = $this->asset_dir . $this->cache_dir . '/' . $name;
            } else {
                $url = THEME_DIR . CODO_SITE . '/' . $this->cache_dir . '/' . $name;
            }

            if (!file_exists($url)) {

                file_put_contents($url, $contents);
            }

            $urls[] = $name;
        }

        foreach ($urls as $url) {

            if ($type == 'js') {
                $html .= $this->mk_script($url, 'file', 'cache');
            } else {
                $html .= $this->mk_link($url, 'file', 'cache');
            }
        }

        return $html;
    }

    /**
     * Determine whether the path is local or remote
     * 	 
     * @param  string $path
     * @return bool
     */
    private function is_remote($path) {
        return ('http://' == substr($path, 0, 7) || 'https://' == substr($path, 0, 8));
    }

    private function build_path($path, $type) {

        if ($type == 'js') {

            return $this->asset_url . $this->js_dir . '/' . $path;
        } else {

            return CURR_THEME . $this->css_dir . '/' . $path;
        }
    }

    private function build_path_cache($path, $type) {

        if ($type == 'js') {

            return $this->asset_url . $this->cache_dir . '/' . $path;
        } else {

            return CURR_THEME . $this->cache_dir . '/' . $path;
        }
    }

    private function mk_script($data, $type, $cache = false) {

        $html = '';
        if ($type == 'file') {

            if (!$this->is_remote($data)) {

                if ($cache) {
                    $data = $this->build_path_cache($data, 'js');
                } else {
                    $data = $this->build_path($data, 'js');
                }
            }

            $html = "<script src='" . $data . "' type='text/javascript'></script>\n";
        } else if ($type == 'inline') {

            $html = "\n<script type='text/javascript'>" . $data . "</script>\n";
        }

        return $html;
    }

    /**
     * 
     * @return link href tag or style tag for css
     */
    private function mk_link($data, $type, $cache = false) {

        $html = '';

        if ($type == 'file') {

            if (!$this->is_remote($data)) {
                if ($cache) {
                    $data = $this->build_path_cache($data, 'css');
                } else {
                    $data = $this->build_path($data, 'css');
                }
            }
            $html = "<link href='" . $data . "' rel='stylesheet' type='text/css'>\n";
        } else if ($type == 'inline') {

            $html = "<style type='text/css'>" . $data . "</style>\n";
        }

        return $html;
    }

    /**
     * 
     * Adds a Collection object 
     * @param \Lib\Asset\Collection $collection
     * @return \Lib\Asset\Stream
     */
    public function add_collection(Collection $collection) {

        if (!isset(self::$collections[$collection->name])) {

            self::$collections[$collection->name] = $collection;
        } else {

            self::$collections[$collection->name]->css = array_merge(self::$collections[$collection->name]->css, $collection->css);
            self::$collections[$collection->name]->js = array_merge(self::$collections[$collection->name]->js, $collection->js);
        }

        return $this;
    }

}
