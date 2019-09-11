<?php
require 'config.php';
?>

<link rel="stylesheet" href="../css/main.css">
<div>
    <h1>Maak een afspraak aan</h1>
    <form class="add-calendar-item" action="calendarController.php" method="post">
        <input type="hidden" name="type" value="add-calendar-item">
        <div>
            <input class="title-input" type="text" name="title" id="title" required placeholder="Titel">
        </div>

        <br>
        <input class="time-input" type="date" id="item-date" name="item-date"
               value="DD/MM/YYYY" class="date" />
        <div class="add-calandar-item">

            <br>

            <input type="submit" value="Voeg afspraak toe">
        </div>
    </form>
    <a href="calendar.php">Ga terug</a>
</div>




