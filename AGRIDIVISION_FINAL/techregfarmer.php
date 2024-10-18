<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include 'setupdb.php';
include 'techregfarmer.html';

$brgy_tech_id = $_SESSION['user_id'];

// Initialize the result message
$resultMessage = "";

if (isset($_POST['fname'])) {
    // Sanitize user inputs to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, ucwords(strtolower(trim($_POST['fname']))));
    $lname = mysqli_real_escape_string($conn, ucwords(strtolower(trim($_POST['lname']))));
    $email = mysqli_real_escape_string($conn, strtolower(trim($_POST['email'])));
    $num = mysqli_real_escape_string($conn, trim($_POST['number']));
    $rsbsa = mysqli_real_escape_string($conn, trim($_POST['rsbsa']));
    $crop = mysqli_real_escape_string($conn, trim($_POST['crop']));
    $prov = mysqli_real_escape_string($conn, ucwords(strtolower(trim($_POST['province']))));
    $mun = mysqli_real_escape_string($conn, ucwords(strtolower(trim($_POST['municipality']))));
    $brgy = mysqli_real_escape_string($conn, ucwords(strtolower(trim($_POST['brgy']))));
    $street = mysqli_real_escape_string($conn, ucwords(strtolower(trim($_POST['street']))));
    $zip = mysqli_real_escape_string($conn, trim($_POST['zip']));
    $dob = mysqli_real_escape_string($conn, trim($_POST['birthdate']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $repass = mysqli_real_escape_string($conn, trim($_POST['repass']));
    $date = date('Y-m-d');

    // Check if password and repeat password match
    if ($password != $repass) {
        $resultMessage = "Password and repeat password do not match!";
    } else {
        // Define allowed image formats
        $allowedFormats = ['jpg'];
        $imageFileType = strtolower(pathinfo($_FILES['profileimg']['name'], PATHINFO_EXTENSION));

        // Check if the uploaded image format is allowed
        if (!in_array($imageFileType, $allowedFormats)) {
            $resultMessage = "Only JPG formats are allowed.";
        } else {
            // Generate a unique image name based on user data
            $newImageName = ucfirst(substr($fname, 0, 3)) . ucfirst(substr($lname, 0, 3)) . str_replace('-', '', $dob);

            // Set the destination path for the image, including the file extension
            $destinationPath = "C:/xampp/htdocs/AGRIDIVISION_FINAL/assets/img/farmer/" . $newImageName . ".jpg";

            // Move the uploaded image to the destination path
            if (move_uploaded_file($_FILES['profileimg']['tmp_name'], $destinationPath)) {
                // Geocode the user address using Google Maps API
                $address = urlencode("$prov, $mun, $brgy, $street, $zip");
                $geocodeUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyBb3onzuJdhZOXXNIzC73XDXolEBNTujks";
                $response = file_get_contents($geocodeUrl);
                $data = json_decode($response);

                if ($data->status === "OK") {
                    $latitude = $data->results[0]->geometry->location->lat;
                    $longitude = $data->results[0]->geometry->location->lng;

                    // Insert user data into the database
                    $sql = "INSERT INTO farmer (brgy_tech_id, fname, lname, email, num, rsbsanum, crop, prov, mun, brgy, street, zip, dob, password, profileimg, regdate, longitude, latitude)"
                        . " VALUES ('$brgy_tech_id', '$fname', '$lname', '$email', '$num', '$rsbsa', '$crop', '$prov', '$mun', '$brgy', '$street', '$zip', '$dob', '$password', '$newImageName', '$date', '$longitude', '$latitude')";

                    if (mysqli_query($conn, $sql)) {
                        $resultMessage = "New record added successfully";
                        // Redirect or display success message as needed
                    } else {
                        $resultMessage = "Error: " . mysqli_error($conn);
                    }
                } else {
                    $resultMessage = "Error: Unable to geocode the address.";
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
            location.replace("techtables.php");
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
