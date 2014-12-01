<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Importer;

/**
 *
 * Look at the Import Interface for how to use this class
 *
 */
class Import {

    private $db;
    private $preps;
    public $def_cat_img = "general.png";
    public $query;

    public function __construct($db) {

        $this->db = $db;

        $this->backup_admin_account();
        //exit;

        $this->query = "TRUNCATE TABLE codo_categories;\n"
                . "TRUNCATE TABLE codo_users;\n"
                . "TRUNCATE TABLE codo_topics;\n"
                . "TRUNCATE TABLE codo_posts;\n";

        $truncates = explode(";", $this->query);

        foreach ($truncates as $truncate) {

            $this->db->query($truncate);
        }
        $this->preps = new \stdClass();
    }

    public function ins_cat($cat_info) {

        $cats = array();
        $i = 0;

        //blank -> 100 users 100 posts 
        //import -

        $defs = array(
            "cat_pid" => 0,
            "cat_description" => "",
            "cat_img" => $this->def_cat_img,
            "cat_order" => 0
        );


        foreach ($cat_info as $cat) {

            $cats[$i] = $this->set_value($cat, $defs);
            $cats[$i]["cat_alias"] = \Lib\Forum\Category::get_alias($cat['cat_name']);
            $cats[$i]["cat_name"] = $cat['cat_name'];
            $cats[$i]["cat_id"] = $cat['cat_id'];

            $i++;
        }

        $attrs = array("cat_id", "cat_pid", "cat_name", "cat_alias", "cat_description", "cat_img", "cat_order");

        $qry = $this->prepare_ins_qry($cats, $attrs, "codo_categories");

        //$this->query .= $qry;
    }

    public function ins_topics($topic_info, $pid) {

        $cats = array();
        $i = 0;

        $defs = array(
            "last_post_id" => 0,
            "topic_updated" => 0,
        );


        foreach ($topic_info as $cat) {

            $cats[$i] = $this->set_value($cat, $defs);
            $cats[$i] += $cat;
            //$cats[$i]['topic_id'] = $tid;
            if ($pid) {
                
                $cats[$i]['post_id'] = ++$pid;
            }
            $cats[$i]['title'] = \Lib\Format::imessage($cat['title']);

            $i++;
        }

        // var_dump($cats);
        $attrs = array("topic_id", "title", "cat_id", "post_id", "uid", "last_post_id",
            "topic_created", "topic_updated");

        $qry = $this->prepare_ins_qry($cats, $attrs, "codo_topics");

        $this->query .= $qry;
    }

    public function ins_posts($post_info) {

        $posts = array();
        $i = 0;

        //$defs = array();
        $html = new \Ext\Html();

        foreach ($post_info as $post) {

            //$posts[$i] = $this->set_value($post, $defs);
            $posts[$i] = $post;
            $posts[$i]["imessage"] = \Lib\Format::imessage($post['message']);
            $posts[$i]["omessage"] = preg_replace("/\r\n|\r|\n/", '<br/>', ($html->filter(($post['message']), false, true)));

            $i++;
        }

        // var_dump($cats);
        $attrs = array("post_id", "topic_id", "cat_id", "uid", "imessage", "omessage",
            "post_created", "post_modified");

        $qry = $this->prepare_ins_qry($posts, $attrs, "codo_posts");

        $this->query .= $qry;
    }

    public function ins_users($user_info) {

        $users = array();
        $i = 0;

        $defs = array(
            "token" => "",
            "profile_views" => 0,
            "oauth_id" => null
        );


        foreach ($user_info as $user) {

            $users[$i] = $this->set_value($users, $defs);
            $users[$i] += $user;

            /* $id = \Lib\User\User::mail_exists($user['mail']);
              if ($id) {

              //$users[$i]['mail'] = "imported_" . $user['mail'];
              $users[$i]['codo_system_action'] = $id;
              $i++;
              continue;
              }

              //if username already exists prefix it with import_
              if (\Lib\User\User::username_exists($user['username'])) {

              $users[$i]['username'] = "imported_" . $user['username'];

              //what is username name import_* also exists ? then add time() as prefix
              if (\Lib\User\User::username_exists($users[$i]['username'])) {

              $users[$i]['username'] = time() . $users[$i]['username'];
              }
              } */


            if (!isset($user['rid']) || ( isset($user['rid']) && $user['rid'] == null)) {

                $users[$i]['rid'] = 2;
            }

            $i++;
        }

        // var_dump($cats);
        $attrs = array("id","username", "name", "pass", "token", "mail", "created",
            "last_access", "user_status", "avatar", "signature", "profile_views", "rid", "oauth_id");

        //$this->update_post($users);
        $qry = $this->prepare_ins_qry($users, $attrs, "codo_users");

        //$this->query .= $qry;
    }

