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
    $query = "SELECT * FROM farmer WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the entered password matches the stored password
        if ($password === $row['password']) {
            // Authentication successful, set session variables based on table
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['crop'] = $row['crop'];
            $_SESSION['prov'] = $row['prov'];
            $_SESSION['mun'] = $row['mun'];
            $_SESSION['brgy'] = $row['brgy'];
            $_SESSION['street'] = $row['street'];
            $_SESSION['zip'] = $row['zip'];
            $_SESSION['longitude'] = $row['longitude'];
            $_SESSION['latitude'] = $row['latitude'];
            $resultMessage = "You Logged in as a Farmer.";
        } else {
            $resultMessage = "Incorrect password.";
        }
    } else {
        $query = "SELECT * FROM business_owner WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Check if the entered password matches the stored password
            if ($password === $row['password']) {
                // Authentication successful, set session variables based on table
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['crop'] = $row['crop'];
                $_SESSION['prov'] = $row['prov'];
                $_SESSION['mun'] = $row['mun'];
                $_SESSION['brgy'] = $row['brgy'];
                $_SESSION['street'] = $row['street'];
                $_SESSION['zip'] = $row['zip'];
                $_SESSION['longitude'] = $row['longitude'];
                $_SESSION['latitude'] = $row['latitude'];
                $resultMessage = "You Logged in as a Business Owner.";
            } else {
                $resultMessage = "Incorrect password.";
            }
        } else {
            $query = "SELECT * FROM admin WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);

                // Check if the entered password matches the stored password
                if ($password === $row['password']) {
                    // Authentication successful, set session variables based on table
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['lname'] = $row['lname'];
                    $_SESSION['dob'] = $row['dob'];
                    $_SESSION['profileimg'] = $row['profileimg'];
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
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['fname'] = $row['fname'];
                        $_SESSION['lname'] = $row['lname'];
                        $_SESSION['municipality'] = $row['mun'];
                        $_SESSION['dob'] = $row['dob'];
                        $_SESSION['profileimg'] = $row['profileimg'];
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
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['fname'] = $row['fname'];
                            $_SESSION['lname'] = $row['lname'];
                            $_SESSION['municipality'] = $row['mun'];
                            $_SESSION['brgy'] = $row['brgy'];
                            $_SESSION['dob'] = $row['dob'];
                            $_SESSION['profileimg'] = $row['profileimg'];
                            $resultMessage = "You Logged in as a Barangay Technician.";
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
                <button class="btn btn-primary" type="button" style="background: #ffcc49; border-color: #ffcc49;" data-bs-dismiss="modal" onclick="handleModalClose();">Okay</button>
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
