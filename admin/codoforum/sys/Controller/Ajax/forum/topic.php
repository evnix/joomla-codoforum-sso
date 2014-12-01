<?php

/*
 * @CODOLICENSE
 */

namespace Controller\Ajax\forum;

class topic {

    public function __construct() {

        $this->db = \Lib\DB::get_db();
    }

    public function get_posts() {

        $from = (int) $_GET['from'];
        $tid = $_GET['tid'];

        $post = new \Lib\Forum\Post($this->db);

        $posts = array();
        $num_pages = 'not_passed';
        $posts_per_page = \Lib\Util::get_opt("num_posts_per_topic");

        if (isset($_GET['get_page_count']) && $_GET['get_page_count'] == 'yes') {

            $num_pages = 'calc_count';
        }


        if (isset($_GET['str']) && $_GET['str'] != "") {

            $search = new \Lib\Search\Search();
            $search->str = $_GET['str'];
            $search->num_results = $posts_per_page;
            $search->from = $from * $search->num_results;

            if ($num_pages == 'calc_count') {

                $search->count_rows = true;
            }

            $search->tid = $tid;
            $search->match_titles = 'No';
            $search->order = $_GET['order'];
            $search->sort = $_GET['sort'];
            $search->time_within = $_GET['search_within'];

            $res = $search->search($from);

            if ($num_pages == 'calc_count') {

                $num_pages = $post->get_num_pages($search->get_total_count(), $search->num_results);
            }
            
            $posts = $post->gen_posts_arr($res, $search);

            //var_dump($topics);
        } else {

            $topic = new \Lib\Forum\Topic($this->db);
            $topic_info = $topic->get_topic_info($tid);
            $num_pages = $topic->get_num_pages(
                    $topic_info['no_posts'], $posts_per_page
            );

            $posts = $post->get_posts($tid, $from);
        }



        $arr = $post->add_const_to_arr(array(
            "posts" => $posts,
            "reply" => _("reply"),
            "posted" => _("posted"),
            "tid" => $tid,
            "safe_title" => $_GET['title'],
            "num_pages" => $num_pages
                )
        );

        echo json_encode($arr);
    }

    public function inc_view() {

        $tid = (int) $_GET['topic_id'];

        //TODO: Keep on checking if this becomes reusable 
        $query = "UPDATE codo_topics SET no_views=no_views+1 WHERE topic_id=$tid";
        $res = $this->db->query($query);

        if ($res) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }

    public function reply() {

        //hacking attempt
        if ($_POST['end_of_line'] != "") {
            exit;
        }


        if (!\Lib\Access\Access::has_permission('reply to topic')) {
            if (!\Lib\User\CurrentUser\CurrentUser::logged_in()) {
                echo _("You must be logged in to reply");
            } else {
                echo _("You do not have permission to ") . _("reply");
            }
            exit;
        }

        if (isset($_POST['input_txt']) && isset($_POST['output_txt']) && isset($_POST['tid'])) {

            $topic = new \Lib\Forum\Topic($this->db);
            $post = new \Lib\Forum\Post($this->db);

            $in = $_POST['input_txt'];
            $out = $_POST['output_txt'];
            $tid = (int) $_POST['tid'];

            $catid = $topic->get_catid($tid);

            $pid = $post->ins_post($catid, $tid, $in, $out);

            $user = \Lib\User\CurrentUser\CurrentUser::load_user();

            $options = array(
                ":pid" => $pid,
                ":uid" => $user->id,
                ":name" => $user->username,
                ":time" => time(),
                ":tid" => $tid
            );

            $topic->update_last_post_details($options);

            echo json_encode(array("pid" => $pid)); //TODO: error logging and checks !
        }
    }

    public function upload() {

        if (!isset($_FILES)) {
            return;
        }
        $errors = array();
        $file_info = array();

        if (is_array($_FILES['file']['name'])) {

            $images = \Lib\Util::re_array_files($_FILES['file']);
        } else {

            $images = array($_FILES['file']);
        }


        foreach ($images as $image) {
            if (
                    !\Lib\File\Upload::valid($image) OR ! \Lib\File\Upload::not_empty($image) OR ! \Lib\File\Upload::size($image, (int) \Lib\Util::get_opt('forum_attachments_size')) OR ! \Lib\File\Upload::type($image, explode(",", \Lib\Util::get_opt('forum_attachments_exts')))) {
                $errors[] = "Error While uploading the image.";
            } else {

                $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                $file_info[] = \Lib\File\Upload::save($image, uniqid() . "." . $ext, DATA_PATH . \Lib\Util::get_opt('forum_attachments_path'), 0777);
            }
        }

        echo json_encode($file_info);
    }

    public function create() {

        //hacking attempt
        if ($_POST['end_of_line'] != "") {
            exit;
        }

        if (!\Lib\Access\Access::has_permission('create new topic')) {
            if (!\Lib\User\CurrentUser\CurrentUser::logged_in()) {
                echo "You must be logged in to create a topic ";
            } else {
                echo _("You do not have permission to ") . _("create a topic");
            }
            exit;
        }

        if (isset($_POST['title']) && isset($_POST['cat']) && isset($_POST['imesg']) && isset($_POST['omesg'])) {

            $catid = (int) ($_POST['cat']);

            $post = new \Lib\Forum\Post($this->db);
            $topic = new \Lib\Forum\Topic($this->db);

            $tid = $topic->ins_topic($catid, $_POST['title']);
            $pid = $post->ins_post($catid, $tid, $_POST['imesg'], $_POST['omesg']);
            $topic->link_topic_post($pid, $tid);

            echo "success";
        }
    }

    public function edit() {

        //hacking attempt
        if ($_POST['end_of_line'] != "") {
            exit;
        }


        $tid = (int) $_POST['tid'];
        $topic = new \Lib\Forum\Topic($this->db);

        $topic_info = $topic->get_topic_info($tid);
        //i have come to edit the topic

        $tuid = $topic_info['uid'];

        if ($tuid == \Lib\User\CurrentUser\CurrentUser::get_id()) {

            //can i edit my own topic ?
            $has_permission = \Lib\Access\Access::has_permission(array('edit my topic', 'edit all topics'));
        } else {

            //can i edit others topic ?
            $has_permission = \Lib\Access\Access::has_permission('edit all topics');
        }

        if ($has_permission) {


            if (isset($_POST['title']) && isset($_POST['cat']) && isset($_POST['imesg']) && isset($_POST['omesg'])) {

                $topic->edit_topic($tid, $topic_info['post_id'], $_POST['title'], $_POST['imesg'], $_POST['omesg']);
                echo "success";
            }
        } else {

            echo _("You do not have permission to ") . _("edit this topic");
        }
    }

    public function delete($id) {

        //post id
        $tid = (int) $id;

        $topic = new \Lib\Forum\Topic($this->db);

        //Set topic as deleted
        $topic->set_status($tid, 'DELETE');

        //update all posts linked with this topic as deleted
        //the post counts linked with all tables will be handled by
        //triggers

        $post = new \Lib\Forum\Post($this->db);
        $post->set_status_by_topic_id($tid, 'DELETE');

        echo 'success';
    }

}
