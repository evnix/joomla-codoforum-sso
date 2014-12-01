<?php

/*
 * @CODOLICENSE
 */

namespace Controller\Ajax\forum;

class category {

    public function __construct() {
        $this->db = \Lib\DB::get_db();
    }

    public function get_topics() {

        $from = (int) $_GET['from'];
        $cat_alias = $_GET['cat_alias'];

        $topic = new \Lib\Forum\Topic($this->db);


        $topics = array();
        $num_pages = 'not_passed';
        if (isset($_GET['get_page_count']) && $_GET['get_page_count'] == 'yes') {

            $num_pages = 'calc_count';
        }


        if (isset($_GET['str']) && $_GET['str'] != "") {

            $search = new \Lib\Search\Search();
            $search->str = $_GET['str'];
            $search->num_results = \Lib\Util::get_opt("num_posts_cat_topics");
            $search->from = $from * $search->num_results;

            if ($num_pages == 'calc_count') {

                $search->count_rows = true;
            }
            $cats = (int) $_GET['catid'];

            $search->cats = $cats;
            $search->match_titles = $_GET['match_titles'];
            $search->order = $_GET['order'];
            $search->sort = $_GET['sort'];
            $search->time_within = $_GET['search_within'];

            $res = $search->search($from);

            if ($num_pages == 'calc_count') {

                $num_pages = $topic->get_num_pages($search->get_total_count(), $search->num_results);
            }

            $topics = $topic->gen_topic_arr_all_topics($res, $search);

            //var_dump($topics);
        } else {
            
            $num_pages = $topic->get_num_pages(
                    $topic->get_num_topics((int) $_GET['catid']), \Lib\Util::get_opt("num_posts_cat_topics")
            );
            $topics = $topic->get_topics($cat_alias, $from);
        }


        $arr = $topic->add_const_to_arr(array(
            "topics" => $topics,
            "replies" => _("replies"),
            "views" => _("views"),
            "posted" => _("posted"),
            "read_more" => _('read more'),
            "recent_by" => _('recent by'),
            "cat_alias" => $cat_alias,
            "num_pages" => $num_pages
                )
        );

        echo json_encode($arr);
    }

}
