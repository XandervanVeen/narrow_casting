<?php
require 'config.php';
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: dashboard.php");
}
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/main.css">

    <meta name="theme-color" content="#fafafa">

    <script src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

    <script src="script.js"></script>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-field">
            <div class="title">
                <h2>Login</h2>
            </div>
            <form action="loginController.php" method="post">
                <input type="hidden" name="type" value="login">
                <input class="t-type-text" type="text" id="username" name="username" required placeholder="Gebruikersnaam">
                <input class="b-type-text" type="password" id="password" name="password" required placeholder="Wachtwoord">
                <input class="type-submit" type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
