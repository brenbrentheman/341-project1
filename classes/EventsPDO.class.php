<?php 
/*Handles DB interactions using a PDO driver*/
require_once "PDODB.class.php";
require_once "Event.class.php";
require_once "Session.class.php";

class EventsPDO extends PDODB {

    function getAllEvents() {
        try{
            /*Since we are returning as a table join venue to get the venue names rather than numbers. The events class is flexible enough to still et us use it this way*/
            $stmt = $this->dbh->query("SELECT * FROM event");
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Event");

            /*Store all our events */
            $events = $stmt->fetchAll();
            return $events;
        }
        catch(PDOException $ex) {
            die("There was a problem");
        }

    }
}