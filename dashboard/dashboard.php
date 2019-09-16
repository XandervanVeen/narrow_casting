<?php
require 'config.php';
session_start();
// check of de gebruiker is ingelogd anders verwijzen naar de login pagina
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
}
else {
    header("Location: login.php");
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
        <div class="dashboard-field">
            <div class="dashboard-field-1">
                <a href="logout.php">Uitloggen</a>
            </div>
            <div class="dashboard-field-2">
                <a href="../editInfo.php">Informatie aanpassen</a>
                <a href="editReminderRules.php">Regels en herrineringen aanpassen</a>
                <a href="calendar.php">Agenda</a>
            </div>
        </div>
    </div>
</body>
</html>

