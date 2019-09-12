<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/travel.css">

    <title>Document</title>

</head>
<body>
<?php
$json = file_get_contents('http://v0.ovapi.nl/stopareacode/BdOud');
$obj = json_decode($json);
$data = json_decode(json_encode($obj), JSON_FORCE_OBJECT);
$newData;
$passes;
foreach($data['BdOud'] as $key => $value) {
    if ($key === 72000640) {
        $newData = $value;
        break;
    }
}
function sortFunction1( $a, $b ) {
    return strtotime($a["ExpectedArrivalTime"]) - strtotime($b["ExpectedArrivalTime"]);
}
usort($newData['Passes'], "sortFunction1");
$i = 0;
echo "<div class='busses'>";
foreach ($newData['Passes'] as $key => $value) {
    if ($i < $newData) {
        $passes[] = $value;
    }
    if (!empty($value)) {
        $i++;
    }
}
foreach ($passes as $pass) {
    echo "<div class='travelText'>";
    echo "<p>" . $pass['LinePublicNumber'] . "</p>";
    echo "<p>" . substr($pass['ExpectedArrivalTime'],11, 5) . "</p>";
    echo "</div>";

}
$timezone = date_default_timezone_get();
date_default_timezone_set($timezone);
$dateH = date('h', time());
$dateM = date('i', time());
$dateS = date('i', time());
echo "</div>";
$data = [];
$newData = [];
$passes = [];
?>
</body>
</html>
