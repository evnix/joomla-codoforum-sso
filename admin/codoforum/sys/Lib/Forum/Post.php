<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Forum;

class Post extends Forum {

    //put your code here

    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * 
     * Gets information of posts og given topic id paginated
     * 
     * @param type $tid
     * @param type $from
     * @return type
     */
    public function get_posts($tid, $from = 0) {

        //$tid is converted to integer so its safe
        //show oldest first
        $posts = array();
        $num_posts = \Lib\Util::get_opt("num_posts_per_topic");
        $from *= $num_posts;

        $qry = "SELECT u.id, u.rid, u.username AS name, u.avatar, u.no_posts, u.signature, "
                . "p.post_id, p.omessage AS message,p.imessage, p.post_created, p.post_modified "
                . "FROM codo_posts AS p "
                . "LEFT JOIN codo_users AS u ON u.id=p.uid "
                . "WHERE p.topic_id=$tid AND p.post_status=1 ORDER BY post_created "
                . "LIMIT " . $num_posts . " OFFSET " . $from;

        $res = $this->db->query($qry);

        if ($res) {

            $posts = $this->gen_posts_arr($res->fetchAll());
        }

        return $posts;
    }

    public function get_post_info($pid) {

        $pid = (int) $pid;

        $qry = 'SELECT cat_id, topic_id, uid FROM ' . PREFIX . 'codo_posts WHERE post_id=' . $pid;
        $obj = $this->db->query($qry);
        $res = $obj->fetch();

        return $res;
    }

    /**
     * 
     * Gets number of posts made before the post passed for the topic passed
     * @param type $tid topic id
     * @param type $pid post id
     * @return type
     */
    public function get_num_prev_posts($tid, $pid) {

        $qry = 'SELECT COUNT(post_id) FROM ' . PREFIX . 'codo_posts WHERE topic_id=' . $tid . ' AND post_id<' . $pid;
        $obj = $this->db->query($qry);
        $res = $obj->fetch();
        
        return (int)$res[0];
    }

    /**
     * 
     * Sets the given post(post id) status
     * @param String status
     * @param type $pid
     */
    public function set_status_by_post_id($pid, $option) {

        $post_status = $this->get_status($option);
        $pid = (int) $pid;

        $qry = 'UPDATE ' . PREFIX . 'codo_posts SET post_status=' . $post_status . ' WHERE post_id=' . $pid;
        $this->db->query($qry);
    }

    /**
     * 
     * Sets the given post(topic id) status
     * @param String status
     * @param type $pid
     */
    public function set_status_by_topic_id($pid, $option) {

        $post_status = $this->get_status($option);
        $pid = (int) $pid;

        $qry = 'UPDATE ' . PREFIX . 'codo_posts SET post_status=' . $post_status . ' WHERE topic_id=' . $pid;
        $this->db->query($qry);
    }

    /**
     * 
     * Increments number of topics for the given category in codo_categories table
     * @param type $catid
     * @param type $inc_posts
     */
    public function inc_posts($catid, $inc_topics = false) {


        /**
         * if else statement added just to save a double query
         */
        if ($inc_topics) {
            $qry = "UPDATE codo_categories SET no_topics=no_topics+1, no_posts=no_posts+1 WHERE cat_id=$catid";
        } else {
            $qry = "UPDATE codo_categories SET no_posts=no_posts+1 WHERE cat_id=$catid";
        }
        $this->db->query($qry);
    }

    /**
     * 
     * Decrements number of topics for the given category in codo_categories table
     * @param type $catid
     * @param type $inc_posts
     */
    public function dec_posts($catid, $dec_topics = false) {

        /**
         * if else statement added just to save a double query
         */
        if ($dec_topics) {
            $qry = "UPDATE codo_categories SET no_topics=no_topics-1, no_posts=no_posts-1 WHERE cat_id=$catid";
        } else {
            $qry = "UPDATE codo_categories SET no_posts=no_posts-1 WHERE cat_id=$catid";
        }

        $this->db->query($qry);
    }

