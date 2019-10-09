<?php
    class Venue {

        private $idvenue;
        private $name;
        private $capacity;
        private $events = [];//the events being held at this venue

        function __construct($id, $venueName, $venueCap) {
            $this->idvenue = $id;
            $this->name = $venueName;
            $this->capacity = $venueCap;
        }

    }

?>