    private function set_value($arr, $defs) {

        $_arr = array();

        foreach ($defs as $index => $def_value) {

            if (!isset($arr[$index])) {

                $_arr[$index] = $def_value;
            } else {

                $_arr[$index] = $arr[$index];
            }
        }

        return $_arr;
    }

    /*
      private function update_post($i, $id) {

      $qry = "UPDATE " . PREFIX . "codo_posts SET uid=$i WHERE uid=$id";
      $this->db->query($qry);

      $qry = "UPDATE " . PREFIX . "codo_topics SET uid=$i WHERE uid=$id";
      $this->db->query($qry);
      }

      private function run_single_qry($arr, $attrs, $table) {

      $fields = implode(", ", $attrs);

      foreach ($arr as $cat) {

      $id = $cat['id'];
      if (!isset($cat['codo_system_action'])) {

      $qry = "INSERT IGNORE INTO " . PREFIX . "$table ($fields) VALUES ";
      $cat = array_merge(array_flip($attrs), $cat);

      $fil_cat = array();
      foreach ($cat as $key => $value) {

      if (!in_array($key, $attrs)) {

      continue;
      }

      if (!is_numeric($value)) {

      $value = "'" . addslashes($value) . "'";
      //$value = str_replace('\n', '\\n', $value);
      }

      $fil_cat[] = $value;
      }

      $qry .= "\n(" . implode(", ", $fil_cat) . ")";
      $this->db->query($qry);

      $id = $this->db->lastInsertId();
      } else {

      $id = $cat['codo_system_action'];
      }

      if ($table == "codo_users") {

      $this->update_post($id, $cat['id']);
      }
      }
      } */

    /**
     * 
     */
    public function get_last_post_id() {

        $qry = 'SELECT MAX(post_id) AS max_post_id FROM ' . PREFIX . 'codo_posts';
        $res = $this->db->query($qry);

        $max = $res->fetch();

        return ((int) $max['max_post_id']);
    }

    /**
     * 
     */
    private function backup_admin_account() {

        $user = \Lib\User\CurrentUser\CurrentUser::load_user();

        $_SESSION['backup_admin_account'] = (array) $user;
    }

    public function reset_admin_account($admin_mail) {

        $admin = $_SESSION['backup_admin_account'];
        
        //we need to preserve the imported user id
        unset($admin['id']);
        $user = new \Lib\User\User($this->db);

        //update user with $admin where mail=$admin_mail
        $user->set_fields($admin, $admin_mail, 'mail');
        
        //reset admin userid
        $_SESSION[UID . 'USER']['id'] = $_SESSION['new_admin_uid'];
        
    }

    /**
     * 
     * Prepares a multivalued single insert query to perform a fast multiple insert
     * @param type $cats
     * @param type $attrs
     * @param type $table
     */
    private function prepare_ins_qry($cats, $attrs, $table) {

        $fields = implode(", ", $attrs);

        $values = array();
        foreach ($cats as $cat) {

            $qry = "INSERT IGNORE INTO " . PREFIX . "$table ($fields) VALUES ";
            $cat = array_merge(array_flip($attrs), $cat);

            $fil_cat = array();
            foreach ($cat as $key => $value) {

                if (!in_array($key, $attrs)) {

                    continue;
                }

                if (!is_numeric($value)) {

                    $value = "'" . addslashes($value) . "'";
                    //$value = str_replace('\n', '\\n', $value);
                }

                $fil_cat[] = $value;
            }

            $values[] = "\n(" . implode(", ", $fil_cat) . ")";
        }

        $qry .= implode(",", $values) . ";\n\n";

        //return $qry;
        //echo nl2br($qry);
        $this->db->query($qry);
    }

}
