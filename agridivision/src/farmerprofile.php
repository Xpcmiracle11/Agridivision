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

include 'farmerprofile.html';

$sqlFarmer = "SELECT rsbsanum, lname, mname, fname, gender, province, municipality, barangay, phone, email, dob, religion, civil_status, education FROM farmer WHERE farmer_id = '$farmer_id'";

$sqlFarm = "SELECT farm_area, ancestral_domain, farm_document_no, ownership_type, commodity_name, farm_type FROM farm WHERE farmer_id = '$farmer_id'";
?>

<script>
    <?php
    $resultFarmer = $conn->query($sqlFarmer);
    if ($resultFarmer && $rowFarmer = $resultFarmer->fetch_assoc()) {
        ?>
        // Set the innerHTML in the paragraph from Farmer
        document.getElementById('rsbsa').innerHTML = '<?php echo isset($rowFarmer['rsbsanum']) ? $rowFarmer['rsbsanum'] : ""; ?>';
        // Concatenate first name, middle name, and last name with spaces
        var fullName = '<?php echo isset($rowFarmer['fname']) ? $rowFarmer['fname'] : ""; ?>';
        fullName += '<?php echo isset($rowFarmer['mname']) ? " " . $rowFarmer['mname'] : ""; ?>';
        fullName += '<?php echo isset($rowFarmer['lname']) ? " " . $rowFarmer['lname'] : ""; ?>';
        document.getElementById('name').innerHTML = fullName;
        document.getElementById('gender').innerHTML = '<?php echo isset($rowFarmer['gender']) ? $rowFarmer['gender'] : ""; ?>';
        // Concatenate province, municipality, and barangay with commas
        var address = '<?php echo isset($rowFarmer['province']) ? $rowFarmer['province'] : ""; ?>';
        address += ', <?php echo isset($rowFarmer['municipality']) ? $rowFarmer['municipality'] : ""; ?>';
        address += ', <?php echo isset($rowFarmer['barangay']) ? $rowFarmer['barangay'] : ""; ?>';
        document.getElementById('address').innerHTML = address;
        document.getElementById('phone').innerHTML = '<?php echo isset($rowFarmer['phone']) ? $rowFarmer['phone'] : ""; ?>';
        document.getElementById('email').innerHTML = '<?php echo isset($rowFarmer['email']) ? $rowFarmer['email'] : ""; ?>';
        document.getElementById('dob').innerHTML = '<?php echo isset($rowFarmer['dob']) ? $rowFarmer['dob'] : ""; ?>';
        document.getElementById('religion').innerHTML = '<?php echo isset($rowFarmer['religion']) ? $rowFarmer['religion'] : ""; ?>';
        document.getElementById('civstats').innerHTML = '<?php echo isset($rowFarmer['civil_status']) ? $rowFarmer['civil_status'] : ""; ?>';
        document.getElementById('education').innerHTML = '<?php echo isset($rowFarmer['education']) ? $rowFarmer['education'] : ""; ?>';
        <?php
    }
    ?>

    <?php
    $resultFarm = $conn->query($sqlFarm);
    if ($resultFarm && $rowFarm = $resultFarm->fetch_assoc()) {
        ?>
        // Set the innerHTML in the paragraph from Farm
        document.getElementById('farmArea').innerHTML = '<?php echo isset($rowFarm['farm_area']) ? $rowFarm['farm_area'] : ""; ?>';
        document.getElementById('ancestralDomain').innerHTML = '<?php echo isset($rowFarm['ancestral_domain']) ? $rowFarm['ancestral_domain'] : ""; ?>';
        document.getElementById('farmDocumentNumber').innerHTML = '<?php echo isset($rowFarm['farm_document_no']) ? $rowFarm['farm_document_no'] : ""; ?>';
        document.getElementById('ownershipType').innerHTML = '<?php echo isset($rowFarm['ownership_type']) ? $rowFarm['ownership_type'] : ""; ?>';
        document.getElementById('commodity').innerHTML = '<?php echo isset($rowFarm['commodity_name']) ? $rowFarm['commodity_name'] : ""; ?>';
        document.getElementById('farmType').innerHTML = '<?php echo isset($rowFarm['farm_type']) ? $rowFarm['farm_type'] : ""; ?>';
        <?php
    }
    ?>
</script>
