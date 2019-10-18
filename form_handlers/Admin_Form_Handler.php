<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Admin_Form_Handler
    */

    require_once "../utilities.inc.php";
    /*Start the session */
    session_name("events");
    session_start();

    /*Authentication and authorization checks*/
    if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] || !isset($_SESSION["currentUser"])) {
       echo header("Location: Login.php");
    }

    








?>