<?php
    /*
        Brennan Jackson
        Project 1
        ISTE-341
        October 2019
        Login
    */

    session_name("events");
    session_start();

    require_once "./classes/Header.class.php";
    require_once "./classes/Footer.class.php";
    if(isset($_GET["logout"]) && $_GET["logout"]){
        session_unset();
        session_destroy();
    }

    if(isset($_POST["name"]) && isset($_POST['password'])) {
        require_once "utilities.inc.php";
        
        
        $db = new LoginPDO();
        $isAuthenticatedUser = $db->authenticateLogin(sanitizeInputData($_POST["name"]), $_POST["password"] );
        if($isAuthenticatedUser["authenticated"]) {
            date_default_timezone_set("US/Eastern");
            setcookie("logInTime", date("F d, Y h:i a", time()), date(time() + 600), '/');
            $_SESSION["loggedIn"] = true;
            $attendeeDB = new AttendeePDO();
            $_SESSION["currentUser"] = $attendeeDB->getCurrentUser($isAuthenticatedUser["userID"]);
            header("Location: Events.php");
        } else {
            echo "<span>Invalid login</span>";
        }
    } else if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        echo "You are still logged in!";
    }

    Header::buildHeader("Login", true, false, false, true);
    echo '<div class="container text-center">
        <h1>Event Registration System</h1>
        <h2>Login:</h2>
        <form id="login" class="form-signin" action="Login.php" method="post">
            <input type="text" class="form-control" placeholder="Name" name="name" required="" autofocus="">
            <input type="password"class="form-control" name="password" placeholder="Password" required="" autofocus="">
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Login">
        </form></div>';
    Footer::buildFooter();
?>
    
