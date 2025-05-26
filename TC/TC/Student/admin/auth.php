<?php
// Start output buffering
ob_start();
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header('Location: index_login.php');
    exit;
}
echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";

?>
