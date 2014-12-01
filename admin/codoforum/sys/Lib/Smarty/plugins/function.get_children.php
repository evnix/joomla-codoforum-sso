<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.get_children.php
 * Type:     function
 * Name:     get_children
 * Purpose:  gets all sub categories of a parent category
 * -------------------------------------------------------------
 */

/*
 * @CODOLICENSE
 */

function smarty_function_get_children($params) {

    if (property_exists($params['cat'], 'children')) {

        //echo '<ul>';
        foreach ($params['cat']->children as $child) {

            echo '<div class="codo_category_children">';
            codo_cat_build_structure($child);
            echo smarty_function_get_children(array("cat" => $child));
            echo '</div>';
        }
        //echo '</ul>';
    }
}

function codo_cat_build_structure($cat) {

    $DURI = DURI;
    $CAT_IMGS = CAT_IMGS;
    $topics = _("topics");

    $cnt = \Lib\Util::count_children($cat);

    if ($cnt > 0) {

        $str = "&middot; <span>$cnt</span> " . ngettext("sub-category", "sub-categories", $cnt);
    } else {

        $str = '<span class="codo_no_children_present"></span>';
    }



    $url = RURI . 'forum/topics/' . $cat->cat_alias;
    echo <<<EOD
    <div class="clearfix codo_categories_category codo_category_children_shower">
        <div class="codo_category_img">
            <img draggable="false" src="$DURI$CAT_IMGS$cat->cat_img" />
        </div>
        <a href="$url"><div class="codo_category_title">$cat->cat_name</div></a>
        <div class="codo_category_content"><span class="codo_category_children_no_topics">$cat->no_topics </span>$topics
            $str
        </div>
    </div>
EOD;

    static $num_topics = 0;
    $num_topics++;
}
