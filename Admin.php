<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Admin
    */
    /*Because the session var ["currentUser"] is an attendee object it must be called before session start*/
    require_once "./classes/Attendee.class.php";
    session_name("events");
    session_start();
    /*Authentication and authorization checks*/
    if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] || !isset($_SESSION["currentUser"])) {
        header("Location: Login.php");
    }
    /*Load utilities*/
    require_once "utilities.inc.php";

    /*Get the authorization level*/
    define("USER_ROLE", $_SESSION["currentUser"]->getRole());

    /*Page header */
    Header::buildHeader("Admin", true);
    $displayName = ucwords($_SESSION["currentUser"]->getName());
    echo "<h1>Registrations:</h1>
    <h2>Hi {$displayName}, you can view and manage users, events, and sessions below!</h2>";
    /*Determine if user can access admin page  - user is at least an event manager*/
    if(!(USER_ROLE < 3)) {
        header("Location: Events.php");
    }

    /*if user is an admin */
    if(USER_ROLE == 1) {
        /*Get all events, sessions, and users */
        $events = Event::getAllEvents();
        $sessions = Session::getAllSessions();
        $users = Attendee::getAllUsers();


    }

    /*For event managers*/
    if(USER_ROLE == 2) {
        //get all events, sessions, and users managed by this user
        $events = $_SESSION["currentUser"]->getManagedEvents();//get events managed by this user -- Returns an associative array
        $sessions = array();//to be filled with users managed sessions
        $users = array();
        /*Load up the sessions and manage users arrays*/
        foreach($events as $event) {
            $sessions["{$event->getID()}"] = Session::getSessionsByEventID($event->getID());
            $managedUsers  = Event::getAllAttendeesForEvent($event->getID());
        } 
    }

    /*Admin page features for both Admins and Event Managers*/

    /*EVENTS*/
    



    /*SESSIONS*/


    /*ATTENDEES*/





    /*Lastly the footer */
    Footer::buildFooter();
?>