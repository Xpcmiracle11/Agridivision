<?php
session_start();
include 'setupdb.php';

$resultMessage = "";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if the email exists in any of the specified tables
    $query = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the entered password matches the stored password
        if ($password === $row['password']) {
            // Authentication successful, set session variables based on table
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $_SESSION['province'] = $row['province'];
            $resultMessage = "You Logged in as an Admin.";
        } else {
            $resultMessage = "Incorrect password.";
        }
    } else {
        $query = "SELECT * FROM municipal_agriculturist WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Check if the entered password matches the stored password
            if ($password === $row['password']) {
                // Authentication successful, set session variables based on table
                $_SESSION['municipal_id'] = $row['municipal_id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['province'] = $row['province'];
                $_SESSION['municipality'] = $row['municipality'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone'] = $row['phone'];
                $resultMessage = "You Logged in as a Municipal Agriculturist.";
            } else {
                $resultMessage = "Incorrect password.";
            }
        } else {
            $query = "SELECT * FROM brgy_tech WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                // Check if the entered password matches the stored password
                if ($password === $row['password']) {
                    // Authentication successful, set session variables based on table
                    $_SESSION['brgy_tech_id'] = $row['brgy_tech_id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['province'] = $row['province'];
                    $_SESSION['municipality'] = $row['municipality'];
                    $_SESSION['barangay'] = $row['barangay'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['phone'] = $row['phone'];
                    $resultMessage = "You Logged in as a Barangay Technician.";
                } else {
                    $resultMessage = "Incorrect password.";
                }
            } else {
                $query = "SELECT * FROM farmer WHERE email = '$email'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    // Check if the entered password matches the stored password
                    if ($password === $row['password']) {
                        // Authentication successful, set session variables based on table
                        $_SESSION['farmer_id'] = $row['farmer_id'];
                        $_SESSION['farmer_fname'] = $row['fname'];
                        $_SESSION['farmer_mname'] = $row['mname'];
                        $_SESSION['farmer_lname'] = $row['lname'];
                        $_SESSION['rsbsanumber'] = $row['rsbsanum'];
                        $_SESSION['street'] = $row['street'];
                        $_SESSION['province'] = $row['province'];
                        $_SESSION['barangay'] = $row['barangay'];
                        $_SESSION['municipality'] = $row['municipality'];
                        $_SESSION['latitude'] = $row['latitude'];
                        $_SESSION['longitude'] = $row['longitude'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['phone'] = $row['phone'];

                        $resultMessage = "You Logged in as a Farmer.";
                    } else {
                        $resultMessage = "Incorrect password.";
                    }
                } else {
                    $query = "SELECT * FROM business_owner WHERE business_email = '$email'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                        // Check if the entered password matches the stored password
                        if ($password === $row['password']) {
                            // Authentication successful, set session variables based on table
                            $_SESSION['business_id'] = $row['business_id'];
                            $_SESSION['business_fname'] = $row['business_fname'];
                            $_SESSION['business_mname'] = $row['business_mname'];
                            $_SESSION['business_lname'] = $row['business_lname'];
                            $_SESSION['business_permit'] = $row['business_permit'];
                            $_SESSION['business_province'] = $row['business_province'];
                            $_SESSION['business_municipality'] = $row['business_municipality'];
                            $_SESSION['business_barangay'] = $row['business_barangay'];
                            $_SESSION['business_street'] = $row['business_street'];
                            $_SESSION['latitude'] = $row['business_latitude'];
                            $_SESSION['longitude'] = $row['business_longitude'];
                            $_SESSION['commodity_id'] = $row['commodity_id'];
                            $_SESSION['commodity_name'] = $row['commodity_name'];

                            $resultMessage = "You Logged in as a Business Owner.";
                        } else {
                            $resultMessage = "Incorrect password.";
                        }
                    } else {
                        $resultMessage = "Email not found.";
                    }
                }
            }
        }
    }
}

include 'login.html';
?>



<div class="modal fade" role="dialog" tabindex="-1" id="submit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- You can add header content here if needed -->
            </div>
            <div class="modal-body">
                <p id="resultMessage"><?php echo $resultMessage; ?></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" style="background: #062017; border-color: #062017;" data-bs-dismiss="modal" onclick="handleModalClose();">Okay</button>
            </div>
        </div>
    </div>
</div>

<script>
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
            case "You Logged in as a Business Owner.":
                window.location.replace("businessdash.php");
                break;
            case "You Logged in as a Farmer.":
                window.location.replace("farmerdash.php");
                break;
            case "You Logged in as an Admin.":
                window.location.replace("admindash.php");
                break;
            case "You Logged in as a Municipal Agriculturist.":
                window.location.replace("municipaldash.php");
                break;
            case "You Logged in as a Barangay Technician.":
                window.location.replace("techdash.php");
                break;
            case "You Logged in as a Business Owner.":
                window.location.replace("businessdash.php");
                break;
            default:
                // Handle other cases or do nothing
                break;
        }
    }
    
    document.addEventListener("DOMContentLoaded", function() {
        // Call the openModal function when the page loads, only if there is a valid submission
        <?php if (!empty($resultMessage)) { ?>
            openModal();
        <?php } ?>
    });
</script>
