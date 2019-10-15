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
    /*Start the session */
    session_name("events");
    session_start();

    /*Authentication and authorization checks*/
    if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] || !isset($_SESSION["currentUser"])) {
        header("Location: Login.php");
    }
    require_once "utilities.inc.php";
    /*Page header */
    Header::buildHeader("Registrations", true);
    $displayName = ucwords($_SESSION["currentUser"]->getName());
    echo "<h1>Registrations:</h1>
       <h2>Hi {$displayName}, you can view and manage your registrations below!</h2>";

    /*Display the current users events and sessions*/
    $userEvents = $_SESSION["currentUser"]->getAllEventsForUser();
    $userSessions = $_SESSION["currentUser"]->getAllSessionsForUser();
    
    /*Get all events available so user can add them if needed */
    $allAvailableEvents = Event::getAllEvents();
    $allAvailableSessions = Session::getAllSessions();

    /*BUILD EVENTS*/
    echo "<h3>Your Registered Events:</h3>";
    $eventsTable = "<table><thead><tr>
        <td>Event ID</td>
        <td>Name</td>
        <td>Venue</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Capacity</td>
        </tr></thead><tbody>";

    /*Select/option of each registered event for the user. Used to */
    $usersEventSelect = "<select id ='userEvents' name='userEvents'><option value ='' selected='true' disabled>Select an Event...</option>";
    foreach($userEvents as $event) {
        $eventsTable .= $event->getAsTableRow();
        $usersEventSelect .= "<option value='{$event->getID()}'>{$event->getName()}</option>";
    }
    $eventsTable .= "</tbody></table>";
    $usersEventSelect .= "</select>";
    //print the events and select/option for events
    echo $eventsTable;

    echo "<br /> <label for='userEvents'>Select one of your events to unregister: </label>" . $usersEventSelect . "<button id='unregister-event'>Unregister</button>";

    /*Allow the user to add events they are not currently registered for*/
    $unRegisteredEventSelect = "<select id ='unregisteredEvents' name='unregisteredEvents'><option value ='' selected='true' disabled>Select an Event to Add...</option>";
    /*Determine events not registered by user */
    foreach($allAvailableEvents as $allEvent) {
        foreach($userEvents as $userEvent){
            if($allEvent->getID() !== $userEvent->getID()) {
                $unRegisteredEventSelect .= "<option value='{$allEvent->getID()}'>{$allEvent->getName()}</option>";
            }
        }
    }
    $unRegisteredEventSelect .= "</select>";
    echo "<br /> <label for='unregisteredEvents'>Select a new Event to add to you Registrations: </label>" . $unRegisteredEventSelect . "<button id='add-event'>Add</button>";
    /*END EVENTS*/

    /*BUILD SESSIONS */
    echo "<h3>Your Registered Event Sessions:</h3>";
    $sessionsTable = "<table><thead><tr>
        <td>Session ID</td>
        <td>Name</td>
        <td>Event</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Capacity</td>
        </tr></thead><tbody>";
    $usersSessionSelect = "<select id='userSessions' name='userSessions'><option value ='' selected='true' disabled>Select a Session...</option>";
    foreach($userSessions as $session) {
        $sessionsTable .= $session->getSessionAsRow();
        $usersSessionSelect .= "<option value='{$session->getID()}' data-eventForSession='{$session->getEvent()}'>{$session->getName()}</option>";
    }
    $sessionsTable .= "</tbody></table>";
    $usersSessionSelect .= "</select>";
    //print the sessions
    echo $sessionsTable;

    echo "<br /> <label for='userSessions'>Select a Session of yours to Unregister: </label>" . $usersSessionSelect  . "<button id='unregister-session'>Unregister</button>";

    /*Allow the user to add events they are not currently registered for*/
    $unRegisteredSessionSelect = "<select id ='unregisteredSessions' name='unregisteredSessions'><option value ='' selected='true' disabled>Select an Event to Add...</option>";
    /*Determine events not registered by user */
    foreach($allAvailableSessions as $allSession) {//go through all sessions
        foreach($userEvents as $event) {
            if($allSession->getEvent() === $event->getID()) {//check if user is registered for an event, if they are check sessions otherwise pass
                foreach($userSessions as $userSession){//compare already registered sessions against the current session
                    if($allSession->getID() !== $userSession->getID()) {
                        $unRegisteredSessionSelect .= "<option value='{$allSession->getID()}'>{$allSession->getName()}</option>";
                    }
                }
            }
        }
    }
    $unRegisteredSessionSelect .= "</select>";
    echo "<br /> <label for='unregisteredSessions'>Select a new session to add to your Registrations: </label>" . $unRegisteredSessionSelect . "<button id='add-session'>Add</button>";
    /*END SESSIONS*/

    echo "<script src='./js/Registrations.js'></script>";
    Footer::buildFooter();
?>