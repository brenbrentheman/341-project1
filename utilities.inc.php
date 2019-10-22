<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Utilites - utility functions we can use to sanitize data or validate input
        --  This is not a class as we should not need to save the state 
            of any of the values returned from these functioons. --
    */

    function __autoload($className) {
        require_once "./classes/$className.class.php";
    }

    function sanitizeInputData($input) {
        $input = trim($input);
		$input = stripslashes($input);
		$input = htmlentities($input);
		$input = strip_tags($input);
		return $input;
    }

    function alphabetic($value) {
        $reg = "/^[A-Za-z]+$/";
        return preg_match($reg,$value);
    }

    function alphabeticSpace($value) {
        $reg = "/^[A-Za-z ]+$/";
        return preg_match($reg,$value);
    }

    function alphaNumeric($value) {
        $reg= "/^[A-Za-z0-9]+$/";
        return preg_match($reg,$value);
    }

    function alphaNumericSpace($value) {
        $reg = "/^[A-Za-z0-9 ]+$/";
        return preg_match($reg,$value);
    }

    function numeric($value) {
        $reg = "/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/";
        return preg_match($reg,$value);
    }

    /*Dates are submitted as yyyy-mm-ddd - we check for numbers and dashes */
    function dateYYYYMMDD($value) {
        $reg = "/^[0-9 -]+$/";
        return( preg_match($reg,$value));
    }