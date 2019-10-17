<?php
    class Event {

        private $idevent;
        private $name;
        private $datestart;
        private $dateend;
        private $numberallowed;
        private $venue;

        public static function newEvent($idevent, $name, $datestart, $dateend, $numberallowed, $venue) {
            $event = new self;
            $event->idevent = $idevent;
            $event->name = $name;
            $event->datestart = $datestart;
            $event->dateend = $dateend;
            $event->numberallowed = $numberallowed;
            $event->venue = $venue;
            return $event;
        }

        function getID() {
            return $this->idevent;
        }

        function getName() {
            return $this->name;
        }

        function getStartDate() {
            return $this->datestart;
        }

        function getEndDate() {
            return $this->dateend;
        }

        function getNumberAllowed() {
            return $this->numberallowed;
        }

        function getVenue() {
            return $this->venue;
        }

        function getAsTableRow() {
            require_once "Venue.class.php";
            $venueName = Venue::getVenueByName($this->venue);
            return "<tr data-event='{$this->idevent}'>
            <td>{$this->idevent}</td>
            <td>{$this->name}</td>
            <td>$venueName</td>
            <td>{$this->datestart}</td>
            <td>{$this->dateend}</td>
            <td>{$this->numberallowed}</td>
            </tr>";
        }

        public static function getAllEvents() {
            require_once "EventsPDO.class.php";
            $db = new EventsPDO();
            return $db->getAllEvents();
        }

        public static function getEventByID($eventID) {
            require_once "EventsPDO.class.php";
            $db = new EventsPDO();
            return $db->getEventByID($eventID);
        }

        public static function getAllAttendeesForEvent($eventID) {
            require_once "EventsPDO.class.php";
            $db = new EventsPDO();
            return $db->getAllAttendeesForEvent($eventID);
        }
    }

?>