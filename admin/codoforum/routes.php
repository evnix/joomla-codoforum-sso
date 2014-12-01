<?php

/*
 * @CODOLICENSE
 */

//Limonade -> 230 ms

//display & routing
if (get_magic_quotes_gpc()) {
    $gpc = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);

    array_walk_recursive($gpc, function(&$value) {
        $value = stripslashes($value);
    });
}

use Lib\Util,
    Lib\DB;

require SYSPATH . 'globals/global.php';

$db = DB::get_db();

Util::get_config($db);
//set constants
\Constants::post_boot('themes/' . Util::get_opt('theme') . "/");

//\Lib\Hook::add('before_page_load', array($boot, 'load_controller'));

/*
 * abc/def/ghi/jkl/ferferge
 * 
 * 
 * abc/def/ghi/jkl
 * abc/:x/:y/def
 * abc/:x
 * 
 * :a/:b/s
 * swf/ferf/
 * 
 * swf/fref/s
 /

var_dump($_REQUEST);
static $routes = array();
function dispatch($route, $func) {
    
    global $routes;
    $routes[] = array($route, $func);
}

function dispatch_get($route, $func) {
    
    dispatch($route, $func);
}

function dispatch_post($route, $func) {
    
    dispatch($route, $func);
}

function run() {
    
    $url = $_REQUEST['uri'];
    $parts = explode("/", $url);
    var_dump($parts);
    global $routes;
    foreach($routes as $route) {
        
        var_dump(explode("/", $route[0]));
    }
}*/
//-------------------------server static files --------------------------------

dispatch_get('serve/attachment', function() {


    $img = new \Controller\serve();
    $img->attachment();
});

dispatch_get('serve/smiley', function() {


    $img = new \Controller\serve();
    $img->smiley();
});

//-------------AJAX-------------------------------------------------------------

use Lib\Access\Request;

dispatch_get('Ajax/forum/category/get_topics', function() {

    if (Request::valid($_GET['token'])) {
        $cat = new Controller\Ajax\forum\category();
        $cat->get_topics();
    }
});

dispatch_post('Ajax/forum/topic/create', function() {

    if (Request::valid($_POST['token'])) {
        $topic = new Controller\Ajax\forum\topic();
        $topic->create();
    }
});

dispatch_post('Ajax/forum/topic/edit', function() {

    if (Request::valid($_POST['token'])) {
        $topic = new Controller\Ajax\forum\topic();
        $topic->edit();
    }
});


dispatch_post('Ajax/forum/topic/reply', function() {

    if (Request::valid($_POST['token'])) {
        $nt = new Controller\Ajax\forum\topic();
        $nt->reply();
    }
});


dispatch_get('Ajax/forum/topic/inc_view', function() {

    if (Request::valid($_GET['token'])) {
        $topic = new Controller\Ajax\forum\topic();
        $topic->inc_view();
    }
});

dispatch_post('Ajax/forum/topic/upload', function() {

    if (Request::valid($_POST['token'])) {
        $topic = new Controller\Ajax\forum\topic();
        $topic->upload();
    }
});


dispatch_get('Ajax/forum/topic/get_posts', function() {

    if (Request::valid($_GET['token'])) {
        $topics = new Controller\Ajax\forum\topic();
        $topics->get_posts();
    }
});

dispatch_get('Ajax/forum/topics/get_topics', function() {

    if (Request::valid($_GET['token'])) {
        $topics = new Controller\Ajax\forum\topics();
        $topics->get_topics();
    }
});


dispatch_get('Ajax/user/login/dologin', function() {

    if (Request::valid($_GET['token'])) {
        $user = new Controller\Ajax\user\login();
        $user->dologin();
    }
});

dispatch_get('Ajax/user/login/req_pass', function() {

    if (Request::valid($_GET['token'])) {
        
        $user = new Controller\Ajax\user\login();
        $user->req_pass();
    }
});


dispatch_get('Ajax/user/register/mail_exists', function() {

    if (Request::valid($_GET['token'])) {
        $user = new Controller\Ajax\user\register();
        $user->mail_exists();
    }
});

dispatch_get('Ajax/user/register/username_exists', function() {

    if (Request::valid($_GET['token'])) {
        $user = new Controller\Ajax\user\register();
        $user->username_exists();
    }
});

dispatch_get('Ajax/user/register/resend_mail', function() {

    if (Request::valid($_GET['token'])) {
        $user = new Controller\Ajax\user\register();
        $user->resend_mail();
    }
});


dispatch_post('Ajax/forum/post/edit', function() {

    if (Request::valid($_POST['token'])) {
        $post = new Controller\Ajax\forum\post();
        $post->edit();
    }
});

dispatch_post('Ajax/forum/post/:id/delete', function($id) {

    if (Request::valid($_POST['token'])) {
        $post = new Controller\Ajax\forum\post();
        $post->delete($id);
    }
});

dispatch_post('Ajax/forum/post/:id/undelete', function($id) {

    if (Request::valid($_POST['token'])) {
        $post = new Controller\Ajax\forum\post();
        $post->undelete($id);
    }
});

