<?php

/*
 * @CODOLICENSE
 */

namespace Controller;

/*
 *
 * Links
 *
 * When new topic is created
 * inc num_posts, num_topics in codo_topics
 * inc num_posts in codo_users
 *
 * When new post is created
 * inc num_posts in codo_topics
 * inc num_posts in codo_users
 *
 */

/*
 * forum
 * forum/topics -> displays all topics
 * forum/topics/:cat_name -> displays topics of that category
 * forum/topic/:topicid/ [add topicname to the url] -> displays posts for that topic
 * forum/topic/:topicid#post-postid -> displays(scrolls to) that post for that topic
 *
 * post <=> comment
 */

use Lib\Access\Access;

class forum {

    private $db;
    private $smarty;
    public $css_files;
    public $js_files;

    public function __construct() {
        $this->smarty = \Lib\Smarty\Single::get_instance();
        $this->db = \Lib\DB::get_db();
    }

    public function manage_topic($id = false) {

        $topic_info = '';

        if ($id) {

            $tid = (int) $id;
            $qry = 'SELECT t.topic_id,t.title, t.cat_id, t.uid, c.cat_name, p.imessage '
                    . 'FROM ' . PREFIX . 'codo_topics AS t '
                    . 'INNER JOIN ' . PREFIX . 'codo_categories AS c ON c.cat_id=t.cat_id '
                    . 'INNER JOIN ' . PREFIX . 'codo_posts AS p ON p.topic_id=t.topic_id '
                    . 'WHERE t.topic_id=' . $tid;
            $res = $this->db->query($qry);

            $topic_info = $res->fetch();
            //i have come to edit the topic

            $tuid = $topic_info['uid'];

            if ($tuid == \Lib\User\CurrentUser\CurrentUser::get_id()) {

                //can i edit my own topic ?
                $has_permission = Access::has_permission(array('edit my topic', 'edit all topics'));
            } else {

                //can i edit others' topic ?
                $has_permission = Access::has_permission('edit all topics');
            }
        } else {

            $topic_info = array(
                "title" => "",
                "imessage" => "",
                "cat_id" => 0,
                "topic_id" => 0
            );

            //i have come to create a new topic

            $has_permission = Access::has_permission('create new topic');
        }

        if ($has_permission) {

            if ($id) {

                \Lib\Store::set('sub_title', _('Edit topic ') . $topic_info['title']);
            } else {

                \Lib\Store::set('sub_title', _('Create topic'));
            }

            $cat = new \Lib\Forum\Category($this->db);
            $cats = $cat->generate_tree($cat->get_categories());

            $this->smarty->assign('cats', $cats);
            $this->assign_editor_vars();

            $this->smarty->assign('topic', $topic_info);

            $this->css_files = array('new_topic', 'editor');
            $this->js_files = $cat->get_js_editor_files();

            $this->view = 'forum/new_topic';
        } else {

            header('Location: ' . \Lib\User\User::get_profile_url());
            //$this->view = 'access_denied';
        }
    }

