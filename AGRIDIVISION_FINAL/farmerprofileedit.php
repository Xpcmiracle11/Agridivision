<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$alertMessage = ""; // Initialize the alert message

if (isset($_POST['fname'])) {
    // Retrieve the values from the form
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $num = mysqli_real_escape_string($conn, $_POST['number']);
    $rsbsanum = mysqli_real_escape_string($conn, $_POST['rsbsa']);
    $crop = mysqli_real_escape_string($conn, $_POST['crop']);
    $prov = mysqli_real_escape_string($conn, $_POST['province']);
    $mun = mysqli_real_escape_string($conn, $_POST['municipality']);
    $brgy = mysqli_real_escape_string($conn, $_POST['brgy']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $repass = mysqli_real_escape_string($conn, $_POST['repass']);
    
    // Image handling code
    if ($password !== $repass) {
        $alertMessage = "Passwords do not match.";
    } else{
    $allowedFormats = ['jpg']; // Define allowed image formats

    if (!empty($_FILES['profileimg']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES['profileimg']['name'], PATHINFO_EXTENSION));
    
        if (!in_array($imageFileType, $allowedFormats)) {
            $alertMessage = "Only JPG format is allowed.";
        } else {
            // Generate the new image name using the specified format (without extension)
            $newImageNameWithoutExtension = ucfirst(substr($fname, 0, 3)) . ucfirst(substr($lname, 0, 3)) . str_replace('-', '', $dob);
    
            // Move the uploaded image to the destination folder
            $destinationPath = "C:/xampp/htdocs/AGRIDIVISION_FINAL/assets/img/farmer/";
            $destinationFile = $destinationPath . $newImageNameWithoutExtension . '.' . $imageFileType;
    
            if (move_uploaded_file($_FILES['profileimg']['tmp_name'], $destinationFile)) {
                // Update the farmer record in the database
                $user_id = $_SESSION['user_id'];
                $sql = "UPDATE farmer SET fname='$fname', lname='$lname', email='$email', num='$num', rsbsanum='$rsbsanum', crop='$crop', prov='$prov', mun='$mun', brgy='$brgy', street='$street', zip='$zip', dob='$dob', password='$password', profileimg='$newImageNameWithoutExtension'  WHERE id=$user_id";
    
                if (mysqli_query($conn, $sql)) {
                    $alertMessage = "Farmer profile has been updated";
                } else {
                    $alertMessage = "Error updating Farmer profile: " . mysqli_error($conn);
                }
            } else {
                $alertMessage = "Error uploading image.";
            }
        }
    } else {
        // Update the farmer record in the database without changing the image
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE farmer SET fname='$fname', lname='$lname', email='$email', num='$num', rsbsanum='$rsbsanum', crop='$crop', prov='$prov', mun='$mun', brgy='$brgy', street='$street', zip='$zip', dob='$dob', password='$password' WHERE id=$user_id";
    
        if (mysqli_query($conn, $sql)) {
            $alertMessage = "Farmer profile has been updated";
        } else {
            $alertMessage = "Error updating Farmer profile: " . mysqli_error($conn);
        }
    }    
}
}

// Retrieve data from the "farmer" table
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM farmer WHERE id = $user_id";
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
        $rsbsanum = $row["rsbsanum"];
        $crop = $row["crop"];
        $prov = $row["prov"];
        $mun = $row["mun"];
        $brgy = $row["brgy"];
        $street = $row["street"];
        $zip = $row["zip"];
        $dob = $row["dob"];
        $pass = $row["password"];
        
        include 'farmerprofileedit.html'; 
    }
}
?>
<div class="modal fade" role="dialog" tabindex="-1" id="submit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- You can add header content here if needed -->
            </div>
            <div class="modal-body">
                <p id="resultMessage"><?php echo $alertMessage; ?></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" style="background: #ffcc49; border-color: #ffcc49;" data-bs-dismiss="modal" onclick="handleModalClose();">Okay</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Set the values in the input fields
    document.getElementById('fname').value = '<?php echo isset($fname) ? $fname : ""; ?>';
    document.getElementById('lname').value = '<?php echo isset($lname) ? $lname : ""; ?>';
    document.getElementById('email').value = '<?php echo isset($email) ? $email : ""; ?>';
    document.getElementById('number').value = '<?php echo isset($num) ? $num : ""; ?>';
    document.getElementById('rsbsa').value = '<?php echo isset($rsbsanum) ? $rsbsanum : ""; ?>';
    document.getElementById('crop').value = '<?php echo isset($crop) ? $crop : ""; ?>';
    document.getElementById('province').value = '<?php echo isset($prov) ? $prov : ""; ?>';
    document.getElementById('municipality').value = '<?php echo isset($mun) ? $mun : ""; ?>';
    document.getElementById('brgy').value = '<?php echo isset($brgy) ? $brgy : ""; ?>';
    document.getElementById('street').value = '<?php echo isset($street) ? $street : ""; ?>';
    document.getElementById('zip').value = '<?php echo isset($zip) ? $zip : ""; ?>';
    document.getElementById('dob').value = '<?php echo isset($dob) ? $dob : ""; ?>';
    document.getElementById('password').value = '<?php echo isset($pass) ? $pass : ""; ?>';
    document.getElementById('repass').value = '<?php echo isset($pass) ? $pass : ""; ?>';

    function openModal() {
        var modal = new bootstrap.Modal(document.getElementById("submit"), { backdrop: 'static', keyboard: false });
        modal.show();
    }

    function handleModalClose() {
        // Close the modal
        var modal = bootstrap.Modal.getInstance(document.getElementById("submit"));
        modal.hide();

        // Check the resultMessage and redirect accordingly
        var resultMessage = document.getElementById("resultMessage").textContent;

        switch (resultMessage) {
            case "Passwords do not match":
                window.location.replace("farmerprofileedit.php");
                break;
            case "Farmer profile has been updated":
                window.location.replace("farmerprofile.php");
                break;
            default:
                // Handle other cases or do nothing
                break;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Call the openModal function when the page loads, only if there is a valid submission
        <?php if (!empty($alertMessage)) { ?>
            openModal();
        <?php } ?>
    });
</script>
