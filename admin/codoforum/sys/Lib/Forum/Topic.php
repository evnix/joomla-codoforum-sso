<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Forum;

class Topic extends Forum {

    //put your code here

    protected $db;
    public $ajax = false;

    public function __construct($db) {

        $this->db = $db;
    }

    //TODO: make this a little more reusable
    public function get_topics($cat_alias, $from = 0) {

        $topics = array();
        $num_posts = \Lib\Util::get_opt("num_posts_cat_topics");
        $from *= $num_posts;

        //username , title, topic created, no of replies,
        $qry = 'SELECT p.post_id,p.omessage AS message, p.post_created, u.id, u.username AS name, u.avatar, '
                . 't.topic_id, t.uid, t.no_posts, t.no_views, t.title, '
                . 't.last_post_name AS lname, t.last_post_uid AS luid, t.last_post_time AS lpost_time '
                . 'FROM codo_topics AS t '
                . 'INNER JOIN codo_posts AS p ON (t.post_id=p.post_id AND p.post_status=1) '
                . 'LEFT JOIN codo_users AS u ON u.id=p.uid '
                . 'INNER JOIN codo_categories AS c ON c.cat_id=t.cat_id '
                . 'WHERE c.cat_alias=:cat_alias AND t.topic_status<>0 '
                . 'ORDER BY p.post_created DESC LIMIT ' . $num_posts . ' OFFSET ' . $from;

        $stmt = $this->db->prepare($qry);
        $ans = $stmt->execute(array(":cat_alias" => $cat_alias));

        if ($ans) {

            $topics = $stmt->fetchAll();
            return $this->gen_topic_arr($topics);
        }

        return $topics;
    }

    //TODO: make this a little more reusable
    public function get_all_topics($from = 0) {

        $_topics = array();

        $num_posts = \Lib\Util::get_opt("num_posts_all_topics");
        //username , title, topic created, no of replies,
        $qry = 'SELECT p.post_id, p.omessage AS message, p.post_created, u.id, u.username as name, u.avatar, c.cat_img, c.cat_alias,'
                . 't.topic_id, t.uid, t.title, t.no_posts, t.no_views, t.last_post_time, t.last_post_uid, t.last_post_name AS last_post_name '
                . 'FROM codo_topics AS t '
                . 'LEFT JOIN codo_posts AS p ON (t.post_id=p.post_id AND p.post_status=1)'
                . 'LEFT JOIN codo_users AS u ON u.id=p.uid '
                . 'LEFT JOIN codo_categories AS c ON c.cat_id=t.cat_id '
                . 'WHERE t.topic_status<>0 '
                . 'ORDER BY p.post_created DESC LIMIT  ' . $from . ', ' . $num_posts;

        $ans = $this->db->query($qry);

        if ($ans) {

            $topics = $ans->fetchAll();
            $_topics = $this->gen_topic_arr_all_topics($topics);
        }

        return $_topics;
    }

    /**
     *
     * Inserts new topic inside codo_topics
     *
     * @param type $catid Category id of the new topic
     * @param type $title title of the new topic
     *
     * returns topic id of the newly inserted topic
     */
    public function ins_topic($catid, $title) {

        $time = time();
        $uid = $_SESSION[UID . 'USER']['id'];
        $catid = (int)$catid;

        $qry = "INSERT INTO codo_topics (title, cat_id, uid, topic_created) "
                . "VALUES(:title, :catid, :uid, :time)";

        $stmt = $this->db->prepare($qry);
        $this->success = $stmt->execute(array(
            ":title" => \Lib\Format::imessage($title),
            ":catid" => $catid,
            ":uid" => $uid,
            ":time" => $time
        ));

        return $this->db->lastInsertId();
    }

    /**
     *
     * Gets category id from given topic id
     * @param type $topic_id
     * @return boolean
     */
    public function get_catid($topic_id) {

        $topic_id = (int) $topic_id;

        $qry = 'SELECT cat_id FROM ' . PREFIX . 'codo_topics WHERE topic_id=' . $topic_id;
        $res = $this->db->query($qry);

        if ($res) {

            $result = $res->fetch();
            return $result['cat_id'];
        }

        return false; //an error occured
    }

