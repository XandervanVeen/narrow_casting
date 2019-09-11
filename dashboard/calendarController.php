<?php

require 'config.php';

if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
    header('Location: index.php');
    exit;
};

if ($_POST['type'] == 'add-calendar-item') {
    $title = $_POST['title'];
    $date = $_POST['item-date'];


    $sql = "INSERT INTO calendar ( title, date )
VALUES ( :title, :date )";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':title'    => $title,
        ':date'     => $date
    ]);

    header('Location: calendar.php');
    exit;
}


if ($_POST['type'] == 'edit-calendar-item') {
    $id = $_POST['itemId'];
    echo $id;
    $sql = "UPDATE calendar SET title = :title, date = :date WHERE id = :id";
    echo $sql;

    $prepare =  $db->prepare($sql);
    $prepare->execute([
        'title' => $_POST['title'],
        'date' => $_POST['item-date'],
        'id' => $_POST['itemId']
    ]);
    header("location: calendar.php");
    exit;
}



if($_POST['type'] == 'delete-calendar-item') {
    $id = $_POST['calendarId'];
    $sql = "DELETE FROM calendar WHERE id= :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $id
    ]);
    header('location: calendar.php');
    exit;
}



?>