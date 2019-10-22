<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Admin_Form_Handler
    */
    require_once "./classes/Attendee.class.php";
    if(isset($_GET["feature"]) && !empty($_GET["feature"])) {
        switch ($_GET["feature"]) {
            
            case "event":
            eventSubmissionHandler();
            break;

            case "session":
            sessionSubmissionHandler();
            break;
        }
    }

    /*Handle event form submissions*/
    function eventSubmissionHandler() {
        if(isset($_POST["action"]) && !empty($_POST["action"])) {
            switch($_POST["action"]) {

                case "add":
                addEvent();
                break;

                case "update":
                updateEvent();
                break;

                case "delete":
                deleteEvent();
                break;

                case "add-user":
                addEventUser();
                break;

                case "remove-user":
                removeEventUser();
                break;

            }
        }
    }

    /*Handle session form submissions*/
    function sessionSubmissionHandler() {
        if(isset($_POST["action"]) && !empty($_POST["action"])) {
            switch($_POST["action"]) {

                case "add":
                addSession();
                break;

                case "update":
                updateSession();
                break;

                case "delete":
                deleteSession();
                break;

                case "add-user":
                addSessionUser();
                break;

                case "remove-user":
                removeSessionUser();
                break;

            }
        }
    }

    /*Event Functions - add,update,delete, add user, remove user */

    function addEvent() {
        //make sure all needed variables are set
        if(checkIfAllSet([$_POST["eventName-add"],$_POST["venue-add"],$_POST["eventStartDate-add"],$_POST["eventEndDate-add"],$_POST["eventCapacity-add"]])) {
            $managerInsert = 0;
            //validate and sanitize all data
            if(alphaNumericSpace($_POST["eventName-add"]) && alphaNumericSpace($_POST["venue-add"]) && dateYYYYMMDD($_POST["eventStartDate-add"])
             && dateYYYYMMDD($_POST["eventEndDate-add"]) && numeric($_POST["eventCapacity-add"])) {
                $name = sanitizeInputData($_POST["eventName-add"]);
                $venue = sanitizeInputData($_POST["venue-add"]);
                $start = sanitizeInputData($_POST["eventStartDate-add"]);
                $end = sanitizeInputData($_POST["eventEndDate-add"]);
                $cap = sanitizeInputData($_POST["eventCapacity-add"]);

            //add new event and assign the user as the manager for the event
            $event = Event::newEvent($name,$venue,$start,$end,$cap);
            $event->Post();
            /*If admin chooses event manager */
            if(isset($_POST["manager-add"]) && !empty($_POST["manager-add"]) && $event->getID() && numeric($_POST["manager-add"])) {
                $manager = sanitizeInputData($_POST["manager-add"]);
                $managerInsert = $event->addManager($manager);
            }
            else if($event->getID() != null){
                $managerInsert = $event->addManager($_SESSION["currentUser"]->getID());
            }
        }

            return $managerInsert;
        } else {
            return 0;//no rows insterted
        }
    }

    function updateEvent() {
        if(checkIfAllSet([$_POST["event-update"],$_POST["eventName-update"],$_POST["venue-update"],$_POST["eventStartDate-update"],$_POST["eventEndDate-update"],$_POST["eventCapacity-update"]])) {
            //validate and sanitize
            if(numeric($event = $_POST["event-update"]) && alphabeticSpace($_POST["eventName-update"]) && numeric($_POST["venue-update"]) &&
                dateYYYYMMDD($_POST["eventStartDate-update"]) && dateYYYYMMDD($_POST["eventEndDate-update"]) && numeric($_POST["eventCapacity-update"])) {
                $eventID = sanitizeInputData($_POST["event-update"]);
                $eventName = sanitizeInputData($_POST["eventName-update"]);
                $venue = sanitizeInputData($_POST["venue-update"]);
                $start = sanitizeInputData($_POST["eventStartDate-update"]);
                $end = sanitizeInputData($_POST["eventEndDate-update"]);
                $capacity = sanitizeInputData($_POST["eventCapacity-update"]);

                $event = Event::newEvent($eventName,$venue,$start,$end,$capacity,$eventID);
                $row = $event->Put();

                /*If admin chooses event manager */
                if(isset($_POST["manager-update"]) && !empty($_POST["manager-update"]) && numeric($_POST["manager-update"])) {
                    $manager = sanitizeInputData($_POST["manager-update"]);
                    $event->updateManager($manager);
                }
                return $row;
            }
        } else {
            return 0;
        }
    }

    function deleteEvent() {
        if(checkIfAllSet([$_POST["event-delete"]])) {
            if(numeric($_POST["event-delete"])) {
                $eventID = sanitizeInputData($_POST["event-delete"]);

                $rowsAffected = Event::deleteEvent($eventID);

                if($rowsAffected > 0) {
                    /*The event has been deleted, remove the event from all tables in the DB */
                    Event::deleteManagerEvent($eventID);//remove from event managers table
                    Event::deleteFromAttendeeEvent($eventID);//remove from attendee_event table
                    $sessionsToRemove = Session::getSessionsByEventID($eventID);
                    /*For all sessions being removed delete from attendee_session*/
                    foreach($sessionsToRemove as $session) {
                        Session::deleteSessionAttendee($session->getID());
                    }
                    //remove all sessions for that event
                    Event::deleteAllSessionsForEvent($eventID);

                }

                return $rowsAffected;
            }
        } else {
            return 0;
        }
    }

    function addEventUser() {
        if(checkIfAllSet([$_POST["selectedUser"], $_POST["event-user"]])) {
            if(numeric($_POST["selectedUser"]) && numeric($_POST["event-user"])) {
                $user = sanitizeInputData($_POST["selectedUser"]);
                $event = sanitizeInputData($_POST["event-user"]);

                $rowsAffected = (new Attendee)->registerEvent($event,$user);
            }
        }
    }

    function removeEventUser() {
        if(checkIfAllSet([$_POST["selectedUser"], $_POST["event-user"]])) {
            if(numeric($_POST["selectedUser"]) && numeric($_POST["event-user"])) {
                $user = sanitizeInputData($_POST["selectedUser"]);
                $event = sanitizeInputData($_POST["event-user"]);

                $rowsAffected = (new Attendee)->unregisterEvent($event,$user);
            }
        }
    }

    /*Session functions - add,update,delete, register, unregister users*/
    function addSession() {

    }

    function updateSession() {

    }

    function deleteSession() {

    }

    function addSessionUser() {

    }

    function removeSessionUser() {

    }


    /*Helper function to see if all inputs are set - iterates over array and makes sure values are set and not empty*/
    function checkIfAllSet($args) {
        $set = true;
        foreach($args as $input) {
            if(!(isset($input) && !empty($input))) {
                $set = false;
            }
        }

        return $set;
    }

