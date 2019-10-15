<?php 
    /*Handles DB interactions for the attendees*/

    require_once "PDODB.class.php";
    require_once "Attendee.class.php";

    class AttendeePDO extends PDODB {

        function getCurrentUser($userID) {
            try{
            
                $stmt = $this->dbh->prepare("SELECT * FROM attendee WHERE idattendee = :id");
                $stmt->execute(array("id"=>$userID));
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Attendee");

                return $stmt->fetch();//get first row
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }

        function getAllEventsByID($userID) {
            require "Event.class.php";
            try {
                $stmt = $this->dbh->prepare("SELECT * FROM event JOIN attendee_event ON event.idevent = attendee_event.event WHERE attendee_event.attendee = :id");
                $stmt->execute(array("id"=>$userID));
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Event");

                return $stmt->fetchAll();//get first row
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }

        function getAllSessionsByID($userID) {
            require "Session.class.php";
            try {
                $stmt = $this->dbh->prepare("SELECT * FROM session JOIN attendee_session ON session.idsession = attendee_session.session WHERE attendee_session.attendee = :id");
                $stmt->execute(array("id"=>$userID));
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Session");

                return $stmt->fetchAll();//get first row
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }

        function unregisterEventByUserID($eventID, $attendeeID) {
            try {
                $stmt = $this->dbh->prepare("DELETE FROM attendee_event WHERE event = :eventID AND attendee = :attendeeID");
                $stmt->execute(array("eventID"=>$eventID, "attendeeID"=>$attendeeID));

                return $stmt->rowCount();//get first row
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }
        
    }