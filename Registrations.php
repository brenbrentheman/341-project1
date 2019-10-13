<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Registrations
    */
    /*Because the session var ["currentUser"] is an attendee object it must be called before session start*/
    require "./classes/Attendee.class.php";

    session_name("events");
    session_start();
    /*Authentication and authorization checks*/
    if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] || !isset($_SESSION["currentUser"])) {
        header("Location: Login.php");
    }
    require_once "utilities.inc.php";
    /*Page header */
    $displayName = ucwords($_SESSION["currentUser"]->getName());
    echo "<h1>Registrations:</h1>
       <h2>Hi {$displayName}, you can view and manage your registrations below!</h2>";

    /*Display the users events and sessions*/
    $userEvents = $_SESSION["currentUser"]->getAllEventsForUser();
    $userSessions = $_SESSION["currentUser"]->getAllSessionsForUser();

    echo "<h3>Your Registered Events:</h3>";
    $eventsTable = "<table><thead><tr>
        <td>Event ID</td>
        <td>Name</td>
        <td>Venue</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Capacity</td>
        </tr></thead><tbody>";
    foreach($userEvents as $event) {
        $eventsTable .= $event->getAsTableRow();
    }
    $eventsTable .= "</tbody></table>";
    echo $eventsTable;

    echo "<h3>Your Registered Event Sessions:</h3>";
    $sessionsTable = "<table><thead><tr>
        <td>Session ID</td>
        <td>Name</td>
        <td>Event</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Capacity</td>
        </tr></thead><tbody>";
    foreach($userSessions as $session) {
        $sessionsTable .= $session->getSessionAsRow();
    }
    $sessionsTable .= "</tbody></table>";
    echo $sessionsTable;
    

    

   




?>