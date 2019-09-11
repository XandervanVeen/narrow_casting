<?php
// Start the session
session_start();

// Reset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to index page
header("location: login.php");
exit;
?>