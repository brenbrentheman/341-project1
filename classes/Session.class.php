<?php

    class Session {
        private $idsession;
        private $name;
        private $numberallowed;
        private $event;
        private $startdate;
        private $enddate;

        function __construct($id, $sessionName, $allowed, $eventName, $start, $end) {
            $this->idsession = $id;
            $this->name = $sessionName;
            $this->numberallowed = $allowed;
            $this->event = $eventName;
            $this->startdate = $start;
            $this->enddate = $end;
        }
    }

?>