<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Registration_Form_Handler
    */

    require_once "../classes/Attendee.class.php";
    require_once "../utilities.inc.php";
    /*Start the session */
    session_name("events");
    session_start();

    /*Authentication and authorization checks*/
    if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] || !isset($_SESSION["currentUser"])) {
       echo header("Location: Login.php");
    }

    /*Handle incoming requests to unregister an event*/
    if(isset($_POST["unregister-event"])) {
        /*Sanitize and validate the data*/
        $sanitizedData = numeric(sanitizeInputData($_POST["unregister-event"][0]["eventID"]));
        echo $_SESSION["currentUser"]->unregisterEvent($sanitizedData);//return number of rows affected
    }

    /*Handle incoming requests to add an event registration*/
    if(isset($_POST["add-event"])) {
        
    }

    /*Handle incoming requests to unregister a session*/
    if(isset($_POST["unregister-session"])) {
        
    }

    /*Handle incoming requests to add a session registration*/
    if(isset($_POST["add-session"])) {
        
    }
?>