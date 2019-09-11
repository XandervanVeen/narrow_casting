<?php
require 'config.php';
if (empty($_GET['id'])) {
    Header("Location: dashboard.php");
    exit;
}
else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM calendar WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
            ':id' => $id
    ]);
    $calendarItem = $prepare->fetch(PDO::FETCH_ASSOC);
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
        <div>
            <h1>Wijzig een afspraak</h1>
            <form class="edit-calendar-item" action="calendarController.php" method="post">
                <input type="hidden" name="type" value="edit-calendar-item">

                <input type="text" name="title" id="title" required value="<?php echo $calendarItem['title']?>">
                <input type="date" id="item-date" name="item-date" value="<?php echo $calendarItem['date']?>" class="date">
                <input type="hidden" name="itemId" id="itemId" value="<?php echo $calendarItem['id']?>">

                <input type="submit" value="Wijzig">
            </form>

            <form class="delete-calendar-item" action="calendarController.php" method="post">
                <input type="hidden" name="type" value="delete-calendar-item">
                <input type="hidden" name="calendarId" value="<?php echo $calendarItem['id']?>">
                <input type="submit" value="Verwijder">
            </form>
        </div>

                <a href="calendar.php">Ga terug</a>
        </div>
    </div>
</div>
</body>
</html>


