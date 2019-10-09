<?
    class Attendee {
        
        private $idattendee;
        private $name;
        private $password;
        private $role;

        function __construct($id, $attendeeName, $pw, $attendeeRole) {
            $this->idattendee = $id;
            $this->name = $attendeeName;
            $this->password = $pw;
            $this->role = $attendeeRole;
        }
    }
?>