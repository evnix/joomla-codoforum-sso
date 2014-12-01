<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.get_no_children.php
 * Type:     function
 * Name:     get_no_children
 * Purpose:  gets all sub categories of a parent category
 * -------------------------------------------------------------
 */

/*
 * @CODOLICENSE
 */

function smarty_function_get_no_children($params) {

    $cnt = \Lib\Util::count_children($params['cat']);

    if ($cnt > 0) {
        return "<span>$cnt</span> " . ngettext("sub-category", "sub-categories", $cnt);
    }

    return false;
}
