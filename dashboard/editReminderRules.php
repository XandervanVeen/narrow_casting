<?php
require 'config.php';
session_start();
// check of de gebruiker is ingelogd anders verwijzen naar de login pagina
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
}
else {
    header("Location: login.php");
}
$sql = "SELECT * FROM reminders";
$query = $db->query($sql);
$reminders = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM rules";
$query = $db->query($sql);
$rules = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Reminder and Rules</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <header>
        <div class="logo-shadow">
            <img src="../img/amo_logo.png">
        </div>
    </header>
    <main>
        <div class="content">
            <div class="leftPage">
                <h1>Pas een regel aan</h1>
                <form action="RuleReminderController.php?id=<?= $rules[0]['id']?>" method="post">
                    <input type="hidden" name="type" value="edit">
                    <input type="hidden" name="rules" value="1">
                    <input type="text" id="rule" name="rule1" value="<?php echo $rules[0]['rules']?>">
                    <input type="text" id="rule" name="rule2" value="<?php echo $rules[1]['rules']?>">
                    <input type="text" id="rule" name="rule3" value="<?php echo $rules[2]['rules']?>">
                    <input type="submit" value="Submit">
                </form>
                <br>
                <h1>Pas een herrinering aan</h1>
                <form name="reminders" action="RuleReminderController.php?id=<?= $reminders[0]['id']?>" method="post">
                    <input type="hidden" name="rules" value="0">
                    <input type="hidden" name="type" value="edit">
                    <input type="text" id="reminder" name="reminder1" value="<?php echo $reminders[0]['reminder'] ?>">
                    <input type="text" id="reminder" name="reminder2" value="<?php echo $reminders[1]['reminder'] ?>">
                    <input type="text" id="reminder" name="reminder3" value="<?php echo $reminders[2]['reminder'] ?>">
                    <input type="submit" value="Submit">
                </form>
                <br>
            </div>
        </div>
    </main>
</body>
</html>