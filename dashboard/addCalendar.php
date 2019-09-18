<?php
require 'config.php';
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
        <div class="title">
            <h2>Maak een afspraak aan</h2>
        </div>
        <form class="add-calendar-item" action="calendarController.php" method="post">
            <input type="hidden" name="type" value="add-calendar-item">
            <input class="t-calendar-input" type="text" name="title" id="title" required placeholder="Titel">
            <input class="b-calendar-input" type="date" id="item-date" name="item-date" value="DD/MM/YYYY" class="date" />
            <input class="calendar-submit" type="submit" value="Voeg afspraak toe">
            <a class="calendar-go-back" href="calendar.php">Ga terug</a>
        </form>
    </div>
</div>
</body>
</html>