dispatch_post('Ajax/forum/topic/:id/delete', function($id) {

    if (Request::valid($_POST['token'])) {
        $topic = new Controller\Ajax\forum\topic();
        $topic->delete($id);
    }
});

dispatch_get('Ajax/user/edit/change_pass', function() {

    if (Request::valid($_GET['token'])) {

        $old_pass = $_GET['curr_pass'];
        $new_pass = $_GET['new_pass'];
        
        $db = DB::get_db();
        $me = new Lib\User\User($db);
        
        $constraints = new Lib\Constraints\User;
        $matched = $me->match_password($old_pass);
        
        if($constraints->password($new_pass) && $matched) {

            $me->update_password($new_pass, $old_pass);
            $ret = array("status" => "success", "msg" => _("Password updated successfully"));
            
        }else{

            $errors = $constraints->get_errors();
            
            if(!$matched) {
                
                $errors = array_merge($errors, array(_("The current password given is incorrect")));           
            }
            
            $ret = array("status" => "fail", "msg" => $errors);
        }
        
        echo json_encode($ret);
    }
});

dispatch_get('Ajax/forum/search', function() {


    $searcher = new Lib\Search\Search($search_expression);
    $searcher->search();
    
});
//-------------USER-------------------------------------------------------------

dispatch_get('/user/login', function() {

    $user = new \Controller\user();
    $user->login();

    Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
});

dispatch_get('/user/logout', function() {

    $user = new \Controller\user();
    $user->logout();

    Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
});

dispatch_get('/user/profile', function() {

    $user = new \Controller\user();
    $user->profile(null, null);

    Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
});

dispatch_post('/user/profile/:id/edit', function($id) {

    if (Request::valid($_POST['token'])) {

        $user = new \Controller\user();
        $user->edit_profile($id);

        Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
    }
});


dispatch_get('/user/profile/:id/:action', function($id, $action) {

    $user = new \Controller\user();
    $user->profile($id, $action);

    Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
});

dispatch_post('/user/register', function() {

    if (Request::valid($_POST['token'])) {
        $user = new \Controller\user();
        $user->register(true);

        Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
    }
});

dispatch_get('/user/register', function() {

    $user = new \Controller\user();
    $user->register(false);

    Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
});

dispatch_get('/user/confirm', function() {

    $user = new \Controller\user();
    $user->confirm();

    Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
});


dispatch_get('/user/forgot', function() {

    $user = new \Controller\user();
    $user->forgot();

    Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
});


dispatch_get('/user', function() {

    $user = new \Controller\user();

    if (isset($_SESSION[UID . 'USER']['id'])) {
        $user->profile($_SESSION[UID . 'USER']['id'], 'view');
    } else {
        $user->login();
    }

    Lib\Smarty\Layout::load($user->view, $user->css_files, $user->js_files);
});


//-------------FORUM------------------------------------------------------------

dispatch_get('/forum/topics', function() {

    $forum = new \Controller\forum();
    $forum->topics();
    Lib\Smarty\Layout::load($forum->view, $forum->css_files, $forum->js_files);
});

dispatch_get('/forum/topics/:cat_name/:page', function($cat_name, $page) {

    $forum = new \Controller\forum();
    $forum->category($cat_name, $page);
    Lib\Smarty\Layout::load($forum->view, $forum->css_files, $forum->js_files);
});

dispatch_get('/forum/topic', 'not_found');

dispatch_get('/forum/topic/:id/edit', function($tid) {

    $forum = new \Controller\forum();
    $forum->manage_topic($tid);
    Lib\Smarty\Layout::load($forum->view, $forum->css_files, $forum->js_files);
});


dispatch_get('/forum/topic/:tid/:tname/:page', function($tid, $tname, $page) {

    $forum = new \Controller\forum();
    $forum->topic($tid, $page);
    Lib\Smarty\Layout::load($forum->view, $forum->css_files, $forum->js_files);
});



dispatch_get('/forum/new_topic', function() {

    $forum = new \Controller\forum();
    $forum->manage_topic();
    Lib\Smarty\Layout::load($forum->view, $forum->css_files, $forum->js_files);
});



dispatch_get('/forum', function() {

    $forum = new \Controller\forum();
    $forum->topics();
    Lib\Smarty\Layout::load($forum->view, $forum->css_files, $forum->js_files);
});

//-------------INDEX------------------------------------------------------------

dispatch_get('/', function() {
   
    global $installed;
    if (!$installed) {

        $url = str_replace("index.php?u=/", "", RURI);
        header("Location: " . $url . "install/index.php");
    }

    $forum = new \Controller\forum();
    $forum->topics();
    Lib\Smarty\Layout::load($forum->view, $forum->css_files, $forum->js_files);
});

//** indicates string that may contain a /
//dispatch_get('/forum/topic/**', array($boot, 'page_load'));
//dispatch_post('/**', array($boot, 'page_load'));

function not_found($errno, $errstr, $errfile = null, $errline = null) {


    Lib\Smarty\Layout::not_found();
}

function server_error($errno, $errstr, $errfile = null, $errline = null) {

    $args = compact('errno', 'errstr', 'errfile', 'errline');

    var_dump(error_layout());
    var_dump($args);
}

run();