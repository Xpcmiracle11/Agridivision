<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['brgy_tech_id'])) {
    header('Location: login.php');
    exit();
}

// If the user is logged in, include the dashboard page
include 'techtable.html';
