<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Asset;

class Manager {

    /**
     * Order in which assets are loaded
     * @var int 
     */
    private static $order = 0;

//------------------------------------------------------------------------------

    /**
     * 
     * $name, $data, $type = 'file', $order = false, $position = 'head'
     * @param type $asset     * 
     * @param type $type
     * @return type
     */
    public function add($asset, $data = false) {

        if (!is_array($asset)) {

            $_asset = array();

            if ($data) {

                $_asset['name'] = $asset;
                $_asset['data'] = $data;
            } else {

                $_asset['name'] = $_asset['data'] = $asset;
            }

            $asset = $_asset;
        } else if (!isset($asset['name']) || !isset($asset['data'])) {
            return false;
        }

        $def_asset = array(
            "name" => null, //required
            "data" => null, //required
            "type" => 'file', //file or inline
            "order" => false,
            "position" => 'head' //head or body
        );

        $asset = array_merge($def_asset, $asset);

        if (!$asset['order']) {

            self::$order++;
            $asset['order'] = self::$order;
        }


        return $asset;
    }

    public function order_cmp($a, $b) {

        $order = array();
        if (is_object($a)) {

            $order['a'] = $a->order;
        } else {
            $order['a'] = $a['order'];
        }

        if (is_object($b)) {

            $order['b'] = $b->order;
        } else {
            $order['b'] = $b['order'];
        }


        if ($order['a'] == $order['b']) {
            return 0;
        }
        return ($order['a'] < $order['b']) ? -1 : 1;
    }

}
