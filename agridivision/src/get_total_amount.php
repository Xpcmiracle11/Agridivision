<?php
include 'setupdb.php';

$farmer_id = $_GET['farmer_id'];
$commodity = $_GET['commodity'];

$sql = "SELECT SUM(amount) as total_amount, commodity_id FROM production WHERE farmer_id = '$farmer_id' AND commodity_name = '$commodity'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_amount = $row['total_amount'];
    $commodity_id = $row['commodity_id'];
} else {
    $total_amount = 0;
    $commodity_id = 0; // Set a default value or handle it as needed
}

echo json_encode(['total_amount' => $total_amount, 'commodity_id' => $commodity_id]);
?>
