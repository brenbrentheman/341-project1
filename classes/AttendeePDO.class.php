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

                return $currentUser = $stmt->fetch();//get first row
            }
            catch(PDOException $ex) {
                die("There was a problem");
            }
        }
        
    }