    /**
     *
     * Links the gievn post with the given topic
     * @param type $pid
     * @param type $tid
     */
    public function link_topic_post($pid, $tid) {

        $qry = "UPDATE codo_topics SET post_id = $pid WHERE topic_id = $tid";
        $this->db->query($qry);
    }

    /**
     *
     * Gets information about the topic of the given topic id
     *
     * @param type $tid
     * @return type
     */
    public function get_topic_info($tid) {

        //$tid is converted to integer so its safe

        $qry = "SELECT t.topic_id,t.post_id, t.no_posts, t.no_views,t.uid,"
                . "t.title, c.cat_name,t.post_id, c.cat_alias "
                . "FROM codo_topics AS t "
                . "INNER JOIN codo_categories AS c ON c.cat_id=t.cat_id "
                . "WHERE t.topic_id=$tid AND t.topic_status<>0 LIMIT 1 OFFSET 0";

        $res = $this->db->query($qry);

        if ($res) {
            return $res->fetch();
        }

        return false;
    }
    
    /** 
     * 
     * Get topic information by id
     */

    public function get_topic_by_id($tid, $req = '*') {
        
        $tid = (int)$tid;
        
        $qry = "SELECT $req FROM ".PREFIX."codo_topics WHERE topic_id=$tid";
        $res = $this->db->query($qry);
        
        if($res)  {
            return $res->fetch();
        }else{
            return false;
        }
    }
    
    /**
     *
     * updates all fileds of codo_topics to latest post
     * @param type $options
     */
    public function update_last_post_details($options) {

        $qry = 'UPDATE ' . PREFIX . 'codo_topics SET last_post_id=:pid, '
                . ' last_post_uid=:uid, last_post_name=:name, last_post_time=:time '
                . 'WHERE topic_id=:tid';
        
        $stmt = $this->db->prepare($qry);
        $stmt->execute($options);
        
    }

    /**
     *
     * Edits current topic
     */
    public function edit_topic($tid, $pid, $title, $imessage, $omessage) {

        $tid = (int)$tid;
        $pid = (int)$pid;
        $title = \Lib\Format::imessage($title);
        
        $qry = 'UPDATE ' . PREFIX . 'codo_topics SET title=:title, topic_updated=:time '
                . 'WHERE topic_id=:tid';

        $t_stmt = $this->db->prepare($qry);
        $t_stmt->execute(array(":title" => $title, ":time" => time(), ":tid" => $tid));

        $qry = 'UPDATE ' . PREFIX . 'codo_posts SET imessage=:imesg, omessage=:omesg,'
                . 'post_modified=:time WHERE post_id=:pid';

        $p_stmt = $this->db->prepare($qry);
        $p_stmt->execute(
                array(
            ":imesg" => \Lib\Format::imessage($imessage),
            ":omesg" => \Lib\Format::omessage($omessage),
            ":time" => time(),
            ":pid" => $pid
                ));
    }

    /**
     *
     * Gets number of topics present in given category(category id)
     *
     * @param type $cid
     * @return type
     */
    public function get_num_topics($cid) {

        $cid = (int) $cid;
        $qry = "SELECT no_topics FROM codo_categories WHERE cat_id=$cid";
        $stmt = $this->db->query($qry);
        $res = $stmt->fetch();

        return $res['no_topics'];
    }

    /**
     * 
     * Returns total number of topics in all categories
     * @return type int
     */
    public function get_total_num_topics() {
        
        $qry = "SELECT SUM(no_topics) AS total_num_topics FROM ".PREFIX."codo_categories";
        $obj = $this->db->query($qry);
        $res = $obj->fetch();
        
        return $res['total_num_topics'];
    }
    /**
     * Changes status of the topic with given topic id
     * @param type $id post id
     * @param type $option
     */
    public function set_status($id, $option) {

        $tid = (int) $id;

        $status = array(
            "DELETE" => 0,
            "ACTIVE" => 1,
            "STICKY" => 2,
            "LOCKED" => 3
        );

        $qry = 'UPDATE ' . PREFIX . 'codo_topics SET topic_status=' . $status[$option] . ' '
                . 'WHERE topic_id=' . $tid;
        $this->db->query($qry);
    }

    /*     * ** private methods ------------------------------------------------------ ** */

