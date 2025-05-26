<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin'])) {
    header("Location: index_login.php"); // Redirect to login if not logged in
    exit();
}
?>