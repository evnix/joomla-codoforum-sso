<?php

/*
 * @CODOLICENSE
 */

namespace Controller\Ajax\forum;

class post {

    public function __construct() {

        $this->db = \Lib\DB::get_db();
    }

    public function edit() {

        //hacking attempt
        if ($_POST['end_of_line'] != "") {
            exit;
        }

        $pid = (int) $_POST['pid'];
        $qry = 'SELECT uid FROM ' . PREFIX . 'codo_posts WHERE post_id=' . $pid;
        $res = $this->db->query($qry);
        $result = $res->fetch();

        if ($result) {

            $puid = $result['uid'];

            if ($puid == \Lib\User\CurrentUser\CurrentUser::get_id()) {

                $has_permission = \Lib\Access\Access::has_permission(array('edit my post','edit all posts'));
            } else {

                $has_permission = \Lib\Access\Access::has_permission('edit all posts');
            }

            if ($has_permission &&
                    isset($_POST['input_txt']) && isset($_POST['output_txt']) && isset($_POST['tid'])) {


                $post = new \Lib\Forum\Post($this->db);

                $in = $_POST['input_txt'];
                $out = $_POST['output_txt'];

                $pid = $post->update_post($pid, $in, $out);

                echo 'success'; 
                
            } else {

                echo 'you are not authorized to edit this post';
            }
        } else {

            echo 'no post found';
        }
    }

    public function delete($id) {

        if (!\Lib\Access\Access::has_permission('delete all posts')) {

            echo "Unauthorized request to delete post " . $id;
            exit;
        }

        $post = new \Lib\Forum\Post($this->db);

        //SQL injection safe
        $pid = (int) $id;

        //Delete post ie set status as 0
        $post->set_status_by_post_id($pid, 'DELETE');

        echo 'success';
    }

    public function undelete($id) {

        if (!\Lib\Access\Access::has_permission('delete all posts')) {

            echo "Unauthorized request to delete post " . $id;
            exit;
        }

        $post = new \Lib\Forum\Post($this->db);

        //SQL injection safe
        $pid = (int) $id;

        //Undelete post ie set status as 1
        $post->set_status_by_post_id($pid, 'ACTIVE');

        echo 'success';
    }

}
