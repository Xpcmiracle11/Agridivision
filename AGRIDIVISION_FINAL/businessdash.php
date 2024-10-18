<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// Include the dashboard page after processing the form
include 'businessdash.html';