    public function category($catid, $page) {

        $search_conds = false;

        if (isset($_GET['search']) && $_GET['search'] != null) {

            $search_conds = json_decode($_GET['search']);
            $search_data = $_GET['search'];
        } else {

            $search_data = '{}';
        }

        if ($page == null) {
            $from = 0;
        } else {
            $from = (int) $page;
            $from--;
        }

        $cat = new \Lib\Forum\Category($this->db);
        $topic = new \Lib\Forum\Topic($this->db);

        $cat_info = $cat->get_cat_info($catid);
        $cid = $cat_info['cat_id'];

        if (!$cat_info) {

            $this->view = 'not_found';
            return;
        }


        $this->smarty->assign('sub_cats', $cat->get_sub_categories($cid));

        $topics = array();
        $num_results = \Lib\Util::get_opt("num_posts_cat_topics");

        if ($search_conds && property_exists($search_conds, 'str') && $search_conds->str != "") {

            $search = new \Lib\Search\Search();
            $search->str = $search_conds->str;
            $search->from = $from;
            $search->num_results = $num_results;

            $cats = (int) $search_conds->cats;

            $search->cats = $cats;
            $search->match_titles = $search_conds->match_titles;
            $search->order = $search_conds->order;
            $search->sort = $search_conds->sort;
            $search->time_within = $search_conds->search_within;
            $search->count_rows = true;

            $res = $search->search($from);

            $num_pages = $cat->get_num_pages(
                    $search->get_total_count(), $num_results
            );

            if ($from >= $num_pages) {
                $from = $num_pages - 1;
            }

            $topics = $topic->gen_topic_arr_all_topics($res, $search);
        } else {

            $num_pages = $cat->get_num_pages(
                    $topic->get_num_topics($cid), $num_results
            );

            if ($from >= $num_pages) {
                $from = $num_pages - 1;
            }
            $topics = $topic->get_topics($catid, $from);
        }




        $this->smarty->assign('topics', $topics);
        $this->smarty->assign('cat_info', $cat_info);
        $this->smarty->assign('cat_alias', $catid);
        $this->smarty->assign('num_pages', $num_pages);
        $this->smarty->assign('curr_page', $from + 1); //starts from 1
        $this->smarty->assign('pagination', $cat->paginate($num_pages, $from + 1, 'forum/topics/' . $catid . '/'));
        $this->smarty->assign('search_data', $search_data);

        $this->assign_editor_vars();
        $this->smarty->assign('constants', json_encode(array('RURI' => RURI, 'cat_alias' => $catid)));
        $this->css_files = array('category', 'editor');

        $arr = array(
            DURI . 'assets/js/category/category.js',
            DURI . 'assets/js/category/jquery.easing.1.3.js'
        );

        $this->js_files = array_merge($arr, $cat->get_js_editor_files());

        $this->view = 'forum/category';
        \Lib\Store::set('sub_title', $cat_info['cat_name']);
    }


    public function topics() {

        $cat = new \Lib\Forum\Category($this->db);
        $topic = new \Lib\Forum\Topic($this->db);

        //gets category name and no of topics each hold
        $raw_cats = $cat->get_categories();
        $cats = $cat->generate_tree($raw_cats);
        //get complete list of topics

        $cat->update_count($cats);


        $arr = $cat->add_const_to_arr(array(
            "topics" => $topic->get_all_topics(),
            "reply_txt" => _("replies"),
            "views_txt" => _("views"),
            "recent_txt" => _('recent by'),
            "num_posts" => \Lib\Util::get_opt('num_posts_all_topics')
                )
        );

        $option_size = count($raw_cats);
        if ($option_size > 10) {

            $option_size = 10;
        }

        $topics = json_encode($arr);
        $this->smarty->assign('topics', $topics);
        $this->smarty->assign('total_num_topics', $topic->get_total_num_topics());
        $this->smarty->assign('cats', $cats);
        $this->smarty->assign('subcategory_dropdown', \Lib\Util::get_opt('subcategory_dropdown'));
        $this->smarty->assign('option_size', $option_size);
        $this->smarty->assign('num_posts_per_page', \Lib\Util::get_opt('num_posts_all_topics'));

        $this->css_files = array('topics');

        $this->js_files = array('topics/topics.js');
        $this->view = 'forum/topics';
        \Lib\Store::set('sub_title', _('All topics'));
    }

