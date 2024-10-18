<?php
$servername = "localhost";
$username = "root";
$password = "";
$myData = "agri_division";
$conn = mysqli_connect($servername, $username, $password, $myData);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
