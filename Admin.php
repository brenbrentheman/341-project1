<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Admin
    */
    session_name("events");
    session_start();
    /*Authentication and authorization checks*/
    if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"] || !isset($_SESSION["currentUser"])) {
        header("Location: Login.php");
    }
     /*Get the authorization level*/
     define("USER_ROLE", $_SESSION["currentUser"]["role"]);
?>