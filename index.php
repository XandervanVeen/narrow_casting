<?php
require 'dashboard/config.php';
$sql = "SELECT * FROM projectinfo WHERE id = :id ";
$prepare = $db->prepare($sql);//verzoek naar de database, voer sql van hierboven uit
$prepare->execute([
    ':id' => 1
]);
$projectinfo = $prepare->fetch(PDO::FETCH_ASSOC);//haalt op welke user bezig is met een team aanmaken.

$sql = "SELECT * FROM calendar ORDER BY date ASC LIMIT 4";
$query = $db->query($sql);
$calendars = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM rules";
$query = $db->query($sql);
$rules = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM reminders";
$query = $db->query($sql);
$reminders = $query->fetchAll(PDO::FETCH_ASSOC);
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

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">

  <meta name="theme-color" content="#fafafa">

    <script src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

    <script src="script.js"></script>
</head>

<body onload="startTime()">
      <header>
        <div class="logo-shadow">
          <img src="img/amo_logo.png">
        </div>
        <div class="weather-clock-shadow">
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
          <div class="content">
              <div class="content1">
                  <div class="reminder">
                      <div class="title">
                          <h2>- Herinneringen -</h2>
                      </div>
                      <p>
                          <?php
                          foreach ($reminders as $reminder){
                              $messageReminder = htmlentities($reminder['reminder']);
                              echo "{$messageReminder}<br>";
                          }
                          ?>
                      </p>
                  </div>
                  <a href="infocalendar.php" class="agenda">
                      <div class="title">
                          <h2>- Agenda -</h2>
                      </div>
                      <p>
                          <?php
                          $days = array(
                              "Maandag"   => "Monday",
                              "Dinsdag"   => "Tuesday",
                              "Woensdag"  => "Wednesday",
                              "Donderdag" => "Thursday",
                              "Vrijdag"   => "Friday",
                              "Zaterdag"  => "Saturday",
                              "Zondag"    => "Sunday"
                          );
                          for ($i = 0; $i < 4; $i++){
                              if (!empty($calendars[$i])) {
                                  $dayOfWeek = date("l", strtotime($calendars[$i]['date']));
                                  foreach ($days as $key => $val) {
                                      if ($val == $dayOfWeek) {
                                          $dayString = $key;
                                      }
                                  }
                                  $dayString = substr($dayString, 0, 2);
                                  echo $dayString . " - " . $calendars[$i]['date']. " - " . $calendars[$i]['title'] . "<br>";
                              }
                          }
                          ?>
                      </p>
                  </a>
                  <div class="rules">
                      <div class="title">
                          <h2>- Regels -</h2>
                      </div>
                      <p>
                          <?php
                          foreach ($rules as $rule){
                              $messageRules = htmlentities($rule['rules']);
                              echo "{$messageRules}<br>";
                          }
                          ?>
                      </p>
                  </div>
              </div>
              <div class="content2">
                  <div class="reistijden">
                      <div class="title">
                          <h2>- Reistijden -</h2>
                      </div>
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
                      function sortFunction( $a, $b ) {
                          return strtotime($a["ExpectedArrivalTime"]) - strtotime($b["ExpectedArrivalTime"]);
                      }
                      usort($newData['Passes'], "sortFunction");
                      $i = 0;
                      foreach ($newData['Passes'] as $key => $value) {
                          if ($i < 3) {
                              $passes[] = $value;
                          }
                          if (!empty($value)) {
                              $i++;
                          }
                      }
                      foreach ($passes as $pass) {
                          echo $pass['LinePublicNumber'] . " - " . substr($pass['ExpectedArrivalTime'],11, 5);
                          echo "<br>";
                      }
                      $timezone = date_default_timezone_get();
                      date_default_timezone_set($timezone);
                      $dateH = date('h', time());
                      $dateM = date('i', time());
                      $dateS = date('i', time());
                      ?>
                  </div>
                  <div class="news">
                      <div class="title">
                          <h2>- Nieuws -</h2>
                      </div>
                      <div class="articles">
                          <?php
                          $json = file_get_contents('https://newsapi.org/v2/top-headlines?country=nl&apiKey=1b5ffc1eac5a417fa9974cb1a606cf51');
                          $obj = json_decode($json);
                          $data = json_decode(json_encode($obj), TRUE);
                          $totalArticles = count($data['articles']);
                          for ($i = 0; $i < 3; $i++){
                              echo "<div class='news-article'>";
                              echo "<h3>{$data['articles'][$i]['title']}</h3>";
                              if ($data['articles'][$i]['urlToImage'] == ""){
                                  echo "<img src='img/news-placeholder.png'>";
                              }
                              else {
                                  echo "<img src='{$data['articles'][$i]['urlToImage']}'>";
                              }
                              echo "</div>";
                          }
                          ?>
                      </div>
                  </div>
              </div>
              <div class="content3">
                  <a href="info.php" class="project-info">
                      <div class="title">
                          <h2><?php echo "- " . $projectinfo['title'] . " -" ?></h2>
                      </div>
                      <textarea disabled class="full-content-text" rows="22"><?php echo $projectinfo['description'] ?></textarea>
                  </a>
                  <div class="whiteboard">
                      <div class="title">
                          <h2>- Whiteboard -</h2>
                      </div>
                      <div class="whiteboard-content">
                          <iframe src="whiteboardOverview.php" class="whiteboard-iframe" style="width: 98%;margin: 1% 1% 0 1%;height: 80%;overflow: auto;border: none;"></iframe>
                      </div>
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

    setInterval(function(){
    location.reload();
    },60000);
</script>
</html>
