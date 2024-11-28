<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['userEmail'])) {
    // If logged in, destroy the session and redirect to the login page
    session_destroy();
    header("Location: LoginPage.php");
    exit;
} else {
    // If not logged in, redirect to the login page
    header("Location: LoginPage.php");
    exit;
}
?>