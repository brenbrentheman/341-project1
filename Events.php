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

    if(!isset($_SESSION["loggedIn"])) {
        header("Location: Login.php");
    }
?>