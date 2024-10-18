<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['farmer_id'])) {
    header('Location: login.php');
    exit();
}

include 'farmerdash.html';

$farmer_id = $_SESSION['farmer_id'];
$farmer_fname = $_SESSION['farmer_fname'];
$farmer_lname = $_SESSION['farmer_lname'];
$farmer_latitude = $_SESSION['latitude'];
$farmer_longitude = $_SESSION['longitude'];

$farmer_province = $_SESSION['province'];
$farmer_municipality = $_SESSION['municipality'];
$farmer_barangay = $_SESSION['barangay'];

// If the user is logged in, include the dashboard page

if (isset($_POST['commodity_id'])) {
    $commodity_id = $_POST['commodity_id'];
    $commodity_name = $_POST['commodity_name'];
    $amount = $_POST['amount'];
    $date = date("Y-m-d");

    // Insert into total_production table
    $totalProductionSql = "INSERT INTO total_production (farmer_id, commodity_id, commodity_name, farmer_province, farmer_municipality, farmer_barangay, amount, date)"
        . " VALUES ('$farmer_id', '$commodity_id', '$commodity_name', '$farmer_province', '$farmer_municipality', '$farmer_barangay', '$amount', '$date')";

    if (mysqli_query($conn, $totalProductionSql)) {
        $last_id = mysqli_insert_id($conn);
        $total_production_id = "TP" . $last_id;

        // Update total_production record with the constructed production_id
        $updateTotalProductionSql = "UPDATE total_production SET production_id='$total_production_id' WHERE id=$last_id";
        if (!mysqli_query($conn, $updateTotalProductionSql)) {
            echo "Error updating total_production: " . mysqli_error($conn);
        }

        // Check if the record already exists in the production table
        $selectSql = "SELECT production_id, amount FROM production WHERE farmer_id='$farmer_id' AND commodity_id='$commodity_id'";
        $result = mysqli_query($conn, $selectSql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $production_id = $row['production_id'];
                $existingAmount = $row['amount'];
                
                // Update the existing record by adding the current amount
                $newAmount = $existingAmount + $amount;
                
                $updateSql = "UPDATE production SET amount = $newAmount WHERE production_id='$production_id'";

                if (mysqli_query($conn, $updateSql)) {
                    echo "<script>location.replace('farmerdash.php')</script>";
                } else {
                    // Error updating record
                    echo "Error updating production record: " . mysqli_error($conn);
                }
            } else {
                // Record does not exist, insert a new record
                $productionSql = "INSERT INTO production (production_id, farmer_id, commodity_id, commodity_name, farmer_fname, farmer_lname, farmer_latitude, farmer_longitude, farmer_province, farmer_municipality, farmer_barangay, amount)"
                    . " VALUES ('$total_production_id', '$farmer_id', '$commodity_id', '$commodity_name', '$farmer_fname', '$farmer_lname', '$farmer_latitude', '$farmer_longitude', '$farmer_province', '$farmer_municipality', '$farmer_barangay', '$amount')";

                if (mysqli_query($conn, $productionSql)) {
                    // Update the record with the constructed production_id
                    $last_id_production = mysqli_insert_id($conn);
                    $updateProductionSql = "UPDATE production SET production_id='P$last_id_production' WHERE id=$last_id_production";
                    if (!mysqli_query($conn, $updateProductionSql)) {
                        echo "Error updating production record: " . mysqli_error($conn);
                    }

                    // Redirect or display success message as needed
                    echo "<script>location.replace('farmerdash.php')</script>";
                    exit();
                } else {
                    echo "Error inserting into production table: " . mysqli_error($conn);
                }
            }
        } else {
            // Error executing SELECT query
            echo "Error executing SELECT query: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting into total_production table: " . mysqli_error($conn);
    }
}
?>
