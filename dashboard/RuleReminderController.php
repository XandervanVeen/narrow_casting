<?php

require 'config.php';

if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
    header('Location: index.php');
    exit;
};

if ($_POST['type'] == 'edit') {
    $id = $_GET['id'];
   if($_POST["rules"] == 1) {
        $sql = "UPDATE rules SET rules = :rules WHERE id = :id";

        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':rules' => $_POST['rule1'],
            ':id' => 1
        ]);
       $sql = "UPDATE rules SET rules = :rules WHERE id = :id";

       $prepare = $db->prepare($sql);
       $prepare->execute([
           ':rules' => $_POST['rule2'],
           ':id' => 2
       ]);
       $sql = "UPDATE rules SET rules = :rules WHERE id = :id";

       $prepare = $db->prepare($sql);
       $prepare->execute([
           ':rules' => $_POST['rule3'],
           ':id' => 3
       ]);
    }
    else
    {
        $sql = "UPDATE reminders SET reminder = :reminder WHERE id = :id";

        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':reminder' => $_POST['reminder1'],
            ':id' => 1
        ]);
        $sql = "UPDATE reminders SET reminder = :reminder WHERE id = :id";

        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':reminder' => $_POST['reminder2'],
            ':id' => 2
        ]);
        $sql = "UPDATE reminders SET reminder = :reminder WHERE id = :id";

        $prepare = $db->prepare($sql);
        $prepare->execute([
            ':reminder' => $_POST['reminder3'],
            ':id' => 3
        ]);

    }
    header("location: editReminderRules.php");
    exit;
}

