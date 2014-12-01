<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Forum;

class Category extends Forum {

    protected $db;
    public static $child_ids = array();

    public function __construct($storage) {

        $this->db = $storage;
    }
    
    public static function get_alias($name) {
        
        return \Lib\Filter::URL_safe($name);
    }

    /**
     * Fetches all categories information from codo_categories table     * 
     * @return type
     */
    public function get_categories() {

        $cats = array();

        $qry = 'SELECT cat_id, cat_pid, cat_name, cat_alias, no_topics, cat_img FROM codo_categories ORDER BY cat_order';
        $ans = $this->db->query($qry);

        if ($ans) {

            $cats = $ans->fetchAll(\PDO::FETCH_CLASS);
        }
        return $cats;
    }


    /**
     * 
     * Fetches ctaegory from given cat_alias
     * @param type $cat_alias
     * @return type
     */
    public function get_cat_info($cat_alias) {

        $qry = 'SELECT cat_id, cat_name, cat_description, cat_img, no_topics, no_posts FROM codo_categories '
                . ' WHERE cat_alias=:cat_alias LIMIT 1';

        $stmt = $this->db->prepare($qry);
        $ans = $stmt->execute(array(":cat_alias" => $cat_alias));

        if ($ans) {

            $cat_info = $stmt->fetch();
        }

        return $cat_info;
    }
    

    public function get_sub_categories($pid) {

        $qry = "SELECT cat_id, cat_pid, cat_name, cat_alias, cat_img, no_topics FROM codo_categories";

        $obj = $this->db->query($qry);

        $cats = $this->generate_tree($obj->fetchAll(\PDO::FETCH_CLASS));

        $cat = $this->get_this_cat($cats, $pid);

        $sub_cats = array();

        if (property_exists($cat, 'children')) {

            $sub_cats = $this->linearize($cat->children);
        }

        return $sub_cats;
    }

    /**
     * Gets the name of the category of passed id
     * @param <array> $id
     */
    public function get_cat_names_by_id($ids) {
        
        $q_ids = implode(',', $ids);
        $qry = 'SELECT cat_name,cat_id FROM '.PREFIX.'codo_categories WHERE cat_id IN (' . $q_ids . ')';
        $res = $this->db->query($qry);
        
        $cat_names = $res->fetchAll();
        
        return $cat_names;
    }
/** private functions --------------------------------------------------------**/    

    private function get_this_cat(&$cats, $pid) {


        foreach ($cats as $cat) {

            if ($cat->cat_id == $pid) {
                return $cat;
            } else if (property_exists($cat, 'children')) {

                return $this->get_this_cat($cat->children, $pid);
            }
        }

        return false;
    }

    private function linearize($cats) {

        $scats = array();

        foreach ($cats as $cat) {

            $cnt = \Lib\Util::count_children($cat);

            //create an associative array for our use
            $scats[] = array(
                "cat_id" => $cat->cat_id,
                "cat_name" => $cat->cat_name,
                "cat_img" => $cat->cat_img,
                "cat_alias" => $cat->cat_alias,
                "no_topics" => $cat->no_topics,
                "no_sub_cats" => $cnt
            );
        }

        return $scats;
    }

}
