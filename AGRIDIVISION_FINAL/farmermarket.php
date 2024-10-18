<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// If the user is logged in, include the dashboard page
$farmerid = $_SESSION['user_id']; // Use 'user_id' instead of 'farmer_id'
$farmerfname = $_SESSION['fname'];
$farmerlname = $_SESSION['lname'];
$farmercrop = $_SESSION['crop'];
$farmerprov = $_SESSION['prov'];
$farmermunicipality = $_SESSION['mun'];
$farmerbrgy = $_SESSION['brgy'];
$farmerzip = $_SESSION['zip'];
$farmerlongitude = $_SESSION['longitude'];
$farmerlatitude = $_SESSION['latitude'];

if (isset($_POST['amount'])) {
    $price = $_POST['price'];
    $amount = $_POST['amount']; // Correct variable name
    $date = date('Y-m-d');
    $price = mysqli_real_escape_string($conn, trim($price));
    $amount = mysqli_real_escape_string($conn, trim($amount)); // Correct variable name

    // Insert into crop_information
    $sql = "INSERT INTO crop_information (farmer_id, farmer_fname, farmer_lname, crop, prov, mun, brgy, zip, longitude, latitude, price, amount, date) VALUES ('$farmerid', '$farmerfname', '$farmerlname', '$farmercrop', '$farmerprov', '$farmermunicipality', '$farmerbrgy', '$farmerzip', '$farmerlongitude', '$farmerlatitude', '$price', '$amount', '$date')"; 

    if (mysqli_query($conn, $sql)) {
        // Successfully inserted into crop_information

        // Update total_stocks by subtracting the amount
        $updateSql = "UPDATE total_stocks SET total_amount = total_amount - $amount WHERE farmer_id = $farmerid";
        if (mysqli_query($conn, $updateSql)) {
            // Successfully updated total_stocks
            echo '<script>location.replace("farmermarket.php");</script>';
        } else {
            echo "Error updating total_stocks table: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting into crop_information: " . mysqli_error($conn);
    }
}
include 'farmermarket.html';

?>
