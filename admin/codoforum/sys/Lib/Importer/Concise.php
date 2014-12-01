<?php

/*
 * @CODOLICENSE
 */


/*

This class may be used to solve any consistency issues in the codoforum database
that may arise when upgrading, importing etc


This class is not part of Importer, but is placed here temporarily until a better
location is available . 
*/

namespace Lib\Importer;

class Concise {

    
    public function __construct() {
        
        $this->db = \Lib\DB::get_db();
        
        $this->update_counts();
    }    

    private function update_counts() {
        
        $this->update_count_categories();
        $this->update_count_topics();
        $this->update_count_users();
    }
    
    private function update_count_users() {
        
        $qry = "SELECT id FROM ".PREFIX."codo_users";
        $res = $this->db->query($qry);
        $users = $res->fetchAll();
        
        $upd = "UPDATE ".PREFIX."codo_users SET no_posts=:no_posts WHERE id=:id";
        $update = $this->db->prepare($upd);
        
        foreach($users as $user) {
            
            $uid = $user['id'];
            $num_posts = $this->count_posts_user($uid);
            
            $update->execute(array("no_posts" => $num_posts, "id" => $uid));
        }
                
    }
    
    private function update_count_topics() {
        
        $qry = "SELECT topic_id FROM ".PREFIX."codo_topics";
        $res = $this->db->query($qry);
        $topics = $res->fetchAll();
        
        $upd = "UPDATE ".PREFIX."codo_topics SET no_posts=:no_posts WHERE topic_id=:tid";
        $update = $this->db->prepare($upd);
        
        foreach($topics as $topic) {
            
            $tid = $topic['topic_id'];
            $num_posts = $this->count_posts_topic($tid);
            
            $update->execute(array("no_posts" => $num_posts, "tid" => $tid));
        }
        
    }
    
    private function update_count_categories() {
        
        
        $qry = "SELECT cat_id FROM ".PREFIX."codo_categories";
        $res = $this->db->query($qry);
        $cats = $res->fetchAll();

        $upd = "UPDATE ".PREFIX."codo_categories SET no_topics=:no_topics, no_posts=:no_posts WHERE cat_id=:cid";
        $update = $this->db->prepare($upd);
        
        foreach($cats as $cat) {
            
            $cid = $cat['cat_id'];
            $num_topics = $this->count_topics($cid);
            $num_posts = $this->count_posts_cat($cid);
            
            $update->execute(array("no_topics" => $num_topics, "no_posts" => $num_posts, "cid" => $cid));
        }
        
        
    }
    
    /**
     * 
     * Counts no of topics for a given category id
     * @return type
     */
    private function count_topics($cid) {
        
        $qry = "SELECT COUNT(topic_id) AS cnt FROM ".PREFIX."codo_topics WHERE cat_id=$cid AND topic_status <> 0";
        $res = $this->db->query($qry);
        $row = $res->fetch();
        
        return $row['cnt'];
    }
    
    /**
     * 
     * Counts no of posts for a given category id
     * @return type
     */    
    private function count_posts_cat($cid) {
        
        $qry = "SELECT COUNT(post_id) AS cnt FROM ".PREFIX."codo_posts WHERE cat_id=$cid AND post_status <> 0";
        $res = $this->db->query($qry);
        $row = $res->fetch();
        
        return $row['cnt'];
    }

    /**
     * 
     * Counts no of posts for a given topic id
     * @return type
     */    
    private function count_posts_topic($tid) {
        
        $qry = "SELECT COUNT(post_id) AS cnt FROM ".PREFIX."codo_posts WHERE topic_id=$tid AND post_status <> 0";
        $res = $this->db->query($qry);
        $row = $res->fetch();
        
        return $row['cnt'];
    }

    /**
     * 
     * Counts no of posts for a given user id
     * @return type
     */    
    private function count_posts_user($uid) {
        
        $qry = "SELECT COUNT(post_id) AS cnt FROM ".PREFIX."codo_posts WHERE uid=$uid AND post_status <> 0";
        $res = $this->db->query($qry);
        $row = $res->fetch();
        
        return $row['cnt'];
    }
    
}

