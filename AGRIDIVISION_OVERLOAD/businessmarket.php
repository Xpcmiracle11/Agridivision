<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['business_id'])) {
    header('Location: login.php');
    exit();
}

include 'businessmarket.html';

$business_id = $_SESSION['business_id'];
$business_fname = $_SESSION['business_fname'];
$business_mname = $_SESSION['business_mname'];
$business_lname = $_SESSION['business_lname'];
$business_latitude = $_SESSION['latitude'];
$business_longitude = $_SESSION['longitude'];

if (isset($_POST['market_id'])) {
    $market_id = trim($_POST['market_id']);
    $status = "Pending";
    $commodity_name = trim($_POST['commodity_name']);
    $commodity_id = trim($_POST['commodity_id']);
    $farmer_id = trim($_POST['farmer_id']);
    $farmer_fname = trim($_POST['farmer_fname']);
    $farmer_lname = trim($_POST['farmer_lname']);
    $farmer_province = trim($_POST['farmer_province']);
    $farmer_municipality = trim($_POST['farmer_municipality']);
    $farmer_barangay = trim($_POST['farmer_barangay']);
    $commodity_quantity = trim($_POST['commodity_quantity']);
    $commodity_price = trim($_POST['commodity_price']);
    $description = trim($_POST['description']);
    $amount_purchase = trim($_POST['amount_purchase']);
    $spent_amount = $commodity_price * $amount_purchase;
    $date = date('Y-m-d');

    $sql = "INSERT INTO transaction (market_id, status, commodity_id, commodity_name, farmer_id, farmer_fname, farmer_lname, farmer_province, farmer_municipality, farmer_barangay, commodity_quantity, commodity_price, description, business_id, business_fname, business_lname, business_latitude, business_longitude, amount_purchase, spent_amount, date) 
    VALUES ('$market_id', '$status', '$commodity_id', '$commodity_name', '$farmer_id', '$farmer_fname', '$farmer_lname', '$farmer_province', '$farmer_municipality', '$farmer_barangay', '$commodity_quantity', '$commodity_price', '$description', '$business_id', '$business_fname', '$business_lname', '$business_latitude', '$business_longitude', '$amount_purchase', '$spent_amount', '$date')";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $transaction_id = "TR" . $last_id;

        $updateSql = "UPDATE transaction SET transaction_id='$transaction_id' WHERE id=$last_id";
        mysqli_query($conn, $updateSql);
        
        // Update market table with new quantity
        $updateMarketSql = "UPDATE market SET commodity_quantity = commodity_quantity - $amount_purchase WHERE market_id = '$market_id'";
        
        if (mysqli_query($conn, $updateMarketSql)) {
            echo '<script>location.replace("businessmarket.php");</script>';
        } else {
            echo "Error updating market table: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting into transaction table: " . mysqli_error($conn);
    }
}
?>
