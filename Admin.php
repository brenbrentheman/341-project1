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
    <h2>Hi {$displayName}, you can view and manage users, events, and sessions below!</h2><br />";
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
        
        /*Get event managers*/
        $eventManagers = Event::getAllEventManagers();

    }


    /*For event managers*/
    if(USER_ROLE == 2) {
        //get all events, sessions, and users managed by this user
        $events = $_SESSION["currentUser"]->getManagedEvents();//get events managed by this user -- Returns an associative array
        $sessions = array();//to be filled with users managed sessions
        $users = Attendee::getAllUsers();
        $managedUsers = array();
        /*Load up the sessions and manage users arrays*/
        foreach($events as $event) {
            $sessions[] = Session::getSessionsByEventID($event->getID());
            $managedUsers  = Event::getAllAttendeesForEvent($event->getID());
        } 
    }

    /*Basic setup for either role*/
    $roleTitle = USER_ROLE == 2 ? "Event Manager" : "Admin";
    echo "<h2>Admin Panel</h2>
        <h3>Your role: $roleTitle</h3><br />";

    /*ATTENDEES - build up users*/
    $userSelect = "<select class='userSelect' name='selectedUser'><option value ='' selected='selected' disabled>Select an Attendee...</option>";
    foreach($users as $user) {
        $userSelect .= "<option value='{$user->getID()}'>{$user->getName()}</option>";
    }
    $userSelect .= "</select>";

    /*Get all venues*/
    $venues = Venue::getAllVenues();
    $venueSelect = "<select class ='venueSelect' name='venue'><option value ='' selected='selected' disabled>Select a Venue...</option>"; 
    foreach($venues as $venue) {
        $venueSelect .= "<option value='{$venue->getID()}'>{$venue->getName()}</option>";
    } 
    $venueSelect .= "</select>";


    /*EVENTS*/

    echo "<h3>Events:</h3>";
    $eventsTable = "<table id='events-table' class='table'><thead><tr>
        <td>Event ID</td>
        <td>Name</td>
        <td>Venue</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Capacity</td>
        </tr></thead><tbody>";
    foreach($events as $event) {
        $eventsTable .= $event->getAsTableRow();
    }
    $eventsTable .= "</tbody></table>";
    echo $eventsTable;
    
    //add
    $addEventFields = buildEventInputFields("add");
    echo "<h4>Add a new event:</h4>";
    echo "<div class='eventAdd'>$addEventFields</div><br /><button id='add-event'>Add Event</button><br />";

    //update
    $updateEventFields = buildEventInputFields("update");
    $updateEventSelect = buildEventSelect("update");
    echo "<h4>Update an event:</h4>";
    echo "<label>Select an event below and edit the fields to update it: </label>$updateEventSelect";
    echo "<br /> <div class='eventUpdate'>$updateEventFields</div><br /><button id='update-event'>Update Event</button><br />";

    //delete    
    $deleteEventSelect = buildEventSelect("delete");
    echo "<h4>Delete an event:</h4>";
    echo "<br />" . $deleteEventSelect . "<br /><button id='delete-event'>Delete Event</button><br />";
    
    //event attendees
    $userEventSelect = buildEventSelect("user");
    echo "<h4>Update attendees for an event:</h4>";
    echo "<br />" . $userSelect . $userEventSelect . "<br /><button id='add-event-user'>Register</button>" . "<button id='remove-event-user'>Unregister</button><br />";
    

    echo "<br /><hr /><br />";//break up each section
    
    
    
    
    /*SESSIONS*/
    echo "<h3>Sessions:</h3>";
    $sessionsTable = "<table id='sessions-table' class='table'><thead><tr>
        <td>Session ID</td>
        <td>Name</td>
        <td>Event</td>
        <td>Start Date</td>
        <td>End Date</td>
        <td>Capacity</td>
        </tr></thead><tbody>";
    if(!empty($sessions)) {
        foreach($sessions as $eventSession) {
            foreach($eventSession as $session) {
                $sessionsTable .= $session->getSessionAsRow();
            }
        }
    }
    $sessionsTable .= "</tbody></table>";
    echo $sessionsTable;
    
    //add
    $addsessionFields = buildsessionInputFields("add");
    echo "<h4>Add a new session:</h4>";
    echo "<div class='sessionAdd'>$addsessionFields</div><br /><button id='add-session'>Add session</button><br />";

    //update
    $updateSessionFields = buildSessionInputFields("update");
    $updateSessionSelect = buildSessionSelect("update");
    echo "<h4>Update an session:</h4>";
    echo "<label>Select an session below and edit the fields to update it: </label>$updateSessionSelect";
    echo "<br /> <div class='sessionUpdate'>$updateSessionFields</div><br /><button id='update-session'>Update session</button><br />";

    //delete
    $deleteSessionSelect = buildSessionSelect("delete");
    echo "<h4>Delete a session:</h4>";
    echo "<br />" . $deleteSessionSelect . "<br /><button id='delete-session'>Delete Session</button><br />";
    
    //add attendees
    $userSessionSelect = buildSessionSelect("user");
    echo "<h4>Add attendees to a session:</h4>";
    echo $userSessionSelect . $userSelect . "<br /><button id='add-session-user'>Register</button>" . "<button id='remove-session-user'>Unregister</button><br />";

    echo "<br /><hr /><br />";


    /*Helper Functions*/
    function buildEventInputFields($type) {
        global $venueSelect;
        $fields = "<label for='eventName-$type' >Name: </label><input id='eventName-$type' name='eventName-$type' type='text'>
        <label >Venue: </label>$venueSelect
        <label for='eventStartDate-$type' >Start Date:</label><input id='eventStartDate-$type' name='eventStartDate-$type' type='date'>
        <label for='eventEndDate-$type'>End Date:</label><input id='eventEndDate-$type' name='eventEndDate-$type' type='date'>
        <label for='eventCapacity-$type'>Capacity:</label><input id='eventCapacity-$type' name='eventCapacity-$type' type='number' min='1'>";

        if(USER_ROLE == 1){
            $fields .= "<label>Choose an event manager</label>";//FINISH THIS
        }

        return $fields;
    }

    function buildSessionInputFields($type) {
        global $venueSelect;
        return "<label for='sessionName-$type' >Name: </label><input id='sessionName-$type' name='sessionName-$type' type='text'>
        <label >Event: </label>" . buildEventSelect("session") .
        "<label for='sessionStartDate-$type' >Start Date:</label><input id='sessionStartDate-$type' name='sessionStartDate-$type' type='date'>
        <label for='sessionEndDate-$type'>End Date:</label><input id='sessionEndDate-$type' name='sessionEndDate-$type' type='date'>
        <label for='sessionCapacity-$type'>Capacity:</label><input id='sessionCapacity-$type' name='sessionCapacity-$type' type='number' min='1'>";
    }

    function buildEventSelect($type) {
        global $events;
        $eventsSelect = "<select id='eventSelect-$type' class ='eventSelect' name='event'><option value ='' selected='selected' disabled>Select an Event...</option>";    
        foreach($events as $event) {
            $eventsSelect .= "<option value='{$event->getID()}'>{$event->getName()}</option>";
        
        }
        $eventsSelect .= "</select>";
        return $eventsSelect;

    }

    function buildSessionSelect($type) {
        global $sessions;
        $sessionSelect = "<select class='sessionSelect' name='session-$type'><option value ='' selected='selected' disabled>Select a Session...</option>";
        if(!empty($sessions)) {
            foreach($sessions as $eventSession) {
                foreach($eventSession as $session) {
                    $sessionSelect .= "<option value='{$session->getID()}' data-eventForSession='{$session->getEvent()}'>{$session->getName()}</option>";
                }
            }
        }
        $sessionSelect .= "</select>";
        return $sessionSelect;
    }

    /*Lastly the footer */
    Footer::buildFooter();
?>