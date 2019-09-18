<?php
require 'config.php';
$sql = "SELECT * FROM calendar";
$query = $db->query($sql);
$calendars = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <title>AmoBord</title>
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
<body onload="startTime()">
<header>
    <a href="login.php" class="logo-shadow">
        <img src="../img/amo_logo.png">
    </a>
    <div class="weather-clock-shadow">
        <div class="date">
            <div class="title">
                <h2>- Datum -</h2>
            </div>
            <div class="date-text"><div id="date"></div></div>
        </div>
        <div class="weather">
            <div class="title">
                <h2>- Weer -</h2>
            </div>
            <div class="weather-info">
                <p>Breda</p>
                <p class="temp"></p>
                <img class="icon">
            </div>
        </div>
        <div class="clock">
            <div class="title">
                <h2>- Klok -</h2>
            </div>
            <div class="clock-text"><div id="clock"></div></div>
        </div>
    </div>
</header>
<main>
    <div class="full-content">
        <div class="full-info">
            <div class="title">
                <h2>Agenda</h2>
            </div>
            <div class="calendar-edit-overview">
                <a href="addCalendar.php" class="calendar-overview-add">Afspraak toevoegen</a>
                <table>
                    <?php
                    foreach
                    ($calendars as $calendar){
                        $id = htmlentities($calendar['id']);
                        $title = htmlentities($calendar['title']);
                        $date = htmlentities($calendar['date']);
                        echo "<tr>";
                        echo "<th><a href='editCalendar.php?id={$id}' {$calendar['id']}'>{$title}</a></th>";
                        echo "<th><a href='editCalendar.php?id={$id}' {$calendar['id']}'>{$date}</a></th>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</main>
</body>
<script>
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        m = checkTime(m);
        document.getElementById('clock').innerHTML =
            "<p>" + h + ":" + m + "</p>";
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
</script>
<script>
    $.getJSON("https://api.openweathermap.org/data/2.5/weather?q=Breda,nl&units=metric&APPID=67c140928453a2bdfc185fe267d98ccc", function(data){
            console.log(data);

            var icon = "https://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
            var temp1 = data.main.temp;
            var temp = Math.round(temp1);
            temp += '°';
            $('.icon').attr('src', icon);
            $('.temp').append(temp);
            var place = data.name;
        }
    );
</script>
<script>
    //    Date
    function startTime() {
        var today = new Date();
        var mo = today.getMonth() + 1 ;
        var d = today.getDate();
        var y = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        m = checkTime(m);
        document.getElementById('clock').innerHTML =
            "<p>" + h + ":" + m + "</p>";
        document.getElementById('date').innerHTML =
            "<p>" + d + "/" + mo + "/" + y + "</p>";
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
</script>
</html>
