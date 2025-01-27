<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['farmer_id'])) {
    header('Location: login.php');
    exit();
}

$farmer_id = $_SESSION['farmer_id'];
$farmer_fname = $_SESSION['farmer_fname'];
$farmer_lname = $_SESSION['farmer_lname'];
$latitude = $_SESSION['latitude'];
$longitude = $_SESSION['longitude'];

// If the user is logged in, include the dashboard page
include 'farmermarket.html';

if (isset($_POST['province'])) {
    // Retrieve form data
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $commodity_id = $_POST['commodity_id'];
    $commodity_name = $_POST['commodity'];
    $commodity_price = $_POST['price'];
    $commodity_quantity = $_POST['quantity'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    $date = date('Y-m-d');

    // Handle image upload
    if ($_FILES['commodity_image_input']['error'] == 0) {
        $file_tmp = $_FILES['commodity_image_input']['tmp_name'];

        // Generate a unique filename
        $file_extension = pathinfo($_FILES['commodity_image_input']['name'], PATHINFO_EXTENSION);
        $unique_filename = $farmer_fname . $farmer_lname . '_' . time() . '_' . mt_rand(1000, 9999) . '.' . $file_extension;

        $file_path = 'assets/market_image/' . $unique_filename;

        if (move_uploaded_file($file_tmp, $file_path)) {
            echo "File uploaded successfully!";
        } else {
            echo "Error uploading file!";
        }
    }

    // Insert data into the market table
    $sql_insert = "INSERT INTO market (
        farmer_id, farmer_fname, farmer_lname, farmer_province, farmer_municipality,
        farmer_barangay, farmer_lat, farmer_long, commodity_id, commodity_name,
        commodity_price, commodity_quantity, phone_number, description, image_name, date
    ) VALUES (
        '$farmer_id', '$farmer_fname', '$farmer_lname', '$province', '$municipality',
        '$barangay', '$latitude', '$longitude', '$commodity_id', '$commodity_name',
        '$commodity_price', '$commodity_quantity', '$phone', '$description', '$unique_filename', '$date'
    )";

    if (mysqli_query($conn, $sql_insert)) {
        $last_id = mysqli_insert_id($conn);
        $market_id = "M" . $last_id;

        $updateSql = "UPDATE market SET market_id='$market_id' WHERE id=$last_id";

        if (mysqli_query($conn, $updateSql)) {
            echo "<script>location.replace('farmermarket.php');</script>";

            // Deduct the commodity_quantity from the production table
            $updateProductionSql = "UPDATE production SET amount = amount - '$commodity_quantity' WHERE farmer_id = '$farmer_id' AND commodity_name = '$commodity_name'";
            mysqli_query($conn, $updateProductionSql);
        } else {
            echo "<script>alert('Error updating market_id: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error inserting record: " . mysqli_error($conn) . "');</script>";
    }
}
?>
