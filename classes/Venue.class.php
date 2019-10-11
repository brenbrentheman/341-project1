<?php
    class Venue {

        private $idvenue;
        private $name;
        private $capacity;
        private $events = [];//can be used to hold all events for a venue

        static function getVenueByName($venueID) {
            require_once "VenuePDO.class.php";
            $venueDB = new VenuePDO();
            return $venueDB->getVenueName($venueID);
        }

    }

?>