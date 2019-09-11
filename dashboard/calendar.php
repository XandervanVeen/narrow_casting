<?php
require 'config.php';
$sql = "SELECT * FROM calendar";
$query = $db->query($sql);
$calendars = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/main.css">
    <title>Calendar</title>

</head>
<body>

<button><a href="addCalendar.php">Afspraak toevoegen</button>


<?php

foreach
($calendars as $calendar){
    $id = htmlentities($calendar['id']);
    $title = htmlentities($calendar['title']);
    $date = htmlentities($calendar['date']);
    echo "<div><a href='editCalendar.php?id={$id}' {$calendar['id']}'> {$title} {$date} </a></div>";

}
?>
<br>
<a href="dashboard.php">Ga terug</a>


</body>
</html>
