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
        $encPW = hash("sha256", sanitizeInputData($_POST["password"]));
        
        $db = new LoginPDO();
        $userPW = $db->getLoginPassword(sanitizeInputData($_POST["name"]));
        if($encPW === $userPW) {
            date_default_timezone_set("US/Eastern");
            setcookie("loggedIn", date("F d, Y h:i a", time()), date(time() + 600), '/');
            $_SESSION["loggedIn"] = true;
            header("Location: Events.php");
        } else {
            var_dump($encPW);
            var_dump($userPW);
        }
    }
?>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <form id="sample" action="Login.php" method="post">
        Name: <input type="text" name="name">
        Password: <input type="text" name="password">
        <input type="submit" name="submit">
    </form>
</body>
</html>