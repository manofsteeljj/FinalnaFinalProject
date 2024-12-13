<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Example: Check login status
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: /JJF/public/index.php'); // Correct redirection to the public directory

    exit;
}   
