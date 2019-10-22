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

        function getSessionsByEventID($eventID) {
            try{
                /*Get all our sessions for the events*/
                $stmt = $this->dbh->prepare("SELECT * FROM session WHERE event = :eventID");
                $stmt->execute(array("eventID"=>$eventID));
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Session");
    
                /*Store all sessions*/
                $sessions = $stmt->fetchAll();//get all results
                return $sessions;
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }

        function getAttendeeCount($sessionID) {
            try{
                $stmt = $this->dbh->prepare("SELECT COUNT(attendee) FROM attendee_session WHERE session = :session");
                $stmt->execute(array("session"=>$sessionID));
                $num = $stmt->fetch();//get rows affected
                return $num;
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }

        function deleteSessionAttendee($sessionID) {
            try{
                $stmt = $this->dbh->prepare("DELETE FROM attendee_session WHERE session = :session");
                $stmt->execute(array("session"=>$sessionID));
                $rows = $stmt->rowCount();//get rows affected
                return $rows;
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }

    }
?>