<?php
    class Event {

        private $idevent;
        private $name;
        private $datestart;
        private $dateend;
        private $numberallowed;
        private $venue;

        function __construct($id, $eventName, $start, $end, $allowed, $venueName) {
            $this->idevent = $id;
            $this->name = $eventName;
            $this->datestart = $start;
            $this->dateend = $end;
            $this->numberallowed = $allowed;
            $this->venue = $venue;
        }
    }

?>