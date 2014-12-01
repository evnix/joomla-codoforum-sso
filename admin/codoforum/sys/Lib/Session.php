<?php

/*
 * @CODOLICENSE
 */

namespace Lib;

/*
 * USER => {
 *    uid    => userid [int]
 *    uname => username [string]
 *    role  => type of user [string]
 *    guest => 0/1 [boolean]
 * }
 * 
 */

class Session /*implements \SessionHandlerInterface */{

    //put your code here

    private $db;

    public function __construct() {

        DB::$persistent = true;
        $this->db = DB::get_db();

        // set our custom session functions.
        session_set_save_handler(array($this, 'open'), array($this, 'close'), array($this, 'read'), array($this, 'write'), array($this, 'destroy'), array($this, 'gc'));

        // This line prevents unexpected effects when using objects as save handlers.
        register_shutdown_function('session_write_close');
    }

    /**
     * Open the session
     * @return bool
     */
    public function open($path, $name) {

        //delete old session handlers
        $limit = time() - (3600 * 12);
        $sql = "DELETE FROM codo_sessions WHERE last_active < $limit";
        $this->db->query($sql);
        return TRUE;
    }

    /**
     * Close the session
     * @return bool
     */
    public function close() {

        return $this->db = null;
    }

    /**
     * Read the session
     * @param int session id
     * @return string string of the sessoin
     */
    public function read($id) {

        $sql = "SELECT session_data FROM codo_sessions WHERE sid = :sid";
        $obj = $this->db->prepare($sql);
        $obj->execute(array("sid" => $id));


        if ($obj->rowCount()) {
            $result = $obj->fetch(\PDO::FETCH_ASSOC);
            return $result['session_data'];
        }
        return false;
    }

    /**
     * Write the session
     * @param int session id
     * @param string data of the session
     */
    public function write($id, $data) {

        $sql = "REPLACE INTO codo_sessions VALUES(:sid, :last_active, :data)";
        $obj = $this->db->prepare($sql);
        $obj->execute(array("sid" => $id, "last_active" => time(), "data" => $data));

        return TRUE;
    }

    /**
     * Destoroy the session
     * @param int session id
     * @return bool
     */
    public function destroy($id) {

        $sql = "DELETE FROM codo_sessions WHERE sid = :sid";
        $obj = $this->db->prepare($sql);
        $obj->execute(array("sid" => $id));

        setcookie(session_name(), "", time() - 3600);
        return TRUE;
    }

    /**
     * Garbage Collector
     * @param int life time (sec.)
     * @return bool
     * @see session.gc_divisor      100
     * @see session.gc_maxlifetime 1440
     * @see session.gc_probability    1
     * @usage execution rate 1/100
     *        (session.gc_probability/session.gc_divisor)
     */
    public function gc($max) {

        $old = time() - intval($max);
        $sql = "DELETE FROM codo_sessions WHERE last_active < $old";
        $this->db->query($sql);

        return TRUE;
    }
}
