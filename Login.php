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
            echo "invalid login.";
        }
    } else if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        echo "You are still logged in!";
    }
?>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <form id="login" action="Login.php" method="post">
        Name: <input type="text" name="name">
        Password: <input type="text" name="password">
        <input type="submit" name="submit">
    </form>
</body>
</html>