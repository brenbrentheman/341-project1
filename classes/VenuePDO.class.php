<?php
require_once "PDODB.class.php";

    class VenuePDO extends PDODB {

        function getVenueName($venueID) {
            try{
                /*Get all our sessions for the events*/
                $stmt = $this->dbh->prepare("SELECT name FROM venue WHERE idvenue = :id");
                $stmt->execute(array("id"=>$venueID));
    
                /*Store all sessions*/
                $venueName = $stmt->fetch();
                return $venueName[0];
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }

        function getAllVenues() {
            try{
                /*Get all our sessions for the events*/
                $stmt = $this->dbh->query("SELECT * FROM venue");
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Venue");

                return $stmt->fetchAll();
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }
           

    }
?>