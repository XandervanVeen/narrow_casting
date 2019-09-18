<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/news.css">
    <title>Info</title>
</head>
<body>
<?php
$json = file_get_contents('https://newsapi.org/v2/top-headlines?country=nl&apiKey=1b5ffc1eac5a417fa9974cb1a606cf51');
$obj = json_decode($json);
$data = json_decode(json_encode($obj), TRUE);
//echo "<h1>Status: {$data['status']}</h1>";
//echo "<h3>Total Results: {$data['totalResults']}</h3>";
$totalArticles = count($data['articles']);
for ($i = 0; $i < $totalArticles; $i++){
    echo "<div class='newsContent'>";
        echo "<div class='newsText'>";
            echo "<h3>{$data['articles'][$i]['title']}</h3>";
            echo "<p>{$data['articles'][$i]['content']}</p>";
        echo "</div>";
        echo "<div class='newsImg'>";
            if ($data['articles'][$i]['urlToImage'] == ""){
                echo "<img style='width: 150px; height: 120px; padding: 10% 0% 10% 0%;' src='img/news-placeholder.png'>";
            }
            else {
                echo "<a href='{$data['articles'][$i]['url']}'><img style='padding: 0% 10% 0% 10%;' src='{$data['articles'][$i]['urlToImage']}'></img></a>";
            }
        echo "</div>";
    echo "</div>";
}
?>
</body>
</html>