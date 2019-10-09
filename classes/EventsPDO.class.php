<?php 
/*Handles DB interactions using a PDO driver*/
class EventsPDO {
    private $dbh;

    function __construct() {
        try {
            $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}",
                $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);

            //change error reporting
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $ex) {
            die("There was a problem");
        }
    }

}