    /**
     * 
     * Used when editing post , updates post with new message
     * @param type $pid
     * @param type $imesg
     * @param type $omesg
     */
    public function update_post($pid, $imesg, $omesg) {

        $time = time();

        $qry = 'UPDATE ' . PREFIX . 'codo_posts SET imessage=:imesg, omessage=:omesg, post_modified=:time'
                . ' WHERE post_id=:pid';

        $stmt = $this->db->prepare($qry);
        $stmt->execute(array(
            ":imesg" => \Lib\Format::imessage($imesg),
            ":omesg" => \Lib\Format::omessage($omesg),
            ":time" => $time,
            ":pid" => $pid
        ));
    }

    /**
     * Inserts a new post in codo_posts
     * 
     * @param type $catid
     * @param type $tid
     * @param type $imesg
     * @param type $omesg
     */
    public function ins_post($catid, $tid, $imesg, $omesg) {

        \Lib\Hook::call('before_post_insert');

        $time = time();

        $uid = $_SESSION[UID . 'USER']['id'];

        //$message = \Lib\Filter::msg_safe($mesg);
        //$mesg = nl2br($message);

        $qry = 'INSERT INTO codo_posts (topic_id,cat_id,uid,imessage,omessage,post_created) '
                . 'VALUES(:tid, :cid, :uid, :imesg, :omesg, :post_created)';

        $stmt = $this->db->prepare($qry);

        $params = array(
            ":tid" => $tid,
            ":cid" => $catid,
            ":uid" => $uid,
            ":imesg" => \Lib\Format::imessage($imesg),
            ":omesg" => \Lib\Format::omessage($omesg),
            ":post_created" => $time
        );

        $this->success = $stmt->execute($params);
        $pid = $this->db->lastInsertId();

        if ($this->success) {

            \Lib\Hook::call('after_post_insert', $pid);
        }

        return $pid;
    }

    /** private functions --------------------------------------------------------- */
    public function gen_posts_arr($posts, $search = false) {

        $_posts = array();
        $uid = \Lib\User\CurrentUser\CurrentUser::get_id();
        $user = new \Lib\User\User($this->db);

        $i = 0;
        foreach ($posts as $post) {

            $message = \Lib\Format::message($post['message']);

            if($search) {
                
                $message = $search->get_matching_str($message);
            }

            $_posts[$i] = array(
                "id" => $post['id'],
                "avatar" => \Lib\Util::get_avatar_path($post['avatar']),
                "name" => $post['name'],
                "post_created" => \Lib\Time::get_pretty_time($post['post_created']),
                "post_modified" => \Lib\Time::get_pretty_time($post['post_modified']),
                "post_id" => $post['post_id'],
                "message" => $message,
                "imessage" => $post['imessage'],
                "role" => $user->get_rname($post['rid']),
                "no_posts" => \Lib\Util::abbrev_no($post['no_posts'], 1),
                "signature" => $post['signature']
            );

            if ($post['id'] == $uid) {

                //this topic belongs to current user
                $_posts[$i]['can_edit_post'] = \Lib\Access\Access::has_permission(array('edit my post', 'edit all posts'));
                $_posts[$i]['can_delete_post'] = \Lib\Access\Access::has_permission(array('delete my post', 'delete all posts'));
            } else {

                $_posts[$i]['can_edit_post'] = \Lib\Access\Access::has_permission('edit all posts');
                $_posts[$i]['can_delete_post'] = \Lib\Access\Access::has_permission('delete all posts');
            }

            
            if($search) {
                
                $_posts[$i]['in_search'] = true;
            }
            
            $i++;
        }

        return $_posts;
    }

    private function get_status($option) {

        $status = array(
            "DELETE" => 0,
            "ACTIVE" => 1
        );

        return $status[$option];
    }

}
