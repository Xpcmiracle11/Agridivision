<?php
include 'setupdb.php';

$farmer_id = $_GET['farmer_id'];
$commodity = $_GET['commodity'];

$sql_amount = "SELECT SUM(amount) as total_amount FROM production WHERE farmer_id = '$farmer_id' AND commodity_name = '$commodity'";
$result_amount = mysqli_query($conn, $sql_amount);

if ($result_amount) {
    $row_amount = mysqli_fetch_assoc($result_amount);
    $total_amount = $row_amount['total_amount'];
} else {
    $total_amount = 0;
}

echo json_encode(['total_amount' => $total_amount]);
?>
