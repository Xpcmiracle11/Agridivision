<?php
include 'setupdb.php';
include 'businessregister.html';

$resultMessage = "";

if (isset($_POST['fname'])) {
    // Retrieve form data using POST method
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $busspermit = $_POST['busspermit'];
    $prov = $_POST['province'];
    $mun = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $street = $_POST['street'];
    $dob = $_POST['dob'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $password = $_POST['password'];
    $repass = $_POST['repass'];
    $commodity_id = $_POST['selected_commodity_id'];
    $commodity_name = $_POST['selected_commodity_name'];
    $date = date('Y-m-d');

    // Sanitize user inputs to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($fname))));
    $mname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($mname))));
    $lname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($lname))));
    $gender = mysqli_real_escape_string($conn, trim($gender));
    $email = mysqli_real_escape_string($conn, trim(strtolower($email)));
    $phone = mysqli_real_escape_string($conn, trim($phone));
    $busspermit = mysqli_real_escape_string($conn, trim($busspermit));
    $prov = mysqli_real_escape_string($conn, trim(ucwords(strtolower($prov))));
    $mun = mysqli_real_escape_string($conn, trim(ucwords(strtolower($mun))));
    $barangay = mysqli_real_escape_string($conn, trim(ucwords(strtolower($barangay))));
    $street = mysqli_real_escape_string($conn, trim(ucwords(strtolower($street))));
    $dob = mysqli_real_escape_string($conn, trim($dob));
    $latitude = mysqli_real_escape_string($conn, trim($latitude));
    $longitude = mysqli_real_escape_string($conn, trim($longitude));
    $password = mysqli_real_escape_string($conn, trim($password));
    $repass = mysqli_real_escape_string($conn, trim($repass));
    $commodity_id = mysqli_real_escape_string($conn, trim($commodity_id));
    $commodity_name = mysqli_real_escape_string($conn, trim($commodity_name));

    // Check if password and repeat password match
    if ($password != $repass) {
        $resultMessage = "Password and repeat password do not match!";
    } else {
        // Add new user to the database with the new image name (without extension)
        $sql = "INSERT INTO business_owner (business_fname, business_mname, business_lname, business_gender, business_email, business_phone, business_permit, business_province, business_municipality, business_barangay, business_street, business_dob, business_latitude, business_longitude, commodity_id, commodity_name, password, date) VALUES ('$fname', '$mname', '$lname', '$gender', '$email', '$phone', '$busspermit', '$prov', '$mun', '$barangay', '$street', '$dob', '$latitude', '$longitude', '$commodity_id', '$commodity_name', '$password', '$date')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $business_id = "BO" . $last_id;

            $updateSql = "UPDATE business_owner SET business_id='$business_id' WHERE id=$last_id";
            mysqli_query($conn, $updateSql);

            $resultMessage = "New record added successfully";
            // Redirect only when the record is added successfully
            echo "<script>window.onload = function() { openModal(); }</script>";
        } else {
            $resultMessage = "Error: " . mysqli_error($conn);
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
            location.replace("login.php");
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


?>