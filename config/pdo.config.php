<?php
/**
 * pdo.config.php
 *
 * Contains PDO base class
 *
 * @author Brandon Telle
 */

class RTP_PDO Extends PDO {
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;

    function  __construct()
    {
        $this->engine = "mysql";
        $this->host = SQL_HOST;
        $this->user = SQL_USER;
        $this->pass = SQL_PASS;
        $this->database = SQL_DB;

        $dsn = $this->engine.':dbname='.$this->database.";host=".$this->host;

        parent::__construct($dsn, $this->user, $this->pass);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

?>
