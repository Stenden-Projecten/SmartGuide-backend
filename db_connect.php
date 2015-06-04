<?php

require_once(__DIR__ . "/db_config.php");

class DB_CONNECT {
    public $con = null;
    public $error = null;

    function __construct() {
        $this->connect();
    }
 
    function __destruct() {
        $this->close();
    }
 
    function connect() {
        $this->con = @mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        if(mysqli_connect_errno()) {
            $this->error = "SQL error:" . mysqli_connect_error();
            return null;
        }
    }
 
    function close() {
        mysqli_close($this->con);
    }
}