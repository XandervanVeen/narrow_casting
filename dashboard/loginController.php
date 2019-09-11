<?php
// Makes sure we have all the data needed to connect to the data base
require 'config.php';

// This checks if the user came to this page using a post request so that user cannot just
// visit this website
if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
    header('Location: index.php');
    exit;
};

// This sets the email, username and password so we can check if they are empty or not
if (isset($_POST['username']) && !empty($_POST['username'])){
    $username = htmlentities(trim($_POST['username']));
}
else {
    echo "<script> alert ('Niks ingevuld bij gebruikersnaam'); {document.location.href='login.php'};</script>";
    exit;
}
if (isset($_POST['password']) && !empty($_POST['password'])){
    $password = htmlentities(trim($_POST['password']));
}
else {
    echo "<script> alert ('Niks ingevuld bij gebruikersnaam'); {document.location.href='login.php'};</script>";
    exit;
}

// The following retrieves all the emails from the database to check if they already exist
$stmt = $db->prepare('SELECT COUNT(username) AS EmailCount FROM users WHERE username = :username');
$stmt->execute(array('username' => $_POST['username']));
$resultpassword = $stmt->fetch(PDO::FETCH_ASSOC);

// The following runs if the post type is login
if ( $_POST['type'] === 'login' ) {

    //Retrieve the table row for the given username.
    $sql = "SELECT id, username, password FROM users WHERE username = :username";

    //Prepare the statement.
    $stmt = $db->prepare($sql);

    //Bind the username value.
    $stmt->bindValue(':username', $username);

    //Execute the statement.
    $stmt->execute();

    //Fetch the table row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //If we retrieved a relevant record.
    if($user !== false){
        //Compare the password attempt with the password we have stored.
        $validPassword = password_verify($password, $user['password']);
        if($validPassword){
            //All is good. Log the user in.

            // Start the session
            session_start();

            // Store data in session variables
            $_SESSION["loggedin"] = true;

            $sql = "SELECT * FROM users WHERE username = :username";
            $prepare = $db->prepare($sql);
            $prepare->execute([
                ':username' => $username
            ]);
            $user = $prepare->fetch(PDO::FETCH_ASSOC);
            $_SESSION["id"] = $user['id'];

            // Redirect user to welcome page
            header('Location: dashboard.php');
        }
        else {
            echo "<script> alert ('Kon niet inloggen (Wachtwoord incorrect)'); {document.location.href='login.php'};</script>";
            exit;
        }
    }
    else {
        echo "<script> alert ('Kon niet inloggen (Gebruikersnaam niet gevonden)'); {document.location.href='login.php'};</script>";
        exit;
    }
}
