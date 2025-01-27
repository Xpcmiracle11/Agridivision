<?php
$servername = "localhost";
$username = "root";
$password = "";
$myData = "agridivision";
$conn = mysqli_connect($servername, $username, $password, $myData);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
