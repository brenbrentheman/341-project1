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
        $sanitizedData = sanitizeInputData($_POST["unregister-event"][0]["eventID"]);
        $rowsAffected = $_SESSION["currentUser"]->unregisterEvent($sanitizedData);//return number of rows affected
        $json["rowsAffected"] = $rowsAffected;

        echo json_encode($json);
    }

    /*Handle incoming requests to add an event registration*/
    if(isset($_POST["add-event"])) {
         
    }

    /*Handle incoming requests to unregister a session*/
    if(isset($_POST["unregister-session"])) {
        /*sanitize and validate data*/
        $sanitizedData = sanitizeInputData($_POST["unregister-session"][0]["sessionID"]);
        $rowsAffected = $_SESSION["currentUser"]->unregisterSession($sanitizedData);
        $json["rowsAffected"] = $rowsAffected;

        echo json_encode($json);
        
    }

    /*Handle incoming requests to add a session registration*/
    if(isset($_POST["add-session"])) {
        require_once "../classes/Session.class.php";
        /*sanitize and validate data*/
        $sanitizedData = sanitizeInputData($_POST["add-session"][0]["sessionID"]);
        $rowsAffected = $_SESSION["currentUser"]->registerSession($sanitizedData);
        $json["rowsAffected"] = $rowsAffected;
        /*If inserted properly return the new table row with the number of rows affected*/
        if($rowsAffected > 0) {
            $newSession = Session::getSessionByID($sanitizedData);
            $sessionTableRow = $newSession->getSessionAsRow();
            $json["tableRow"] = $sessionTableRow;
        }
        
        echo json_encode($json);
    }
?>