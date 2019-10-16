<?php
    require_once "AttendeePDO.class.php";
    class Attendee {
        
        private $idattendee;
        private $name;
        private $password;
        private $role;

        public static function newAttendee($id, $name, $pw, $attendeeRole) {
            $attendee = new self;
            $attendee->idattendee = $id;
            $attendee->name = $name;
            $attendee->password = $pw;
            $attendee->role = $attendeeRole;
            return $attendee;
        }

        function getID() {
            return $this->idattendee;
        }

        function getName() {
            return $this->name;
        }

        function getPassword() {
            return $this->password;
        }

        function getRole() {
            return $this->role;
        }

        function getAllEventsForUser() {
            $db = new AttendeePDO();
            return $db->getAllEventsByID($this->idattendee);
        }

        function getAllSessionsForUser() {
            $db = new AttendeePDO();
            return $db->getAllSessionsbyID($this->idattendee);
        }

        function unregisterEvent($eventID, $attendeeID=null) {
            $db = new AttendeePDO();
            $attendeeID = $attendeeID === null ? $this->idattendee : $attendeeID;//work around for default paramter since you can't do $this->idattendee in the args
            return $db->unregisterEventByUserID($eventID, $attendeeID);
            $db = null;//reset the connection
        }

        function unregisterSession($sessionID, $attendeeID=null) {
            $db = new AttendeePDO();
            $attendeeID = $attendeeID === null ? $this->idattendee : $attendeeID;//work around for default paramter since you can't do $this->idattendee in the args
            return $db->unregisterSessionByUserID($sessionID, $attendeeID);
            $db = null;//reset the connection
        }

        function registerSession($sessionID, $attendeeID=null) {
            $db = new AttendeePDO();
            $attendeeID = $attendeeID === null ? $this->idattendee : $attendeeID;//work around for default paramter since you can't do $this->idattendee in the args
            return $db->registerSessionByUserID($sessionID, $attendeeID);
            $db = null;//reset the connection
        }
    }
?>