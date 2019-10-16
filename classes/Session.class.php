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

        function getEventName() {
            require_once "EventsPDO.class.php";
            $db = new EventsPDO();
            return $db->getEventName($this->event)["name"];
        }

        function getSessionAsRow() {
            return "<tr data-session='{$this->idsession}'>
            <td>{$this->idsession}</td>
            <td>{$this->name}</td>
            <td>{$this->getEventName()}</td>
            <td>{$this->startdate}</td>
            <td>{$this->enddate}</td>
            <td>{$this->numberallowed}</td>
            </tr>";
        }

        public static function getAllSessions() {
            require "SessionPDO.class.php";
            $db = new SessionPDO();
            return $db->getAllSessions();
        }

        public static function getSessionByID($sessionID) {
            require "SessionPDO.class.php";
            $db = new SessionPDO();
            return $db->getSessionByID($sessionID);
        }

    }

?>