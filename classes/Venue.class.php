<?php
    class Venue {

        private $idvenue;
        private $name;
        private $capacity;

        static function getVenueByName($venueID) {
            require_once "VenuePDO.class.php";
            $venueDB = new VenuePDO();
            return $venueDB->getVenueName($venueID);
        }

        static function getAllVenues() {
            require_once "VenuePDO.class.php";
            $venueDB = new VenuePDO();
            return $venueDB->getAllVenues();
        }

        public function getName() {
            return $this->name;
        }

        public function getID() {
            return $this->idvenue;
        }

        public function getCapacity() {
            return $this->capacity;
        }

    }

?>