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
            require "Venue.class.php";
            $venueName = Venue::getVenueByName($this->venue);
            return "<tr>
            <td>{$this->idevent}</td>
            <td>{$this->name}</td>
            <td>$venueName</td>
            <td>{$this->datestart}</td>
            <td>{$this->dateend}</td>
            <td>{$this->numberallowed}</td>
            </tr>";
        }
    }

?>