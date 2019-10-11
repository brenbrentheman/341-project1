<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Events
    */

    session_name("events");
    session_start();
    if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
        header("Location: Login.php");
    }
    
    require_once "utilities.inc.php";
    $eventDB = new EventsPDO();
    $sessionsDB = new SessionPDO();

    echo "<h1>Upcoming Events:</h1>";
    $events = $eventDB->getAllEvents();
    $sessions = $sessionsDB->getAllSessions();
    
    foreach($events as $event) {
        $eventListing = "<h2>{$event->getName()}</h2>
            <h3>{$event->getStartDate()} - {$event->getEndDate()}</h3>
            <h4>".Venue::getVenueByName($event->getID())."</h4>
            <h5>Maximum Participants: {$event->getNumberAllowed()}<h5>";
        
        echo $eventListing;
    }
    foreach($sessions as $session) {
        echo $session->getName();
    }

?>