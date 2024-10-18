<?php
session_start();
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$businessid = $_SESSION['user_id']; // Assuming 'user_id' contains the business ID
$business_fname = $_SESSION['fname'];
$business_lname = $_SESSION['lname'];
$business_prov = $_SESSION['prov'];
$business_mun = $_SESSION['mun'];
$business_brgy = $_SESSION['brgy'];
$business_street = $_SESSION['street'];
$business_zip = $_SESSION['zip'];
$business_longitude = $_SESSION['longitude'];
$business_latitude = $_SESSION['latitude'];

if (isset($_POST['amount'])) {
    $farmer_id = $_POST['farmer_id'];
    $farmer_fname = $_POST['farmer_fname'];
    $farmer_lname = $_POST['farmer_lname'];
    $farmer_prov = $_POST['farmer_prov'];
    $farmer_mun = $_POST['farmer_mun'];
    $farmer_brgy = $_POST['farmer_brgy'];
    $farmer_street = $_POST['farmer_street'];
    $farmer_zip = $_POST['farmer_zip'];
    $farmer_longitude = $_POST['farmer_longitude'];
    $farmer_latitude = $_POST['farmer_latitude'];
    $crop = $_POST['crop'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $amount_buy = $_POST['amount_buy'];
    $date = date('Y-m-d');

    // Sanitize and validate input data
    $farmer_id = mysqli_real_escape_string($conn, trim($farmer_id));
    $amount = mysqli_real_escape_string($conn, trim($amount));
    $price = mysqli_real_escape_string($conn, trim($price));
    $amount_buy = mysqli_real_escape_string($conn, trim($amount_buy));

    // Insert data into the pending_transaction table
    $sql = "INSERT INTO pending_transaction (farmer_id, business_id, farmer_fname, farmer_lname, farmer_prov, farmer_mun, farmer_brgy, farmer_street, farmer_zip, farmer_longitude, farmer_latitude, business_fname, business_lname, business_prov, business_mun, business_brgy, business_street, business_zip, business_longitude, business_latitude, crop, amount, price, amount_buy, date) 
            VALUES ('$farmer_id', '$businessid', '$farmer_fname', '$farmer_lname', '$farmer_prov', '$farmer_mun', '$farmer_brgy', '$farmer_street', '$farmer_zip', '$farmer_longitude', '$farmer_latitude', '$business_fname', '$business_lname', '$business_prov', '$business_mun', '$business_brgy', '$business_street', '$business_zip', '$business_longitude', '$business_latitude', '$crop', '$amount', '$price', '$amount_buy', '$date')";

    if (mysqli_query($conn, $sql)) {
        // Successfully inserted into pending_transaction
        echo '<script>location.replace("businessmarket.php");</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
include 'businessmarket.html';
?>
