<?php 
    /*Handles DB interactions for the login page*/

    require "PDODB.class.php";

    class LoginPDO extends PDODB {

        function getLoginPassword($name) {
            try {
                $stmt = $this->dbh->prepare("SELECT password FROM attendee WHERE name = :name");
                $stmt->execute(array("name"=>strtolower($name)));
                
                while($row = $stmt->fetch()) {
                    $pw = $row[0];//should only receive one password in return
                }
                return $pw;

            } catch(PDOException $ex) {
                echo $ex;
                die("There was a problem");
            }
        }
    }