    //TODO: make this a little more reusable
    public function gen_topic_arr_all_topics($topics, $search = false) {

        $_topics = array();
        $uid = \Lib\User\CurrentUser\CurrentUser::get_id();
        
        $i = 0;
        foreach ($topics as $topic) {
 
            $message = \Lib\Format::message($topic['message']);
            if($search) {
                
                $message = $search->get_matching_str($message);
            }
            
            //$message = \Lib\Util::br2nl($message);

            if (!$this->ajax) {
            //    $message = \Lib\Filter::json_safe($message);
            }

            /* if (strlen($message) > 200) {

              $message = substr($message, 0, 200) . "...";
              } */


            $_topics[$i] = array(
                "cat_alias" => $topic['cat_alias'],
                "cat_img" => $topic['cat_img'],
                "id" => $topic['id'],
                "avatar" => \Lib\Util::get_avatar_path($topic['avatar']),
                "name" => $topic['name'],
                "post_created" => \Lib\Time::get_pretty_time($topic['post_created']),
                "topic_id" => $topic['topic_id'],
                "post_id" => $topic['post_id'],
                "safe_title" => \Lib\Filter::URL_safe($topic['title']),
                "title" => \Lib\Util::mid_cut($topic['title'], 200),
                "no_replies" => \Lib\Util::abbrev_no(($topic['no_posts'] - 1), 1),
                "no_views" => \Lib\Util::abbrev_no($topic['no_views'], 1),
                "last_post_uid" => $topic['last_post_uid'],
                "last_post_name" => $topic['last_post_name'],
                "last_post_time" => \Lib\Time::get_pretty_time($topic['last_post_time']),
                "message" => $message
            );
            
            if($search && $search->match_titles == 'Yes') {
                $_topics[$i]['title'] = $search->highlight($_topics[$i]['title']);
            }
            
            if($topic['uid'] == $uid) {
                
                //this topic belongs to current user
                $_topics[$i]['can_edit_topic'] = \Lib\Access\Access::has_permission(array('edit my topic', 'edit all topics'));
                $_topics[$i]['can_delete_topic'] = \Lib\Access\Access::has_permission(array('delete my topic', 'delete all topics'));
            } else {

                $_topics[$i]['can_edit_topic'] = \Lib\Access\Access::has_permission('edit all topics');
                $_topics[$i]['can_delete_topic'] = \Lib\Access\Access::has_permission('delete all topics');
            }
            
            if($search) {
                
                $_topics[$i]['in_search'] = true;
            }
            
            $i++;
            
        }

        return $_topics;
    }

    //TODO: make this a little more reusable
    private function gen_topic_arr($topics) {

        $_topics = array();
        $uid = \Lib\User\CurrentUser\CurrentUser::get_id();
        
        $i = 0;
        
        foreach ($topics as $topic) {

            $message = \Lib\Format::message($topic['message']);

            $_topics[$i] = array(
                "id" => $topic['id'],
                "avatar" => \Lib\Util::get_avatar_path($topic['avatar']),
                "name" => $topic['name'],
                "post_created" => \Lib\Time::get_pretty_time($topic['post_created']),
                "topic_id" => $topic['topic_id'],
                "post_id" => $topic['post_id'],                
                "safe_title" => \Lib\Filter::URL_safe($topic['title']),
                "title" => $topic['title'],
                "no_replies" => \Lib\Util::abbrev_no(($topic['no_posts'] - 1), 1),
                "no_views" => \Lib\Util::abbrev_no($topic['no_views'], 1),
                "message" => $message,
                "last_post_name" => $topic['lname'],
                "last_post_uid" => $topic['luid'],
                "last_post_time" => \Lib\Time::get_pretty_time($topic['lpost_time']),
            );
            
            if($topic['uid'] == $uid) {
                
                //this topic belongs to current user
                $_topics[$i]['can_edit_topic'] = \Lib\Access\Access::has_permission(array('edit my topic', 'edit all topics'));
                $_topics[$i]['can_delete_topic'] = \Lib\Access\Access::has_permission(array('delete my topic', 'delete all topics'));
            } else {

                $_topics[$i]['can_edit_topic'] = \Lib\Access\Access::has_permission('edit all topics');
                $_topics[$i]['can_delete_topic'] = \Lib\Access\Access::has_permission('delete all topics');
            }
            
            $i++;
            
        }

        return $_topics;
    }

}
