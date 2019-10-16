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

        function getSessionByID($sessionID) {
            try{
                /*Get all our sessions for the events*/
                $stmt = $this->dbh->prepare("SELECT * FROM session WHERE idsession = :sessionID");
                $stmt->execute(array("sessionID"=>$sessionID));
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Session");
    
                /*Store all sessions*/
                $session = $stmt->fetch();//get first row
                return $session;
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }

    }
?>