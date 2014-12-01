<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Importer;

class ImportWorker {

    public $max_rows = 100;
    public $connected = false;
    public $_DB;
    public $import_admin_mail;

    public function __construct($_DB, $import_from) {

        //database connection info of remote server
        $this->_DB = $_DB;
        $this->importer = $import_from;
    }

    public function connect_db() {

        \Lib\DB::$persistent = true;

        \Lib\DB::connect($this->_DB);

        $class = '\\Lib\\Importer\\Drivers\\' . $this->importer;
        $this->fetch = new $class(\Lib\DB::get_db());
        $this->connected = \Lib\DB::$connected ? true : false;

        $this->fetch->max_rows = $this->max_rows;
        $this->fetch->set_prefix($this->_DB['prefix']);

        $this->im = new Import(\Lib\DB::get_db(true, true));
    }

    public function import_cats() {

        $cats = $this->fetch->get_cats();
        $this->im->ins_cat($cats);
    }

    public function import_topics() {

        $start = 0;
        $id = false;
        
        //this means we have to insert the topics as posts in codoforum posts table
        if (!$this->fetch->post_has_topic) {

            $id = $this->im->get_last_post_id();
        }

        while ($topics = $this->fetch->get_topics($start)) {

            $topic_posts = array();

            //insert all topics
            $this->im->ins_topics($topics, $id);

            if (!$this->fetch->post_has_topic) {

                foreach ($topics as $topic) {

                    $topic_posts[] = array(
                        "cat_id" => $topic['cat_id'],
                        "topic_id" => $topic['tid'],
                        "post_id" => ++$id,
                        "uid" => $topic['uid'],
                        "message" => $topic['message'],
                        "post_created" => $topic['topic_created'],
                        "post_modified" => $topic['topic_updated']
                    );
                }

                //insert all posts
                $this->im->ins_posts($topic_posts);
            }


            $start += $this->max_rows;
        }
    }

    public function import_posts() {

        $start = 0;

        while ($posts = $this->fetch->get_posts($start)) {

            $this->im->ins_posts($posts);

            $start += $this->max_rows;
        }
    }

    public function import_users() {

        $start = 0;

        while ($users = $this->fetch->get_users($start)) {

            $this->im->ins_users($users);

            $start += $this->max_rows;
        }

        $this->im->reset_admin_account($this->import_admin_mail);
    }

    public function isset_admin_account() {

        $_SESSION['new_admin_uid'] = $this->fetch->get_user_by_mail($this->import_admin_mail);
        return $_SESSION['new_admin_uid'];
    }

}
