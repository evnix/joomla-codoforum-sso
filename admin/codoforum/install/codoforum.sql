SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `codo_categories`;
CREATE TABLE IF NOT EXISTS `codo_categories` (
  `cat_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'id of category',
  `cat_pid` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'category parent id',
  `cat_name` varchar(255) NOT NULL COMMENT 'name of the category',
  `cat_alias` varchar(300) NOT NULL COMMENT 'Name that will appear in the url',
  `cat_description` varchar(400) DEFAULT NULL COMMENT 'Description of this category',
  `cat_img` varchar(200) NOT NULL COMMENT 'name of image',
  `no_topics` mediumint(9) NOT NULL COMMENT 'No of topics in this ategory',
  `no_posts` mediumint(9) NOT NULL COMMENT 'No of posts in this category',
  `cat_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'order in which category is displayed',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains forum categories' AUTO_INCREMENT=10 ;

INSERT INTO `codo_categories` (`cat_id`, `cat_pid`, `cat_name`, `cat_alias`, `cat_description`, `cat_img`, `no_topics`, `no_posts`, `cat_order`) VALUES 
('3', '0', 'General Discussions', 'specific-gd', 'This comes under general discussion and posts like chatting and blogs can be put here', 'general.png', '0', '0', '0'),
('10', '0', 'News and Announcements', 'news-and-announce', 'this is where all the latest news will be posted', 'general.png', '0', '0', '0'),
('11', '0', 'CodoForum related disscussions', 'codo-forum-related', 'codoforum related discussions', 'general.png', '0', '0', '2'),
('12', '0', 'Let us know', 'let-us-know', 'We encourage new members to post a short description on how they use FreiChat in their site. you may advertise your site here.', 'general.png', '0', '0', '2'),
('13', '0', 'Bug Reports', 'bug-reports', 'Found a bug? why not report it here?', 'general.png', '0', '0', '2'),
('14', '0', 'Feature Requests', 'feature-requests', 'You have a cool idea? post them here!', 'general.png', '0', '0', '2');

DROP TABLE IF EXISTS `codo_config`;
CREATE TABLE IF NOT EXISTS `codo_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) NOT NULL,
  `option_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='contains site information' AUTO_INCREMENT=32 ;

INSERT INTO `codo_config` (`id`, `option_name`, `option_value`) VALUES
(1, 'site_url', ''),
(2, 'site_title', 'CODOLOGIC'),
(3, 'site_description', 'codoforum - Enhancing your forum experience with next generation technology!'),
(4, 'admin_email', 'admin@codologic.com'),
(5, 'theme', 'default'),
(6, 'captcha_public_key', '6LcMnOkSAAAAALO3jLKIIAwuhdcq34PZ1rXi0-pZ'),
(7, 'captcha_private_key', '6LcMnOkSAAAAAGzpSKY79uIjFybQ4C0_PnmNe2US'),
(8, 'register_pass_min', '8'),
(9, 'num_posts_all_topics', '30'),
(10, 'num_posts_cat_topics', '20'),
(11, 'num_posts_per_topic', '20'),
(12, 'forum_attachments_path', 'assets/img/attachments'),
(13, 'forum_attachments_exts', 'jpg,jpeg,png,gif,pjpeg,bmp,txt'),
(14, 'forum_attachments_size', '3'),
(15, 'forum_attachments_mimetypes', 'image/*,text/plain'),
(16, 'forum_attachments_multiple', 'true'),
(17, 'forum_attachments_parallel', '4'),
(18, 'forum_attachments_max', '10'),
(19, 'reply_min_chars', '10'),
(20, 'subcategory_dropdown', 'hidden'),
(21, 'captcha', 'disabled'),
(22, 'await_approval_message', 'Dear [user:username],\n\nThank you for registering at [option:site_title]. Before we can activate your account one last step must be taken to complete your registration.\n\nTo complete your registration, please visit this URL: [this:confirm_url]\n\nYour Username is: [user:username] \n\nIf you are still having problems signing up please contact a member of our support staff at [option:admin_email]\n\nRegards,\n[option:site_title]'),
(23, 'await_approval_subject', 'Confirm your email for [user:username] at [option:site_title]'),
(24, 'mail_type', 'smtp'),
(25, 'smtp_protocol', 'ssl'),
(26, 'smtp_server', 'smtp.gmail.com'),
(27, 'smtp_port', '465'),
(28, 'smtp_username', 'admin@codologic.com'),
(29, 'smtp_password', 'your_smtp_pass'),
(30, 'register_username_min', '3'),
(31, 'signature_char_lim', '255'),
(32, 'sso_client_id', 'codoforum'),
(33, 'sso_secret', 'Xe24!rf'),
(34, 'sso_get_user_path', 'http://localhost/page/codoforum_sso/user'),
(35, 'sso_login_user_path', 'http://localhost/page/user?codoforum=sso'),
(36, 'sso_logout_user_path', 'http://localhost/page/user/logout'),
(37, 'sso_register_user_path', 'http://localhost/page/user/lot'),
(38, 'sso_name', 'Codologic'),
(39, 'post_notify_message', 'Hi,\n\n[user:username] has replied to the topic: [topic:title]\n\n----\n[post:omessage]\n----\n\nYou can view the reply at the following url\n[post:url]\n\nRegards,\n[option:site_title] team\n'),
(40, 'post_notify_subject', '[topic:title] - new reply'),
(41, 'password_reset_message', 'Hi,\r\n\r\nYour password has been reset . \r\n\r\nNew password: [user:password]\r\n\r\nNote: Please change your password immediately after you login.\r\n\r\nRegards,\r\n[option:site_title] team\r\n'),
(42, 'password_reset_subject', 'Your password has been reset -[option:site_title]');

DROP TABLE IF EXISTS `codo_logs`;
CREATE TABLE IF NOT EXISTS `codo_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary id of each log',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT 'userid of the user',
  `log_type` varchar(64) NOT NULL COMMENT 'type of log',
  `message` text NOT NULL COMMENT 'log message',
  `severity` tinyint(4) NOT NULL COMMENT 'severity level from emergency(0) to n',
  `location` varchar(200) NOT NULL COMMENT 'method name or page location',
  `log_time` int(11) NOT NULL COMMENT 'time of log',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains logs of events/errors/warnings etc' AUTO_INCREMENT=20 ;

DROP TABLE IF EXISTS `codo_plugins`;
CREATE TABLE IF NOT EXISTS `codo_plugins` (
  `plg_name` varchar(255) NOT NULL COMMENT 'path of filename relative to codoforum root',
  `plg_status` int(11) NOT NULL DEFAULT '0' COMMENT 'boolean indicating plugin is enabled or not',
  `plg_weight` int(11) NOT NULL DEFAULT '0' COMMENT 'order in which plugin is invoked for a hook',
  UNIQUE KEY `filename` (`plg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains list of all plugins';

INSERT INTO `codo_plugins` (`plg_name`, `plg_status`, `plg_weight`) VALUES
('post_notify', 1, 0),
('sso', 0, 0),
('uni_login', 0, 0);

DROP TABLE IF EXISTS `codo_posts`;
CREATE TABLE IF NOT EXISTS `codo_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of post',
  `topic_id` int(11) NOT NULL COMMENT 'corresponding id of topic',
  `cat_id` tinyint(4) NOT NULL COMMENT 'corresponding id of category',
  `uid` int(11) NOT NULL COMMENT 'userid creating this post',
  `imessage` text NOT NULL COMMENT 'message in bbcode/markdown format',
  `omessage` text NOT NULL COMMENT 'message in html format',
  `post_created` int(11) NOT NULL COMMENT 'time at which this post was created',
  `post_modified` int(11) DEFAULT NULL COMMENT 'time at which this post was modified',
  `post_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active, 0=deleted',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains forum posts' AUTO_INCREMENT=1 ;

INSERT INTO `codo_posts` (`post_id`, `topic_id`, `cat_id`, `uid`, `imessage`, `omessage`, `post_created`, `post_modified`, `post_status`) VALUES
(1, 1, 3, 1, 'Hi,  \n  \nThis is an example post in your codoforum installation.   \nYou can create/modify/delete all forum categories from the forum backend.  \n  \nPlease edit the forum title and description from the backend.   \n  \nThe only user available to login in the front-end is admin with the password that you set during the installation.\n \nYou may delete this post . \n  \nRegards,   \nCodologic Team', '<p>Hi,  </p>\n<p>This is an example post in your codoforum installation.<br>You can create/modify/delete all forum categories from the forum backend.  </p>\n<p>Please edit the forum title and description from the backend.   </p>\n<p>The only user available to login in the front-end is admin with the password that you set during the installation.</p>\n<p>You may delete this post . </p>\n<p>Regards,<br>Codologic Team</p>', 1401549322, NULL, 1);


DROP TABLE IF EXISTS `codo_roles`;
CREATE TABLE IF NOT EXISTS `codo_roles` (
  `rid` int(11) NOT NULL,
  `rname` varchar(40) NOT NULL COMMENT 'role name of user',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains different roles and permissions of users';

INSERT INTO `codo_roles` (`rid`, `rname`) VALUES
(1, 'guest'),
(2, 'user'),
(3, 'moderator'),
(4, 'administrator');

DROP TABLE IF EXISTS `codo_role_permissions`;
CREATE TABLE IF NOT EXISTS `codo_role_permissions` (
  `rid` int(11) NOT NULL COMMENT 'role id',
  `permission` varchar(128) NOT NULL COMMENT 'permission name',
  `module` varchar(100) NOT NULL DEFAULT 'core' COMMENT 'module name , default is core',
  PRIMARY KEY (`rid`,`permission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains permissions for user roles';

INSERT INTO `codo_role_permissions` (`rid`, `permission`, `module`) VALUES
(1, 'view profile', 'core'),
(2, 'create new topic', 'core'),
(2, 'create topic', 'core'),
(2, 'edit my post', 'core'),
(2, 'edit my profile', 'core'),
(2, 'edit my topic', 'core'),
(2, 'reply to topic', 'core'),
(2, 'view profile', 'core'),
(3, 'create new topic', 'core'),
(3, 'create topic', 'core'),
(3, 'delete all posts', 'core'),
(3, 'delete all topics', 'core'),
(3, 'edit all posts', 'core'),
(3, 'edit all topics', 'core'),
(3, 'edit my profile', 'core'),
(3, 'reply to topic', 'core'),
(3, 'view profile', 'core'),
(4, 'create category', 'core'),
(4, 'create new topic', 'core'),
(4, 'create topic', 'core'),
(4, 'delete all posts', 'core'),
(4, 'delete all topics', 'core'),
(4, 'edit all posts', 'core'),
(4, 'edit all profiles', 'core'),
(4, 'edit all topics', 'core'),
(4, 'edit my profile', 'core'),
(4, 'reply to topic', 'core'),
(4, 'view profile', 'core');

DROP TABLE IF EXISTS `codo_sessions`;
CREATE TABLE IF NOT EXISTS `codo_sessions` (
  `sid` varchar(255) NOT NULL COMMENT 'php session id',
  `last_active` int(11) NOT NULL COMMENT 'last active time',
  `session_data` text NOT NULL COMMENT 'session data',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contains user sessions';


DROP TABLE IF EXISTS `codo_signups`;
CREATE TABLE IF NOT EXISTS `codo_signups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='stores temporary sign up attempts for account activation' AUTO_INCREMENT=13 ;


DROP TABLE IF EXISTS `codo_smileys`;
CREATE TABLE IF NOT EXISTS `codo_smileys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(10) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='stores paths to smileys available while posting' AUTO_INCREMENT=20 ;

INSERT INTO `codo_smileys` (`id`, `symbol`, `image_name`) VALUES
(1, ':S', 'worried.gif'),
(2, '(wasntme)', 'itwasntme.gif'),
(3, 'x(', 'angry.gif'),
(4, '(doh)', 'doh.gif'),
(5, '|-()', 'yawn.gif'),
(6, ']:)', 'evilgrin.gif'),
(7, '|(', 'dull.gif'),
(8, '|-)', 'sleepy.gif'),
(9, '(blush)', 'blush.gif'),
(10, ':P', 'tongueout.gif'),
(11, '(:|', 'sweat.gif'),
(12, ';(', 'crying.gif'),
(13, ':)', 'smile.gif'),
(14, ':(', 'sad.gif'),
(15, ':D', 'bigsmile.gif'),
(16, '8)', 'cool.gif'),
(17, ':o', 'wink.gif'),
(18, '(mm)', 'mmm.gif'),
(19, ':x', 'lipssealed.gif');

DROP TABLE IF EXISTS `codo_topics`;
CREATE TABLE IF NOT EXISTS `codo_topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'topic id',
  `title` varchar(255) NOT NULL COMMENT 'title of the topic',
  `cat_id` smallint(6) NOT NULL COMMENT 'category id to which the topic belongs',
  `post_id` int(11) DEFAULT NULL COMMENT 'Contains postid of parent post',
  `uid` int(11) NOT NULL COMMENT 'userid creating this topic',
  `last_post_id` int(11) NOT NULL COMMENT 'Contains id of the last post',
  `last_post_uid` varchar(200) DEFAULT NULL COMMENT 'userid making last reply',
  `last_post_name` varchar(200) DEFAULT NULL COMMENT 'username making last reply',
  `topic_created` int(11) NOT NULL COMMENT 'time at which topic was created',
  `topic_updated` int(11) NOT NULL COMMENT 'time at which topic was last edited',
  `last_post_time` int(11) DEFAULT NULL COMMENT 'time at which last reply was made',
  `no_posts` int(11) NOT NULL DEFAULT '0' COMMENT 'No. of replies for the topic',
  `no_views` int(10) NOT NULL DEFAULT '0' COMMENT 'No. of views for the topic',
  `topic_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=deleted;1=active;2=sticky;3=locked',
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Caontains forum topics' AUTO_INCREMENT=1 ;

INSERT INTO `codo_topics` (`topic_id`, `title`, `cat_id`, `post_id`, `uid`, `last_post_id`, `last_post_uid`, `last_post_name`, `topic_created`, `topic_updated`, `last_post_time`, `no_posts`, `no_views`, `topic_status`) VALUES
(1, 'Welcome to Codoforum', 3, 1, 1, 0, NULL, NULL, 1401549322, 0, NULL, 1, 0, 1);


DROP TABLE IF EXISTS `codo_users`;
CREATE TABLE IF NOT EXISTS `codo_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id of user',
  `username` varchar(60) NOT NULL COMMENT 'unique username of user',
  `name` varchar(100) DEFAULT NULL COMMENT 'display name of user',
  `pass` varchar(128) NOT NULL COMMENT 'salted password',
  `token` varchar(64) NOT NULL COMMENT 'Contains the cookie token',
  `mail` varchar(200) DEFAULT NULL COMMENT 'email id of user',
  `created` int(11) NOT NULL COMMENT 'php time when user was created',
  `last_access` int(11) NOT NULL DEFAULT '0' COMMENT 'php time when user last logged in',
  `user_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = active , 0 = pending',
  `avatar` varchar(200) DEFAULT NULL COMMENT 'full path to avatar',
  `signature` text COMMENT 'users signature displayed after each post',
  `no_posts` int(11) NOT NULL DEFAULT '0' COMMENT 'No of posts created by the user',
  `profile_views` int(11) NOT NULL COMMENT 'no of times users other than me viewed my profile',
  `rid` int(11) NOT NULL COMMENT 'role id of the user as described in codo_roles table',
  `oauth_id` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contains user information' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `codo_post_notify`;
CREATE TABLE IF NOT EXISTS `codo_post_notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT 'subscriber''s user id ',
  `notify` tinyint(4) NOT NULL COMMENT 'integer indicating notification type. 0 means unsubscribed, 1 means subscribed to all posts',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `codo_views`;
CREATE TABLE IF NOT EXISTS `codo_views` (
  `date` date NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

