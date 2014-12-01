<?php

/*
 * @CODOLICENSE
 */

$db = Lib\DB::get_db();
$token = Lib\Access\CSRF::get_token();
$smarty->assign("CSRF", $token);
$tpl = 'categories.tpl';
if (isset($_GET['action'])) {

    if ($_GET['action'] == 'reorder') {

        $obj = json_decode($_POST['data']);
        //var_dump($obj);
        $buff = array();
        $i = 0;
        $arr = $obj;
        $p_id = 0;
        linearize($arr, $buff, $i, $p_id);
        //var_dump($buff);
        $query = "UPDATE " . PREFIX . 'codo_categories '
                . 'SET cat_order=:cat_order,cat_pid=:cat_pid WHERE cat_id=:cat_id';
        $stmt = $db->prepare($query);
        foreach ($buff as $value) {


            $stmt->execute($value);
        }
        echo "Order Has Been Saved!";
    } else if ($_GET['action'] == 'delete') {

        delete_category($_POST['del_cat_id'], $db, $smarty);
    } else if ($_GET['action'] == 'edit') {

        $tpl = 'category_edit.tpl';
        $smarty->assign('cat_id', $_GET['cat_id']);


        if (isset($_POST['mode']) && $_POST['mode'] == 'edit') {

            $query = "UPDATE " . PREFIX . "codo_categories SET cat_name=:cat_name,cat_description=:cat_description";
            $imgql = "";
            $cond = " WHERE cat_id=:cat_id";

            $arr[':cat_name'] = $_POST['cat_name'];
            $arr[':cat_description'] = $_POST['cat_description'];
            $arr[':cat_id'] = $_GET['cat_id'];

            //$image=$_FILES['cat_img'];
            if (isset($_FILES['cat_img'])) {

                $image = $_FILES['cat_img'];
                if (
                        
                        !\Lib\File\Upload::valid($image) OR
                        !\Lib\File\Upload::not_empty($image) OR
                        !\Lib\File\Upload::type($image, array('jpg', 'jpeg', 'png', 'gif', 'pjpeg', 'bmp'))) {
                    $smarty->assign('err', 1);
                    $smarty->assign('msg', "Error While uploading the image.");
                } else {

                    $file_info = \Lib\File\Upload::save($image, NULL, DATA_PATH . 'assets/img/cats', 0777);
                    $arr[":cat_img"] = $file_info["name"];
                    $imgql = ",cat_img=:cat_img";
                }
            }
            $stmt = $db->prepare($query . $imgql . $cond);
            $stmt->execute($arr);
        }



        $query = "SELECT * FROM " . PREFIX . "codo_categories WHERE cat_id=:cat_id";
        $stmt = $db->prepare($query);
        $res = $stmt->execute(array(':cat_id' => $_GET['cat_id']));
        if ($res) {
            $row = $stmt->fetch();
            $smarty->assign('cat', $row);
        }
    }
}

function delete_category($id, $db, $smarty) {


    if (Lib\Access\CSRF::valid($_POST['CSRF_TOKEN'])) {

        $query = "DELETE FROM " . PREFIX . "codo_categories WHERE cat_id=:cat_id";
        $stmt = $db->prepare($query);
        $stmt->execute(array(':cat_id' => $id));
    }
}

function linearize($arr, &$buff, &$i, $p_id) {

    foreach ($arr as $ray) {

        $buff[$i] = array(':cat_id' => $ray->id, ':cat_pid' => $p_id, ':cat_order' => $i);
        $i++;
        if (isset($ray->children)) {

            linearize($ray->children, $buff, $i, $ray->id);
        }
    }
}

$smarty = \Lib\Smarty\Single::get_instance();



$smarty->assign('msg', '');
$smarty->assign('err', 0);

if (isset($_POST['mode'])) {

    if ($_POST['mode'] == 'new') {


        $qry = 'INSERT INTO ' . PREFIX . 'codo_categories'
                . '(cat_pid,cat_name,cat_alias,cat_description,cat_img,no_topics,no_posts,cat_order)'
                . 'VALUES(:cat_pid,:cat_name,:cat_alias,:cat_description,:cat_img,:no_topics,:no_posts,:cat_order)';
        $stmt = $db->prepare($qry);

        $arr[":cat_pid"] = 0;
        $arr[":cat_name"] = $_POST['cat_name'];
        $arr[":cat_alias"] = Lib\Filter::URL_safe($_POST['cat_name']); //
        $arr[":cat_img"] = 1; //$_POST['cat_img']; //
        $arr[":cat_description"] = $_POST['cat_description'];
        $arr[":no_topics"] = 0;
        $arr[":no_posts"] = 0;
        $arr[":cat_order"] = 0;
        //$stmt->execute($arr);
        $image = $_FILES['cat_img'];

        if (
                !\Lib\File\Upload::valid($image) OR
                !\Lib\File\Upload::not_empty($image) OR
                !\Lib\File\Upload::type($image, array('jpg', 'jpeg', 'png', 'gif', 'pjpeg', 'bmp'))) {
            $smarty->assign('err', 1);
            $smarty->assign('msg', "Error While uploading the image.");
        } else {

            $file_info = \Lib\File\Upload::save($image, NULL, DATA_PATH . 'assets/img/cats', 0777);
            $arr[":cat_img"] = $file_info["name"];
            $stmt->execute($arr);
            $smarty->assign('msg', 'New Category Created!');
        }
    }
}

$qry = 'SELECT *  FROM ' . PREFIX . 'codo_categories ORDER BY cat_order';
$res = $db->query($qry);

if ($res) {

    $res = $res->fetchAll(PDO::FETCH_CLASS);
}


$frm = new Lib\Forum\Forum();

$obj = $frm->generate_tree($res);
//var_dump($obj);

$buffer = "";

//$tree = new stdClass();





//$res=(object)$res;
//$obj = gen_tree($res, 0, $tree);



function print_children($cat, &$buffer) {
    //return; //for the timebeing no sub categories allowed


    $buffer.= "\n\n" . '<li  class="dd-item dd3-item" data-id="' . $cat->cat_id . '">'
            . '<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">' . $cat->cat_alias . ''
            . '                                                         <span style="float:right">'
            . '                                                             <a href="index.php?page=categories&action=edit&cat_id=' . $cat->cat_id . '">Edit</a> '
            . '                                                           | <a href="javascript:void(0)" onclick="delete_cat(' . $cat->cat_id . ')">Delete</a></span></div>';

    if (property_exists($cat, 'children')) {

        foreach ($cat->children as $child) {

            $buffer.="\n<ol  class='dd-list'>";
            print_children($child, $buffer);
            $buffer.="\n</ol>";
        }
    } else {
        
    }
    $buffer.= "\n</li>";
}

$buffer.="\n<div class='dd'  id='nestable3'>\n<ol  class='dd-list'>";

foreach ($obj as $o) {


    print_children($o, $buffer);
}
$buffer.="\n</ol>\n</div>";
$smarty->assign("cats", $buffer);
$smarty->assign('A_RURI', A_RURI);

$content = $smarty->fetch($tpl);
