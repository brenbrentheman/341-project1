<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Header
    */
    class Header {
        public static function buildHeader($title, $includeJQuery) {
            echo "<!DOCTYPE html>
                <html lang='en'>
                    <head>
                        <meta charset='utf-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                        <title>$title</title>
                        <!--<link rel='stylesheet' href='./css/style.css' />-->";
            if($includeJQuery)
                echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>";
            echo "</head>
                <body>";
        }
    }

?>