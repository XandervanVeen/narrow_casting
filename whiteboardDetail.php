<?php
$id = $_GET['id'];
$json = file_get_contents('https://whiteboard.amo.rocks/api/boards/' . $id . '?key=W7W6Mkbb');
$obj = json_decode($json);
$detailData = json_decode(json_encode($obj), TRUE);
$users = $detailData[0]['users'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/whiteboard.css">
    <title>whiteboardOverview</title>
</head>
<table class="whiteboard-detail">
    <tr>
        <?php
        echo "<th>{$detailData[0]['name']}</th>";
        echo "<th><a href='whiteboardOverview.php'>Ga terug</a></th>";
        ?>
    </tr>
    <?php
    for ($x = 0; $x < count($users); $x++) {
        echo "<tr><td> - " . $users[$x]['name'] . "</td><td style='width: 20%; text-align: right;'>" . substr($users[$x]['pivot']['created_at'], 11, 5) . "</td></tr>";
    }
    $users[] = [];
    ?>
</table>
</html>