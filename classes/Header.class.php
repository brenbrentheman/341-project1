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
            $header = "<!DOCTYPE html>
                <html lang='en'>
                    <head>
                        <meta charset='utf-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                        <title>$title</title>
                        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>";
            if($includeJQuery)
                $header .= "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>";
            $header .= "</head>
                <body><div class='container-fluid'>";
            
            echo $header;
        }
    }

?>