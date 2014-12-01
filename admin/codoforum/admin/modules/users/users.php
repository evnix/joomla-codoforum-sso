<?php

$smarty = \Lib\Smarty\Single::get_instance();
$db = \Lib\DB::get_db();

$smarty->assign('err',0);
$smarty->assign('msg',"");

$filters = "";
$filter_array = [];
$filter_url = "";

if (!isset($_GET['pno'])) {
    $_GET['pno'] = 1;
}

function getPost($key, $default) {
    if (isset($_GET[$key]))
        return $_GET[$key];
    return $default;
}

//-----------get roles
function get_roles() {

    $db = \Lib\DB::get_db();
    $query = "SELECT * FROM " . PREFIX . "codo_roles";
    $res = $db->query($query);
    $roles = $res->fetchAll();
    $sroles = array();
    $sroles['0'] = 'All Roles';
    foreach ($roles as $role) {
        $sroles[$role['rid']] = $role['rname'];
    }
    return $sroles;
}

//EDIT
if (isset($_GET['action']) && $_GET['action'] == 'edit') {



    if (isset($_POST['user_name'])) {
        
        
        $query="SELECT * FROM ".PREFIX."codo_users WHERE (username=:username OR mail=:mail) AND id!=:id";
        $stmt=$db->prepare($query);
        $arr['username']=$_POST['user_name'];
        $arr['mail']=$_POST['email'];
        $arr['id']=$_POST['id'];
        
        $res=$stmt->execute($arr);
        
        $arr['name']=$_POST['display_name'];
        $arr['rid']=$_POST['role'];
        $arr['signature']=$_POST['signature'];
        
        unset($arr['id']);
        $err=0;
        $msg="";
        if($stmt->rowCount()>0){
            
             $err=1;
             $msg="username or email has already been taken!<br>";
            
        }else{
            
            
            if($_POST['p1']!=""){
            if($_POST['p1']!=$_POST['p2']){
                
                $err=1;
                $msg="The passwords do not match!";
            }else{
                
                
                  $hasher = new \Lib\Pass(8, false);
                $hash = $hasher->HashPassword($_POST['p1']);
                $arr['pass']=$hash;
                
            }
            }
            
            
                    if (isset($_FILES['user_img']) && !empty($_FILES['user_img']['name'])) {

                $image = $_FILES['user_img'];
                if (
                        !\Lib\File\Upload::valid($image) OR
                        !\Lib\File\Upload::not_empty($image) OR
                        !\Lib\File\Upload::type($image, array('jpg', 'jpeg', 'png', 'gif', 'pjpeg', 'bmp'))) {
                    $err=1;
                    $msg="Error While uploading the image, try with a different image.";
                } else {

                    $file_info = \Lib\File\Upload::save($image, NULL, DATA_PATH . 'assets/img/profiles', 0777);
                    $arr["avatar"] = $file_info["name"];
                    
                    
                }
            }
            
            
            
            //update
            $u = new Lib\User\User($db);
            if($err==0)
            $msg.="<br> Updates have been applied.";
            $u->set_fields((int)$_GET['user_id'], $arr);
            
            
        }
              $smarty->assign('err',$err);
                $smarty->assign('msg',$msg);

        
    }




    $user_id = $_GET['user_id'];
    $u = new Lib\User\User($db);
    $res = (array) $u->get_user($user_id);

    $res['avatar'] = str_replace("admin/", "", $res['avatar']);


    $sroles = get_roles();
    $smarty->assign('role_options', $sroles);
    $role = $res['rid'];
    $smarty->assign('role_selected', $role);



    $smarty->assign('user', $res);




    $content = $smarty->fetch('user_edit.tpl');
} else {




//NEW
    if (isset($_POST['a_username'])) {


        if (Lib\Access\CSRF::valid($_POST['CSRF'])) {



            if (Lib\DB::is_field_present($_POST['a_username'], 'username') === TRUE) {
                
            } else if (Lib\DB::is_field_present($_POST['a_email'], 'mail') === TRUE) {
                
            } else {


                $reg = new Lib\User\Register($db);
                $reg->username = $_POST['a_username'];
                $reg->name = $_POST['a_username'];
                $reg->mail = $_POST['a_email'];
                $reg->password = $_POST['a_password'];
                $errors = $reg->register_user();
                var_dump($errors);
            }
        }
    }


//SELECT
    $token = Lib\Access\CSRF::get_token();
    $smarty->assign("CSRF", $token);




//set roles
    $sroles = get_roles();
    $smarty->assign('role_options', $sroles);
    $role = getPost('role', '0');
    $smarty->assign('role_selected', $role);

    if ($role != 0) {
        $filters.=" AND r.rid=:rid ";
        $filter_array[':rid'] = $role;
        $filter_url.="&role=" . $role;
    }


//-------------------------status
    $smarty->assign('status_options', array(
        99 => 'All users',
        1 => 'Active users',
        0 => 'Blocked users',
            )
    );
    $status = getPost('status', 99);
    $smarty->assign('status_selected', $status);
    if ($status != 99) {
        $filters.=" AND u.user_status=:user_status ";
        $filter_array[':user_status'] = $status;
        $filter_url.="&status=" . $status;
    }


//------------------------name
    $username = getPost('username', "");
    $smarty->assign('entered_username', $username);
    if ($username != "") {
        $filters.=" AND u.username LIKE :username ";
        $filter_array[':username'] = '%' . $username . '%';
        $filter_url.="&username=" . $username;
    }







//----------------sort URL

    $sort_column = "";
    $sort = getPost('sort_by', 'created');

    if ($sort == 'username') {
        $sort_column = 'u.username';
    } else if ($sort == 'status') {
        $sort_column = 'u.user_status';
    } else if ($sort == 'no_posts') {
        $sort_column = 'u.no_posts';
    } else {
        $sort_column = 'u.created';
    }

    $sort_order = htmlentities(getPost('sort_order', 'ASC'), ENT_QUOTES);


    $isor = 'DESC';
    if ($sort_order == 'DESC') //invert sort order for link
        $isor = 'ASC';

    $sort_url = "index.php?page=users&sort_order=" . $isor . $filter_url . '&pno=' . $_GET['pno']; //put inverted link only for table heading
    $smarty->assign('sort_url', $sort_url);



    $filter_url.="&sort_order=" . $sort_order . '&sort_by=' . $sort; //put normal sort order for other links
//-------------count no of users
    $query = "SELECT count(u.id) as user_count "
            . " FROM " . PREFIX . "codo_users as u, " . PREFIX . "codo_roles as r"
            . " WHERE u.rid=r.rid " . $filters;
    $stmt = $db->prepare($query);
    $stmt->execute($filter_array);
    $r = $stmt->fetch();

    $per_page = 10;
    $no_of_pages = ceil($r['user_count'] / $per_page);

    $fobj= new \Lib\Forum\Forum();
    $pages = $fobj->paginate($no_of_pages, $_GET['pno'], A_RURI . "index.php?page=users" . $filter_url . "&pno=", true);
    $smarty->assign('pagination_links', $pages);

    $pno = $_GET['pno'];
    $pno--; //starts from 0
    $offset = (int) $per_page * $pno;



//------------------------get users

    $query = "SELECT u.id,u.username,u.user_status,r.rname as role,u.created,u.no_posts "
            . " FROM " . PREFIX . "codo_users as u, " . PREFIX . "codo_roles as r"
            . " WHERE u.rid=r.rid " . $filters
            . " ORDER BY $sort_column $sort_order "
            . " LIMIT 10 OFFSET $offset";
//var_dump($query);
    $stmt = $db->prepare($query);
    $stmt->execute($filter_array);

    $smarty->assign('users', $stmt->fetchAll());





    $content = $smarty->fetch('users.tpl');
}