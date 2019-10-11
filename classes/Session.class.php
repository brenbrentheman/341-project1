<?php

    class Session {
        private $idsession;
        private $name;
        private $numberallowed;
        private $event;
        private $startdate;
        private $enddate;

        public static function newSession($id, $sessionName, $allowed, $eventName, $start, $end) {
            $session = new self;
            $session->idsession = $id;
            $session->name = $sessionName;
            $session->numberallowed = $allowed;
            $session->event = $eventName;
            $session->startdate = $start;
            $session->enddate = $end;
        }

        function getID() {
            return $this->idsession;
        }

        function getName() {
            return $this->name;
        }

        function getStartDate() {
            return $this->startdate;
        }

        function getEndDate() {
            return $this->enddate;
        }

        function getNumberAllowed() {
            return $this->numberallowed;
        }

        function getEvent() {
            return $this->event;
        }
    }

?>