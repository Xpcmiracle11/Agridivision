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
include 'farmerdash.html';

$farmerid = $_SESSION['user_id']; // Use 'user_id' instead of 'farmer_id'
$farmerfname = $_SESSION['fname'];
$farmerlname = $_SESSION['lname'];
$farmercrop = $_SESSION['crop'];
$farmer_prov = $_SESSION['prov'];
$farmer_mun = $_SESSION['mun'];
$farmer_brgy = $_SESSION['brgy'];
$farmer_street = $_SESSION['street'];
$farmer_zip = $_SESSION['zip'];

if (isset($_POST['amount'])) {
    $newAmount = $_POST['amount'];
    $newAmount = mysqli_real_escape_string($conn, trim($newAmount)); // Correct variable name

    // Insert into farmer_stocks
    $insertSql = "INSERT INTO farmer_stocks (farmer_id, fname, lname, crop, amount, date) 
        VALUES ('$farmerid', '$farmerfname', '$farmerlname', '$farmercrop', '$newAmount', NOW())";

    if (mysqli_query($conn, $insertSql)) {
        // Successfully inserted into farmer_stocks

        // Check if the farmer_id exists in total_stocks
        $checkSql = "SELECT * FROM total_stocks WHERE farmer_id = '$farmerid'";
        $checkResult = mysqli_query($conn, $checkSql);

        $currentDate = date('Y-m-d');

        if (mysqli_num_rows($checkResult) > 0) {
            // Farmer_id already exists in total_stocks, update the total_amount and date
            $updateSql = "UPDATE total_stocks SET total_amount = total_amount + '$newAmount', farmer_fname = '$farmerfname', farmer_lname = '$farmerlname', crop = '$farmercrop', date = '$currentDate', farmer_prov = '$farmer_prov', farmer_mun = '$farmer_mun', farmer_brgy = '$farmer_brgy', farmer_street = '$farmer_street', farmer_zip = '$farmer_zip' WHERE farmer_id = '$farmerid'";
        } else {
            // Farmer_id does not exist in total_stocks, insert a new row
            $updateSql = "INSERT INTO total_stocks (farmer_id, farmer_fname, farmer_lname, crop, total_amount, date, farmer_prov, farmer_mun, farmer_brgy, farmer_street, farmer_zip) VALUES ('$farmerid', '$farmerfname', '$farmerlname', '$farmercrop', '$newAmount', '$currentDate', '$farmer_prov', '$farmer_mun', '$farmer_brgy', '$farmer_street', '$farmer_zip')";
        }

        if (mysqli_query($conn, $updateSql)) {
            // Successfully inserted or updated in total_stocks
            echo '<script>location.replace("farmerdash.php");</script>';
            exit();
        } else {
            echo "Error updating total_stocks table: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting into farmer_stocks: " . mysqli_error($conn);
    }
}
?>
