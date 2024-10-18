<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// If the user is logged in, include the dashboard page
include 'admindash.html';

if (isset($_POST['commodity_name'])) {
    $commodity_name = $_POST['commodity_name'];
    $commodity_variant = $_POST['commodity_variant'];
    $commodity_price = $_POST['commodity_price'];

    $commodity_name = mysqli_real_escape_string($conn, trim(ucwords(strtolower($commodity_name))));
    $commodity_variant = mysqli_real_escape_string($conn, trim(ucwords(strtolower($commodity_variant))));
    $commodity_price = mysqli_real_escape_string($conn, trim($commodity_price));

    $sql = "INSERT INTO commodity (commodity_name, commodity_variant, pricing) VALUES ('$commodity_name', '$commodity_variant', '$commodity_price')";

    if (mysqli_query($conn, $sql)) {
        // Update the record with the constructed commodity_id
        $last_id = mysqli_insert_id($conn);

        $updateSql = "UPDATE commodity SET commodity_id='CM$last_id' WHERE id=$last_id";
        if (!mysqli_query($conn, $updateSql)) {
            echo "Error updating commodity record: " . mysqli_error($conn);
        }
        echo "<script>location.replace('farmerdash.php')</script>";
        exit();
    } else {
        echo "Error inserting into commodity table: " . mysqli_error($conn);
    }
}
?>
