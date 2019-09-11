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
<div class="whiteboard-overview">
    <?php
    $json = file_get_contents('https://whiteboard.amo.rocks/api/boards?key=W7W6Mkbb');
    $obj = json_decode($json);
    $data = json_decode(json_encode($obj), TRUE);
    for ($i = 0; $i < count($data); $i++) {
        $json = file_get_contents('https://whiteboard.amo.rocks/api/boards/' . $data[$i]['id'] . '?key=W7W6Mkbb');
        $obj = json_decode($json);
        $detailData = json_decode(json_encode($obj), TRUE);
        echo "<a href='whiteboardDetail.php?id={$detailData[0]['id']}'>{$detailData[0]['name']}</a>";
    }
    ?>
</div>
</html>