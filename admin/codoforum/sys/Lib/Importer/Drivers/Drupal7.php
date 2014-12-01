<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Importer\Drivers;

class Drupal7 {

    public $max_rows = 100;
    
    /**
     * Mention whether your posts table contain topic message as a post or not ?
     * @var type 
     */    
    public $post_has_topic = false;
        
    public function __construct($db) {

        $this->db = $db;
    }

    /**
     * Table prefix 
     * @var type 
     */    
    public function set_prefix($prefix) {
        
        define('DBPRE', $prefix);
    }
    
    /**
     * 
     * Selects 
     * category id          -> cat_id
     * category name        -> cat_name
     * category description -> cat_description
     * category order       -> cat_order
     * category parent id   -> cat_pid 
     * @return type
     */
    public function get_cats() {

        $qry = "SELECT d.tid AS cat_id, d.name AS cat_name, d.description AS cat_description, d.weight AS cat_order, h.parent AS cat_pid
                    FROM  ".DBPRE."taxonomy_term_data AS d
                    INNER JOIN ".DBPRE."taxonomy_vocabulary AS v ON d.vid = v.vid
                    INNER JOIN ".DBPRE."taxonomy_term_hierarchy AS h ON h.tid = d.tid
                    WHERE v.module = 'forum'";

        $res = $this->db->query($qry);
        return $res->fetchAll();
    }

    /**
     * 
     * Selects
     * topic id           -> tid
     * topic title        -> title
     * category id        -> cat_id
     * topic created time -> topic_created
     * topic updated time -> topic_updated
     * user id who creaed -> uid
     * post message       -> message
     * @param type $start
     * @return type
     */
    public function get_topics($start) {

        $qry = "SELECT t.nid AS tid, t.title AS title,t.tid AS cat_id,t.created AS topic_created,
                t.last_comment_timestamp AS topic_updated,n.uid AS uid,
                d.body_value AS message
                 FROM ".DBPRE."forum_index AS t 
                 INNER JOIN ".DBPRE."node AS n ON t.nid=n.nid
                 INNER JOIN ".DBPRE."field_data_body AS d ON d.revision_id=n.vid
                 LIMIT $this->max_rows OFFSET $start";

        $res = $this->db->query($qry);
        $result = $res->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * Selects
     * category id        -> cat_id
     * topic id           -> topic_id
     * post id            -> post_id
     * user id            -> uid
     * post message       -> message
     * post created time  -> post_created
     * post modified time -> post_modified
     * @param type $start
     * @return type
     */
    public function get_posts($start) {

        $qry = "SELECT f.tid AS cat_id, c.nid AS topic_id, c.cid AS post_id, c.uid AS uid,
                d.comment_body_value AS message, c.created AS post_created,
                c.changed AS post_modified
                FROM ".DBPRE."forum AS f 
                INNER JOIN ".DBPRE."comment AS c ON f.nid = c.nid 
                INNER JOIN ".DBPRE."field_data_comment_body AS d ON d.entity_id = c.cid
                LIMIT $this->max_rows OFFSET $start";

        $res = $this->db->query($qry);
        $result = $res->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
        
    }
    
    /**
     * Selects
     * user id              -> uid
     * username             -> username
     * nickname             -> name
     * password             -> pass
     * email                -> mail
     * forum signature      -> signature
     * user created time    -> created
     * user last login time -> last_access
     * user status          -> status
     * user avatar url      -> avatar
     * user role id         -> rid
     * @param type $start
     * @return type
     */
    public function get_users($start) {
        
        $qry = "SELECT u.uid AS id, u.name AS username, u.name AS name, u.pass AS pass,
                 u.mail AS mail, u.signature AS signature, u.created AS created,
                 u.access AS last_access, u.status AS user_status, f.filename AS avatar,
                 r.rid AS rid
                FROM ".DBPRE."users AS u
                LEFT JOIN ".DBPRE."file_managed AS f ON f.fid = u.picture AND f.uid=u.uid
                LEFT JOIN ".DBPRE."users_roles AS r ON r.uid = u.uid
                LIMIT $this->max_rows OFFSET $start";
        
        $res = $this->db->query($qry);
        $result = $res->fetchAll(\PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
    }

    
    /**
     * Get the userid by email
     * This is used pre-import to check if admin account email address
     * given is correct or not
     * 
     * @param type $mail
     */
    public function get_user_by_mail($mail) {
        
        $qry = 'SELECT uid AS uid FROM '.DBPRE.'users WHERE mail=?';
        $obj = $this->db->prepare($qry);
        
        if($obj->execute(array($mail)) && $obj->rowCount()) {
            
            $res = $obj->fetch();
            return $res['uid'];
        }
        
        return false;
    }
}
