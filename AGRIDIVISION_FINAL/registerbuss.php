<?php
include 'setupdb.php';
include 'registerbuss.html';

// Initialize the result message
$resultMessage = "";

if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $num = $_POST['number'];
    $busspermit = $_POST['busspermit'];
    $crop = $_POST['crop'];
    $prov = $_POST['province'];
    $mun = $_POST['municipality'];
    $brgy = $_POST['brgy'];
    $street = $_POST['street'];
    $zip = $_POST['zip'];
    $dob = $_POST['birthdate'];
    $password = $_POST['password'];
    $repass = $_POST['repass'];

    // Sanitize user inputs to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($fname))));
    $lname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($lname))));
    $email = mysqli_real_escape_string($conn, trim(strtolower($email)));
    $num = mysqli_real_escape_string($conn, trim($num));
    $busspermit = mysqli_real_escape_string($conn, trim($busspermit));
    $crop = mysqli_real_escape_string($conn, trim($crop));
    $prov = mysqli_real_escape_string($conn, trim(ucwords(strtolower($prov))));
    $mun = mysqli_real_escape_string($conn, trim(ucwords(strtolower($mun))));
    $brgy = mysqli_real_escape_string($conn, trim(ucwords(strtolower($brgy))));
    $street = mysqli_real_escape_string($conn, trim(ucwords(strtolower($street))));
    $zip = mysqli_real_escape_string($conn, trim($zip));
    $dob = mysqli_real_escape_string($conn, trim($dob));
    $password = mysqli_real_escape_string($conn, trim($password));
    $repass = mysqli_real_escape_string($conn, trim($repass));
    $date = date('Y-m-d');

    // Check if password and repeat password match
    if ($password != $repass) {
        $resultMessage = "Password and repeat password do not match!";
    } else {
        $allowedFormats = ['jpg']; // Define allowed image formats

        $imageFileType = strtolower(pathinfo($_FILES['profileimg']['name'], PATHINFO_EXTENSION));

        if (!in_array($imageFileType, $allowedFormats)) {
            $resultMessage = "Only JPG formats are allowed.";
        } else {
            // Generate the new image name using the specified format
            $newImageName = ucfirst(substr($fname, 0, 3)) . ucfirst(substr($lname, 0, 3)) . str_replace('-', '', $dob);

            // Set the destination path for the image, including the file extension
            $destinationPath = "C:/xampp/htdocs/AGRIDIVISION_FINAL/assets/img/business_owner/" . $newImageName . ".jpg";

            // Move the uploaded image to the destination path
            if (move_uploaded_file($_FILES['profileimg']['tmp_name'], $destinationPath)) {

                $address = urlencode("$prov, $mun, $brgy, $street, $zip");
                $geocodeUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyBb3onzuJdhZOXXNIzC73XDXolEBNTujks";
                $response = file_get_contents($geocodeUrl);
                $data = json_decode($response);
                if ($data->status === "OK") {
                    $latitude = $data->results[0]->geometry->location->lat;
                    $longitude = $data->results[0]->geometry->location->lng;

                    // Add new user to the database with the new image name (without extension)
                    $sql = "INSERT INTO business_owner (fname, lname, email, num, busspermit, crop, prov, mun, brgy, street, zip, longitude, latitude, dob, password, profileimg, regdate)"
                        . " VALUES ('$fname', '$lname', '$email', '$num', '$busspermit', '$crop', '$prov', '$mun', '$brgy', '$street', '$zip', '$longitude', '$latitude', '$dob', '$password', '$newImageName', '$date')";

                    if (mysqli_query($conn, $sql)) {
                        $resultMessage = "New record added successfully";
                        // Redirect only when the record is added successfully
                        echo "<script>window.onload = function() { openModal(); }</script>";
                    } else {
                        $resultMessage = "Error: " . mysqli_error($conn);
                    }
                } else {
                    $resultMessage = "Error retrieving geolocation data.";
                }
            } else {
                $resultMessage = "Error uploading image";
            }
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
