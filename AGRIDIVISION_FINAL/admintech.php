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
include 'admintech.html';


// Retrieve data from the "admin" table
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM brgy_tech WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Generate HTML form to edit the selected row
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $fname = $row["fname"];
        $lname = $row["lname"];
        $email = $row["email"];
        $num = $row["num"];
        $prov = $row["prov"];
        $mun = $row["mun"];
        $brgy = $row["brgy"];
        $street = $row["street"];
        $zip = $row["zip"];
        $dob = $row["dob"];
        $dobFormatted = date("F j, Y", strtotime($dob));
    }
}
?>

<script>
    // Set the values in the input fields
    document.getElementById('fname').innerHTML = '<?php echo isset($fname) ? $fname : ""; ?>';
    document.getElementById('lname').innerHTML = '<?php echo isset($lname) ? $lname : ""; ?>';
    document.getElementById('email').innerHTML = '<?php echo isset($email) ? $email : ""; ?>';
    document.getElementById('number').innerHTML = '<?php echo isset($num) ? $num : ""; ?>';
    document.getElementById('province').innerHTML = '<?php echo isset($prov) ? $prov : ""; ?>';
    document.getElementById('municipality').innerHTML = '<?php echo isset($mun) ? $mun : ""; ?>';
    document.getElementById('brgy').innerHTML = '<?php echo isset($brgy) ? $brgy : ""; ?>';
    document.getElementById('street').innerHTML = '<?php echo isset($street) ? $street : ""; ?>';
    document.getElementById('zip').innerHTML = '<?php echo isset($zip) ? $zip : ""; ?>';
    document.getElementById('dob').innerHTML = '<?php echo isset($dobFormatted) ? $dobFormatted : ""; ?>';
</script>
    