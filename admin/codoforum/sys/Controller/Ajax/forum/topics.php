<?php

/*
 * @CODOLICENSE
 */

namespace Controller\Ajax\forum;

class topics {

    public function __construct() {
        $this->db = \Lib\DB::get_db();
    }

    private $ids = array();

    /**
     *
     * Creates array of all children of passed $parents array
     *
     * @staticvar array $ids
     * @param type $branch
     * @param type $parents
     *
     */
    function get_children($branch, $parents) {

        if (property_exists($branch, 'children') && in_array($branch->cat_id, $parents)) {

            foreach ($branch->children as $child) {
                $this->ids[] = $child->cat_id;
                $parents = array_merge($parents, array($child->cat_id));
                $this->get_children($child, $parents);
            }
        }
    }

    public function get_topics() {

        $from = (int) $_GET['from'];

        /* if(!$from) {

          $from = \Lib\Util::get_opt('num_posts_all_topics');
          } */

        $topic = new \Lib\Forum\Topic($this->db);
        $topic->ajax = true;

        $topics = array();
        if (isset($_GET['str']) && $_GET['str'] != "") {

            $search = new \Lib\Search\Search();
            $search->str = $_GET['str'];
            $search->from = $from;


            //include sub categories ?
            if ($_GET['search_subcats'] == 'Yes') {
                $cat = new \Lib\Forum\Category($this->db);

                //get sub categories of all selected categories
                $tree = $cat->generate_tree($cat->get_categories());
                foreach ($tree as $branch) {

                    $this->get_children($branch, $_GET['cats']);
                }
            }

            $cat_ids = array_merge($this->ids, $_GET['cats']);
            $cats = implode(",", $cat_ids);

            $search->cats = $cats;
            $search->match_titles = $_GET['match_titles'];
            $search->order = $_GET['order'];
            $search->sort = $_GET['sort'];
            $search->time_within = $_GET['search_within'];

            $res = $search->search($from);

            $topics = $topic->gen_topic_arr_all_topics($res, $search);

            //var_dump($topics);
        } else {

            $topics = $topic->get_all_topics($from);
        }


        echo json_encode(
                array(
                    "topics" => $topics,
                    "RURI" => RURI,
                    "DURI" => DURI,
                    "CAT_IMGS" => CAT_IMGS,
                    "DEF_AVATAR" => DEF_AVATAR,
                    "CURR_THEME" => CURR_THEME,
                    "reply_txt" => _("replies"),
                    "views_txt" => _("views"),
                    "recent_txt" => _('recent by'),
                    "num_posts" => \Lib\Util::get_opt('num_posts_all_topics')
                )
        );
    }

}