    public function topic($tid, $page) {

        $search_conds = false;

        if (isset($_GET['search']) && $_GET['search'] != null) {

            $search_conds = json_decode($_GET['search']);
            $search_data = $_GET['search'];
        } else {

            $search_data = '{}';
        }


        if ($page == null || (int) $page == 0) {
            $from = 0;
        } else {
            $from = (int) $page;
            $from--;
        }

        $topic = new \Lib\Forum\Topic($this->db);
        $post = new \Lib\Forum\Post($this->db);

        $topic_info = $topic->get_topic_info($tid);

        if (!$topic_info) {

            $this->view = 'not_found';
        } else {
            $topic_info['no_replies'] = $topic_info['no_posts'] - 1;

            $posts_per_page = \Lib\Util::get_opt("num_posts_per_topic");
            $posts = array();

            if ($search_conds && property_exists($search_conds, 'str') && $search_conds->str != "") {

                $search = new \Lib\Search\Search();
                $search->str = $search_conds->str;
                $search->num_results = $posts_per_page;
                $search->from = $from * $search->num_results;
                $search->count_rows = true;

                $search->tid = $tid;
                $search->match_titles = 'No';
                $search->order = $search_conds->order;
                $search->sort = $search_conds->sort;
                $search->time_within = $search_conds->search_within;

                $res = $search->search($from);

                $num_pages = $topic->get_num_pages(
                        $search->get_total_count(), $posts_per_page
                );

                if ($from >= $num_pages) {
                    $from = $num_pages - 1;
                }

                $posts = $post->gen_posts_arr($res, $search);
            } else {

                $num_pages = $topic->get_num_pages(
                        $topic_info['no_posts'], $posts_per_page
                );

                if ($from >= $num_pages && $num_pages) {
                    $from = $num_pages - 1;
                }

                if (strpos($page, "post-") !== FALSE) {

                    $pid = (int) str_replace("post-", "", $page);

                    $prev_posts = $post->get_num_prev_posts($tid, $pid);
                    $from = floor(($prev_posts) / $posts_per_page);
                }

                $posts = $post->get_posts($tid, $from);
            }


            $this->smarty->assign('posts', $posts);
            $this->smarty->assign('topic_info', $topic_info);
            $this->smarty->assign('search_data', $search_data);


            $name = \Lib\Filter::URL_safe($topic_info['title']);
            $url = 'forum/topic/' . $topic_info['topic_id'] . '/' . $name . '/';
            $this->smarty->assign('pagination', $post->paginate($num_pages, $from + 1, $url));


            if (ceil(($topic_info['no_posts'] + 1 ) / $posts_per_page) > $num_pages) {

                //next reply will go to next page
                $this->smarty->assign('new_page', 'yes');
            } else {

                $this->smarty->assign('new_page', 'nope');
            }

            $this->smarty->assign('num_pages', $num_pages);
            $this->smarty->assign('curr_page', $from + 1); //starts from 1
            $this->smarty->assign('url', RURI . $url);
            $this->assign_editor_vars();

            $tuid = $topic_info['uid'];
            $this->assign_admin_vars($tuid);

            $this->css_files = array('topic', 'editor');
            $arr = array(
                'topic/topic.js',
                'modal.js'
            );

            $this->js_files = array_merge($arr, $post->get_js_editor_files());

            $this->view = 'forum/topic';
            \Lib\Store::set('sub_title', $topic_info['title']);
        }
    }

    private function assign_editor_vars() {

        $this->smarty->assign('max_file_size', \Lib\Util::get_opt('forum_attachments_size'));
        $this->smarty->assign('allowed_file_mimetypes', \Lib\Util::get_opt('forum_attachments_mimetypes'));
        $this->smarty->assign('forum_attachments_parallel', \Lib\Util::get_opt('forum_attachments_parallel'));
        $this->smarty->assign('forum_attachments_multiple', \Lib\Util::get_opt('forum_attachments_multiple'));
        $this->smarty->assign('forum_attachments_max', \Lib\Util::get_opt('forum_attachments_max'));
        $this->smarty->assign('forum_smileys', json_encode(\Lib\Util::get_smileys($this->db)));
        $this->smarty->assign('reply_min_chars', \Lib\Util::get_opt('reply_min_chars'));
    }

    private function assign_admin_vars($tuid) {

        if ($tuid == \Lib\User\CurrentUser\CurrentUser::get_id()) {

            //this topic belongs to current user
            $this->smarty->assign('can_edit_topic', json_encode(Access::has_permission(array('edit my topic', 'edit all topics'))));
            $this->smarty->assign('can_delete_topic', json_encode(Access::has_permission(array('delete my topic', 'delete all topics'))));
        } else {

            $this->smarty->assign('can_edit_topic', json_encode(Access::has_permission('edit all topics')));
            $this->smarty->assign('can_delete_topic', json_encode(Access::has_permission('delete all topics')));
        }
    }

}
