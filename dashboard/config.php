<?php

$dbHost = 'localhost';
$dbUser = 'amo';
$dbPass = 'GYoT62P47e7v6O0a!';
$dbName = 'narrow_casting';

$db = new PDO(
    "mysql:host=$dbHost;dbname=$dbName",
    $dbUser,
    $dbPass
);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);