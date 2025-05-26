<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, redirect to the login page
    header("Location: index_login.php");
    exit(); // Stop further script execution after redirect
}

// If logged in, display the protected content
echo "Welcome to the protected page! You are logged in as " . $_SESSION['username'];
?>
