<?php

$dbHost = 'localhost';
$dbUser = 'amo';
$dbPass = 'amo';
$dbName = 'narrow_casting';

$db = new PDO(
    "mysql:host=$dbHost;dbname=$dbName",
    $dbUser,
    $dbPass
);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);