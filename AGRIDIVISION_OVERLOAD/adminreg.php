<?php
// Start or resume a session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Include database setup
include 'setupdb.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Include the HTML template for the admin registration form
include 'adminreg.html';
$admin_id = $_SESSION['admin_id'];

$resultMessage = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if form is submitted
if (isset($_POST['province'])) {
    // Retrieve form data
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $name = $municipality . " Municipal Agriculturist";
    $date = date('Y-m-d');
    //Password
    $provinceLetters = substr($province, 0, 3);
    $municipalityLetters = substr($municipality, 0, 3);
    $password = $provinceLetters . $municipalityLetters;
    //

    // Sanitize user inputs to prevent SQL injection
    $province = mysqli_real_escape_string($conn, trim(ucwords(strtolower($province))));
    $municipality = mysqli_real_escape_string($conn, trim(ucwords(strtolower($municipality))));
    $email = mysqli_real_escape_string($conn, trim(strtolower($email)));
    $phone = mysqli_real_escape_string($conn, trim($phone));
    $name = mysqli_real_escape_string($conn, trim(ucwords(strtolower($name))));
    $repass = mysqli_real_escape_string($conn, trim($repass));
    $password = mysqli_real_escape_string($conn, trim($password));

    // Check if municipality already exists
    $checkSql = "SELECT * FROM municipal_agriculturist WHERE municipality = '$municipality'";
    $checkResult = mysqli_query($conn, $checkSql);

    // Check if municipality already exists
    $checkSql = "SELECT * FROM brgy_tech WHERE barangay = '$barangay'";
    $checkResult = mysqli_query($conn, $checkSql);

    // Check if email already exists in admin table
    $checkAdminSql = "SELECT * FROM admin WHERE email = '$email'";
    $checkAdminResult = mysqli_query($conn, $checkAdminSql);

    // Check if email already exists in brgy_tech table
    $checkBrgyTechSql = "SELECT * FROM brgy_tech WHERE email = '$email'";
    $checkBrgyTechResult = mysqli_query($conn, $checkBrgyTechSql);

    // Check if email already exists in farmer table
    $checkFarmerSql = "SELECT * FROM farmer WHERE email = '$email'";
    $checkFarmerResult = mysqli_query($conn, $checkFarmerSql);

    // Check if email already exists in municipal_agriculturist table
    $checkMunicipalAgricSql = "SELECT * FROM municipal_agriculturist WHERE email = '$email'";
    $checkMunicipalAgricResult = mysqli_query($conn, $checkMunicipalAgricSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Municipality already exists, show an error message
        $resultMessage = "Error: Municipality '$municipality' already exists!";
    } else if (mysqli_num_rows($checkAdminResult) > 0 ||
    mysqli_num_rows($checkBrgyTechResult) > 0 ||
    mysqli_num_rows($checkFarmerResult) > 0 ||
    mysqli_num_rows($checkMunicipalAgricResult) > 0 ||
    mysqli_num_rows($checkBusinessOwnerResult) > 0) {
    // Email already exists in one of the tables, show an error message
    $resultMessage = "Error: Email '$email' already exists!";
    } else {
        // PHP Mailer
        $mail = new PHPMailer(true);

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'shezsowicked7@gmail.com';
            $mail->Password   = 'llitkzofftqjvomc';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            // Sender and recipient settings
            $mail->setFrom('shezsowicked7@gmail.com');
            $mail->addAddress($email);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Your Account Details';
            $mail->Body    = "Hello $name,<br><br>Your account has been successfully created.<br>Email: $email<br>Password: $password<br><br>Thank you.";

            // Send email
            $mail->send();

                // Insert the user data into the database without specifying municipal_id
                $sql = "INSERT INTO municipal_agriculturist (admin_id, name, province, municipality, email, phone, password, regdate)"
                    . " VALUES ('$admin_id', '$name', '$province', '$municipality', '$email', '$phone', '$password', '$date')";

                if (mysqli_query($conn, $sql)) {
                    // Get the last inserted ID
                    $last_id = mysqli_insert_id($conn);

                    // Construct the municipal_id with the "MA" prefix
                    $municipal_id = "MA" . $last_id;

                    // Update the record with the constructed municipal_id
                    $updateSql = "UPDATE municipal_agriculturist SET municipal_id='$municipal_id' WHERE id=$last_id";
                    mysqli_query($conn, $updateSql);

                    $resultMessage = "New record added successfully";

                    // Redirect or display success message as needed
                    echo "<script>window.onload = function() { openModal(); }</script>";
                } else {
                    $resultMessage = "Error: " . mysqli_error($conn);
                }
        } catch (Exception $e) {
            $resultMessage = "Error sending email: {$mail->ErrorInfo}";
        }
    }
}
?>

<div class="modal fade" role="dialog" tabindex="-1" id="submit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
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

        // Check if the record was added successfully
        var resultMessage = document.getElementById("resultMessage").textContent;

        if (resultMessage === "New record added successfully") {
            // Redirect to login.php
            location.replace("admintable.php");
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Get a reference to the form element
        var registrationForm = document.getElementById("registrationForm");

        // Add a submit event listener to the form
        registrationForm.addEventListener("submit", function(event) {
            // Check if password and repeat password match
            var password = document.getElementById("passwordInput").value;
            var repass = document.getElementById("repassInput").value;

            if (password !== repass) {
                // Prevent the default form submission
                event.preventDefault();

                // Show the modal with the error message
                document.getElementById("resultMessage").textContent = "Password and repeat password do not match!";
                handleModalClose();
            }
        });

        // Call the openModal function when the page loads, only if there is a valid submission
        <?php if (!empty($resultMessage)) { ?>
            openModal();
        <?php } ?>
    });
</script>
