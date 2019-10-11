<?php
require_once "PDODB.class.php";

    class SessionPDO extends PDODB {

        function getAllSessions() {
            try{
                /*Get all our sessions for the events*/
                $stmt = $this->dbh->query("SELECT * FROM session");
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Session");
    
                /*Store all sessions*/
                $sessions = $stmt->fetchAll();
                return $sessions;
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }
           

    }
?>