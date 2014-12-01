<?php

/*
 * @CODOLICENSE
 */

/*
  dispatch('Ajax/plugin/post_notify/notify', function() {


  $qry = 'SELECT id, to_address, mail_subject, body FROM ' . PREFIX . 'codo_mail_queue '
  . 'WHERE mail_status=0 AND mail_type=1 LIMIT 10 OFFSET 0';

  $res = $this->db->query($qry);
  $mails = $res->fetchAll();

  if (count($mails) > 0) {

  $sender = new Lib\Mail\Mail();

  $ids = array();
  foreach($mails as $mail) {

  $ids[] = $mail['id'];
  }

  //update all queued mails to status 'sending'
  $qry = 'UPDATE ' . PREFIX . 'codo_mail_queue SET mail_status=1 WHERE id IN (' . implode(',', $ids) . ')';
  $this->db->query($qry);

  $qry = 'UPDATE ' . PREFIX . 'codo_mail_queue SET mail_status=? WHERE id=?';
  $stmt = $this->db->prepare($qry);

  foreach ($mails as $mail) {

  $sender->to = $mail['to_address'];
  $sender->subject = $mail['mail_subject'];
  $sender->message = $mail['body'];

  $sender->send_mail();
  if (!$sender->sent) {

  var_dump($sender->error);
  \Lib\Util::log('Mail error: ' . $sender->error);
  $stmt->execute(array(3, $mail['id']));
  } else {

  $stmt->execute(array(2, $mail['id'])); //set status 'sent'
  }
  }
  }
  }); */

class PostNotify {

    public function __construct() {

        $this->db = Lib\DB::get_db();
    }

    public function add_resources() {

        $css = <<<EOD

                .post_notify_checkbox {

                    display: inline-block;
                    margin-left: 4px;
                }

EOD;

        $js = <<<EOD

                CODOF.hook.add('before_req_send', function() {

                    if(jQuery('#post_notify_checkbox').is(':checked')) {

                        CODOF.req.data.post_notify_checkbox = 'yes';
                    }
                });

EOD;


        $asset = new \Lib\Asset\Stream();

        $notify_css = array("name" => 'post_notify', "data" => $css, "type" => 'inline');
        $notify_js = array("name" => 'post_notify', "data" => $js, "type" => 'inline');

        $asset->add_css($notify_css);
        $asset->add_js($notify_js);
    }

    public function add_notify_option_in_edit_user($dom) {

        $container = $dom->find('.codo_new_reply_action');

        $html = '<div class="post_notify_checkbox"><input id="post_notify_checkbox" type="checkbox" checked/><span> ' . _("Be notified of new replies") . "</span></div>";
        //prepend our code
        $container[0]->innertext .= $html;
    }

    public function add_email_send_js() {

        $js = <<<EOD

                $.get(codo_defs.url + 'Ajax/plugin/post_notify/notify');

EOD;

        $asset = new \Lib\Asset\Stream();

        $notify_js = array('name' => 'email_notification',
            'data' => $js,
            'type' => 'inline',
            'position' => 'body');

        $asset->add_js($notify_js);
    }

    public function add_notify_subscriber($pid) {

        $post = new Lib\Forum\Post($this->db);

        $post_info = $post->get_post_info($pid);

        $tid = $post_info['topic_id'];
        $uid = $post_info['uid'];

        if (isset($_REQUEST['post_notify_checkbox'])) {

            $qry = "INSERT INTO " . PREFIX . "codo_post_notify (tid, uid, notify)"
                    . " VALUES($tid, $uid, 1)";

            $this->db->query($qry);
        } else {

            $qry = "UPDATE " . PREFIX . "codo_post_notify SET notify=0 WHERE uid=$uid AND tid=$tid";
            $this->db->query($qry);
        }

        $this->send_notifications($tid, $pid);
    }

    public function send_notifications($tid, $pid) {

        $qry = "SELECT DISTINCT u.id,u.username,u.mail,p.omessage,t.title FROM " . PREFIX . "codo_users AS u "
                . " INNER JOIN " . PREFIX . "codo_post_notify As n ON n.uid=u.id "
                . " LEFT JOIN " . PREFIX . "codo_posts AS p ON p.post_id=$pid "
                . " LEFT JOIN " . PREFIX . "codo_topics AS t ON t.topic_id=$tid "
                . " WHERE n.notify=1 AND p.topic_id=$tid AND n.tid=$tid";

        $res = $this->db->query($qry);
        $users = $res->fetchAll();

        $mail = new Lib\Mail\Mail();


        $qry = 'INSERT INTO ' . PREFIX . 'codo_mail_queue (to_address, mail_subject, body) '
                . 'VALUES(:to, :subject, :body)';

        $stmt = $this->db->prepare($qry);

        $me = \Lib\User\CurrentUser\CurrentUser::load_user();

        foreach ($users as $info) {

            //do not send email to the user making the post
            if (Lib\User\CurrentUser\CurrentUser::get_id() == $info['id']) {

                continue;
            }

            $user = array(
                "id" => $me->id,
                "username" => $me->username
            );

            $topic = array(
                "title" => $info['title']
            );

            $safe_title = Lib\Filter::URL_safe($info['title']);
            $post = array(
                "omessage" => $info['omessage'],
                "url" => RURI . "forum/topic/$tid/$safe_title/#post-$pid",
                "id" => $info['id'],
                "username" => $info['username']
            );



            $mail->user = $user;
            $mail->post = $post;
            $mail->topic = $topic;


            $data = array(
                "to" => $info['mail'],
                "subject" => $mail->replace_tokens(\Lib\Util::get_opt('post_notify_subject')),
                "body" => $mail->replace_tokens(\Lib\Util::get_opt('post_notify_message'))
            );

            $mail->to = $data['to'];
            $mail->subject = $data['subject'];
            $mail->message = $data['body'];

            $mail->send_mail();
            if (!$mail->sent) {

                var_dump($mail->error);
                \Lib\Util::log('Mail error: ' . $mail->error);
            }

            //$stmt->execute($data);
        }

        //$this->mark_post_as_notified($pid);
    }

    public function mark_post_as_notified($pid) {

        $pid = (int) $pid;

        $qry = "UPDATE " . PREFIX . "codo_post_notify SET notified=1 WHERE pid=$pid";
        $this->db->query($qry);
    }

}

$pn = new PostNotify();

Lib\Hook::add('tpl_before_forum_category', array($pn, 'add_resources'));
Lib\Hook::add('tpl_after_forum_category', array($pn, 'add_notify_option_in_edit_user'));
Lib\Hook::add('tpl_before_forum_new_topic', array($pn, 'add_resources'));
Lib\Hook::add('tpl_after_forum_new_topic', array($pn, 'add_notify_option_in_edit_user'));
Lib\Hook::add('tpl_before_forum_topic', array($pn, 'add_resources'));
Lib\Hook::add('tpl_after_forum_topic', array($pn, 'add_notify_option_in_edit_user'));
Lib\Hook::add('tpl_after_forum_topic', array($pn, 'add_notify_option_in_edit_user'));

\Lib\Hook::add('after_post_insert', array($pn, 'add_notify_subscriber'));
//\Lib\Hook::add('before_site_head', array($pn, 'add_email_send_js'));
