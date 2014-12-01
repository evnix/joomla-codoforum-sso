<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Mail;

class Mail {

    public $sent;
    public $error;
    public $to;
    public $subject;
    public $message;
    
    public $curr;
    public $user;
    public $post;
    public $topic;
    
    public function send_mail() {


        $mail = new \Ext\phpmailer\PHPMailer;

        $mail->AddAddress($this->to);
        $mail->Subject = $this->subject;
        $mail->Body = $this->message;
        $mail->CharSet = 'UTF-8';

        if (\Lib\Util::get_opt('mail_type') == 'smtp') {
            $mail->IsSMTP(); // enable SMTP
        } else {
            $mail->IsMail();
        }

        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only

        if (\Lib\Util::get_opt('smtp_protocol') != 'none') {
            $mail->SMTPAuth = true;  // authentication enabled
        }

        $mail->SMTPSecure = \Lib\Util::get_opt('smtp_protocol'); // SSL TLS secure transfer enabled REQUIRED for Gmail
        $mail->Host = \Lib\Util::get_opt('smtp_server');
        $mail->Port = \Lib\Util::get_opt('smtp_port');
        $mail->Username = \Lib\Util::get_opt('smtp_username');
        $mail->Password = \Lib\Util::get_opt('smtp_password');
        $mail->SetFrom(\Lib\Util::get_opt('admin_email'), \Lib\Util::get_opt('site_title'));

        if (!$mail->Send()) {

            $this->sent = false;
            $this->error = $mail->ErrorInfo;
            \Lib\Util::log($this->error);
        } else {

            $this->sent = true;
        }
    }

    public function replace_tokens($text) {

        preg_match_all("/\[(.*?)\]/", $text, $tkns);
        $tokens = $tkns[1];
        
        //we use str_replace which anyway replaces all occurences
        $ids = array_unique($tokens);

        foreach ($ids as $id) {

            $fields = explode(":", $id);

            switch ($fields[0]) {

                //user related
                case 'user':
                    $value = $this->user[$fields[1]];
                    break;

                //any config from codo_config table
                case 'option':
                    $value = \Lib\Util::get_opt($fields[1]);
                    break;

                case 'this':
                    $value = $this->curr[$fields[1]];
                    break;

                case 'post':
                    $value = $this->post[$fields[1]];
                    break;
                
                case 'topic':
                    $value = $this->topic[$fields[1]];
                    break;
                
                default : $value = '';
            }
            $text = str_replace("[$id]", $value, $text);            
        }
        
        return $text;
    }

}
