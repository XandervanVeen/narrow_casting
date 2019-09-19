<?php
require'dashboard/config.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('location: index.php');
    exit;
}

if ($_POST['type'] == 'edit'){
    $sql = "UPDATE projectinfo SET title = :title, description = :description WHERE id = :id";

    $prepare =  $db->prepare($sql);
    $prepare->execute([

        'title' => $_POST['title'],

        'description' => $_POST['description'],

        ':id' => 1

    ]);
    header("location: dashboard/dashboard.php");
    exit;

}