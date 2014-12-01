<?php

/*
 * @CODOLICENSE
 */

//defined('IN_CODOF') or die();
//defined('CODO_LICENSE') or die();

if (isset($_POST['db_name']) && isset($_POST['post_req'])) {
    
} else {
    if (!isset($_SESSION['LICENSE_ACCEPTED'])) {
        exit('license not accepted');
    }
}

class Step3 {

    public function __construct($db = false) {

        if($db) {
            
            $this->db = $db;
        }
    }

    public function write_conf($dsn, $user, $pass) {

        $conf = "<?php

/* 
 * @CODOLICENSE
 */

defined('IN_CODOF') or die();

\$installed=false;

function get_codo_db_conf() {

 return array(
    
  'DSN'    => '" . $dsn . "',
  'user'   => '" . $user . "',
  'pass'   => '" . $pass . "',
  'prefix' => ''  
);

}

\$DB = get_codo_db_conf();

\$CONF = array (
    
  'driver' => 'Custom',
  'UID'    => '" . uniqid() . "',
  'SECRET' => '" . uniqid() . "',
  'PREFIX' => ''
);
";

        file_put_contents(ABSPATH . 'sites/default/config.php', $conf);
    }

    public function connect_db($host, $client_db_name, $username, $password, $port, $driver = 'mysql') {

        if (!extension_loaded('PDO') || !extension_loaded('pdo_' . $driver)) {
            return array("pdo_" . $driver . " driver is not installed or enabled", false);
        }

        $keys = array(
            'mysql' => array(
                "host" => "host",
                "dbname" => "dbname",
                "port" => ";port="
            ),
            'sqlsrv' => array(
                "host" => "Server",
                "dbname" => "Database",
                "port" => ","
            )
        );


        if (strpos($host, "/") !== FALSE) {

            if (strpos($host, ":") !== FALSE) {
                //localhost:socket_dir
                $parts = explode(":", $host);
                $host = $keys[$driver]["host"] . "=" . $parts[0];
                $unix_socket = ";unix_socket=" . $parts[1];
            } else {
                //socket_dir
                $unix_socket = "unix_socket=$host";
                $host = '';
            }
        } else {
            //clean host
            $unix_socket = '';
            $host = $keys[$driver]["host"] . "=$host";
        }

        $error = false;

        if ($port != '') {
            $port = $keys[$driver]["port"] . "$port;";
        } else {
            $port = ";";
        }



        $dbname = $keys[$driver]["dbname"] . "=";

        $dsn = "$driver:$host$unix_socket$port$dbname$client_db_name";

        try {

            @$dbh = new PDO($dsn, $username, $password, array(
                PDO::ATTR_PERSISTENT => false
            ));
        } catch (PDOException $e) {

            //self::freichat_debug("unable to connect to database. Error : " . $e->getMessage());
            $error = $e->getMessage();
        }

        if (!$error) {
            return array($dsn, true);
        }

        $dbh = null; //reset connection;
        //if in localhost , host cannot be localhost for unix 

        $_error = false;

        $host = $keys[$driver]["host"] . "=127.0.0.1";

        $dsn = "$driver:$host$unix_socket$port$dbname$client_db_name";

        try {
            @$dbh = new PDO($dsn, $username, $password, array(
                PDO::ATTR_PERSISTENT => false
            ));
        } catch (PDOException $e) {

            //self::freichat_debug("unable to connect to database. Error : " . $e->getMessage());
            $_error = $e->getMessage();
        }

        if (!$_error) {
            return array($dsn, true);
        }

        return array($error, false);
    }

//
// remove_remarks will strip the sql comment lines out of an uploaded sql file
//
    private function remove_remarks($sql) {
        $lines = explode("\n", $sql);

        // try to keep mem. use down
        $sql = "";

        $linecount = count($lines);
        $output = "";

        for ($i = 0; $i < $linecount; $i++) {
            if (($i != ($linecount - 1)) || (strlen($lines[$i]) > 0)) {
                if (isset($lines[$i][0]) && $lines[$i][0] != "#") {
                    $output .= $lines[$i] . "\n";
                } else {
                    $output .= "\n";
                }
                // Trading a bit of speed for lower mem. use here.
                $lines[$i] = "";
            }
        }

        return $output;
    }

//
// split_sql_file will split an uploaded sql file into single sql statements.
// Note: expects trim() to have already been run on $sql.
//
    private function split_sql_file($sql, $delimiter) {
        // Split up our string into "possible" SQL statements.
        $tokens = explode($delimiter, $sql);

        // try to save mem.
        $sql = "";
        $output = array();

        // we don't actually care about the matches preg gives us.
        $matches = array();

        // this is faster than calling count($oktens) every time thru the loop.
        $token_count = count($tokens);
        for ($i = 0; $i < $token_count; $i++) {
            // Don't wanna add an empty string as the last thing in the array.
            if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0))) {
                // This is the total number of single quotes in the token.
                $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
                // Counts single quotes that are preceded by an odd number of backslashes,
                // which means they're escaped quotes.
                $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

                $unescaped_quotes = $total_quotes - $escaped_quotes;

                // If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
                if (($unescaped_quotes % 2) == 0) {
                    // It's a complete sql statement.
                    $output[] = $tokens[$i];
                    // save memory.
                    $tokens[$i] = "";
                } else {
                    // incomplete sql statement. keep adding tokens until we have a complete one.
                    // $temp will hold what we have so far.
                    $temp = $tokens[$i] . $delimiter;
                    // save memory..
                    $tokens[$i] = "";

                    // Do we have a complete statement yet?
                    $complete_stmt = false;

                    for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++) {
                        // This is the total number of single quotes in the token.
                        $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
                        // Counts single quotes that are preceded by an odd number of backslashes,
                        // which means they're escaped quotes.
                        $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

                        $unescaped_quotes = $total_quotes - $escaped_quotes;

                        if (($unescaped_quotes % 2) == 1) {
                            // odd number of unescaped quotes. In combination with the previous incomplete
                            // statement(s), we now have a complete statement. (2 odds always make an even)
                            $output[] = $temp . $tokens[$j];

                            // save memory.
                            $tokens[$j] = "";
                            $temp = "";

                            // exit the loop.
                            $complete_stmt = true;
                            // make sure the outer loop continues at the right point.
                            $i = $j;
                        } else {
                            // even number of unescaped quotes. We still don't have a complete statement.
                            // (1 odd and 1 even always make an odd)
                            $temp .= $tokens[$j] . $delimiter;
                            // save memory.
                            $tokens[$j] = "";
                        }
                    } // for..
                } // else
            }
        }

        return $output;
    }

    private function get_queries($sql) {

        $sql = $this->remove_remarks($sql);

        $sql = $this->split_sql_file($sql, ';');

        return $sql;
    }

    public function create_tables() {

        $sql = file_get_contents("codoforum.sql");

        $queries = $this->get_queries($sql);

        $res = false;
        //print_r($queries);
        foreach ($queries as $query) {
            //reformat the query
            $query = trim($query) . ";";

            $res = $this->db->query($query);

            if (!$res) {
                //problem;
                echo $query;
                break;
            }
        }

        return $res;
    }

    public function insert_triggers() {

        $triggers = array();

        $triggers[] = "DROP TRIGGER IF EXISTS after_insert_topic;";

        $triggers[] = "CREATE TRIGGER after_insert_topic
    AFTER INSERT ON codo_topics FOR EACH ROW
    BEGIN

		UPDATE codo_categories SET no_topics = no_topics+1 WHERE cat_id=NEW.cat_id;
    END";

        $triggers[] = "DROP TRIGGER IF EXISTS after_update_topic;";

        $triggers[] = "CREATE TRIGGER after_update_topic
    AFTER UPDATE ON codo_topics FOR EACH ROW
    BEGIN

		
		IF OLD.topic_status=1 AND NEW.topic_status=0 THEN
			#topic updated status from undeleted to deleted

			UPDATE codo_categories SET no_topics = no_topics-1 WHERE cat_id=NEW.cat_id;

		ELSEIF OLD.topic_status=0 AND NEW.topic_status=1 THEN
			#topic updated status from deleted to undeleted

			UPDATE codo_categories SET no_topics = no_topics+1 WHERE cat_id=NEW.cat_id;
		
		END IF;

    END";

        $triggers[] = "DROP TRIGGER IF EXISTS after_insert_post;";

        $triggers[] = "CREATE TRIGGER after_insert_post
    AFTER INSERT ON codo_posts FOR EACH ROW
    BEGIN

		UPDATE codo_categories SET no_posts = no_posts+1 WHERE cat_id=NEW.cat_id;
		UPDATE codo_topics SET no_posts = no_posts+1 WHERE topic_id=NEW.topic_id;
		UPDATE codo_users SET no_posts = no_posts+1 WHERE id=NEW.uid;

    END";

        $triggers[] = "DROP TRIGGER IF EXISTS after_update_post;";

        $triggers[] = "CREATE TRIGGER after_update_post
    AFTER UPDATE ON codo_posts FOR EACH ROW
    BEGIN

		
		IF OLD.post_status=1 AND NEW.post_status=0 THEN
			#post updated status from undeleted to deleted

			UPDATE codo_categories SET no_posts = no_posts-1 WHERE cat_id=NEW.cat_id;
			UPDATE codo_topics SET no_posts = no_posts-1 WHERE topic_id=NEW.topic_id;
                        UPDATE codo_users SET no_posts = no_posts-1 WHERE id=NEW.uid;

		ELSEIF OLD.post_status=0 AND NEW.post_status=1 THEN
			#post updated status from deleted to undeleted

			UPDATE codo_categories SET no_posts = no_posts+1 WHERE cat_id=NEW.cat_id;
			UPDATE codo_topics SET no_posts = no_posts+1 WHERE topic_id=NEW.topic_id;
        		UPDATE codo_users SET no_posts = no_posts+1 WHERE id=NEW.uid;
		
		END IF;

    END";

        foreach ($triggers as $trigger) {

            $this->db->query($trigger);
        }
    }

    public function install() {

        $this->db = \Lib\DB::get_db();
        $this->create_tables();
        $this->insert_triggers();

        $reg = new Lib\User\Register($this->db);
        $reg->username = $_POST['admin_user'];
        $reg->name = $reg->username;
        $reg->password = $_POST['admin_pass'];
        $reg->mail = $_POST['admin_mail'];
        $reg->user_status = 1;
        $reg->rid = 4;
        $reg->register_user();
        
        //set as installed
        $filename = ABSPATH . "sites/default/config.php";
        $contents = file_get_contents($filename);
        $contents = str_replace("\$installed=false;", "\$installed=true;", $contents);
        file_put_contents($filename, $contents);
    }

}

if(!defined('CODO_INTEG_RUNNING')) {

$step3 = new Step3();

if (isset($_POST['db_name']) && isset($_POST['post_req'])) {

    $conn = $step3->connect_db($_POST['db_host'], $_POST['db_name'], $_POST['db_user'], $_POST['db_pass'], '3306');

    if ($conn[1]) {

        $step3->write_conf($conn[0], $_POST['db_user'], $_POST['db_pass']);
    }

    echo json_encode($conn);
} else {

    $step3->install();
}

}
