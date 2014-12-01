<?php

/*
 * @CODOLICENSE
 */

namespace Lib\Forum;

class Forum {

    public $pid;

    function generate_tree($res, $pid = 0, $tree = null) {

        if ($tree == null) {
            $tree = new \stdClass();
        }

        foreach ($res as $r) {
            if ($r->cat_pid == $pid) {

                if ($r->cat_pid == 0) {
                    $tree->{$r->cat_id} = $this->generate_tree($res, $r->cat_id, $r);
                } else {

                    if (!property_exists($tree, 'children')) {

                        $tree->{'children'} = new \stdClass();
                    }
                    $tree->{'children'}->{$r->cat_id} = $this->generate_tree($res, $r->cat_id, $r);

                    }
            }
        }
        //var_dump($tree);
        return $tree;
    }
    
    /**
     * 
     * Recursively adds no_topics of sub categories to parent categories
     * @param type $cats
     * @return int
     */
    function update_count(&$cats) {

        $cnt = 0;

        foreach ($cats as $c) {

            $c->no_topics = (int) $c->no_topics + $this->update_count($c->children);
            $cnt += $c->no_topics;
        }

        if ($cats != null) {
            
            //total count of children of this category
            return $cnt;
        }
        
        //no children so 0
        return 0;
    }    
    

    public function add_const_to_arr($arr) {

        $arr["RURI"] = RURI;
        $arr["DURI"] = DURI;
        $arr["CAT_IMGS"] = CAT_IMGS;
        $arr["DEF_AVATAR"] = DEF_AVATAR;
        $arr["CURR_THEME"] = CURR_THEME;

        return $arr;
    }

    public function get_js_editor_files() {

        $files = array('markitup/jquery.markitup.js', 'markitup/parsers/marked.js',
            'markitup/highlight/highlight.pack.js', 'dropzone/dropzone.js',
            'js/editor.js', 'js/fittext.js', 'js/griphandler.js');

        foreach ($files as $file_index => $file) {

            $files[$file_index] = DATA_PATH . 'assets/' . $file;
        }

        return $files;
    }

    public function paginate($num_pages, $curr_page, $url, $root = false) {

        $html = '';
        $times = 5 + ($curr_page - 2);

        if ($num_pages < $times) {

            $times = $num_pages; //run num times
        }

        if (!$root) {

            $url = RURI . $url;
        }

        $cnt = 1;

        if ($curr_page > 5) {

            $html .= '<a href="' . $url . $cnt . '"> ' . $cnt . '</a> ... ';
            $cnt += ($curr_page - 4);
        }

        for ($i = $cnt; $i <= $times; $i++) {

            if ($curr_page == $i) {
                $html .= '<a class="codo_topics_curr_page">' . $i . '</a>';
            } else {
                $html .= '<a href="' . $url . $i . '">' . $i . '</a>';
            }
        }

        if ($num_pages > $times) {
            $html .= ' ... <a href="' . $url . $num_pages . '">' . $num_pages . '</a>';
        }

        return $html;
    }

    public function get_num_pages($total, $per_page) {

        return ceil($total / $per_page);
    }

}
