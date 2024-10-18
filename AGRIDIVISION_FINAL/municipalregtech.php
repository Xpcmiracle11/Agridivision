<?php
// Start or resume a session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Include database setup
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include the HTML template for the municipal technician registration form
include 'municipalregtech.html';

$municipal_agriculturist_id = $_SESSION['user_id'];
// Variable to store result messages
$resultMessage = "";

// Function to get latitude and longitude from address using Google Maps Geocoding API
function getLatLong($address, $apiKey) {
    $address = urlencode($address);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";

    $response = file_get_contents($url);
    $data = json_decode($response);

    if ($data->status == 'OK') {
        $lat = $data->results[0]->geometry->location->lat;
        $long = $data->results[0]->geometry->location->lng;
        return ['latitude' => $lat, 'longitude' => $long];
    } else {
        return false;
    }
}

// Check if form is submitted
if (isset($_POST['fname'])) {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $num = $_POST['number'];
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
    $prov = mysqli_real_escape_string($conn, trim(ucwords(strtolower($prov))));
    $mun = mysqli_real_escape_string($conn, trim(ucwords(strtolower($mun))));
    $brgy = mysqli_real_escape_string($conn, trim(ucwords(strtolower($brgy))));
    $street = mysqli_real_escape_string($conn, trim($street)); 
    $zip = mysqli_real_escape_string($conn, trim($zip));
    $dob = mysqli_real_escape_string($conn, trim($dob));
    $password = mysqli_real_escape_string($conn, trim($password));
    $repass = mysqli_real_escape_string($conn, trim($repass));
    $date = date('Y-m-d');

    // Check if password and repeat password match
    if ($password != $repass) {
        $resultMessage = "Password and repeat password do not match!";
    } else {
        // Include your Google Maps API key here
        $googleMapsApiKey = 'AIzaSyCiiex_ePOjgHWwIDfiGxYqnYow6by0wAw';

        // Get latitude and longitude based on the address components
        $address = "{$brgy}, {$mun}, {$prov}, {$street}, {$zip}";
        $coordinates = getLatLong($address, $googleMapsApiKey);

        if ($coordinates) {
            $latitude = $coordinates['latitude'];
            $longitude = $coordinates['longitude'];

            // Generate the new image name using the specified format
            $newImageName = ucfirst(substr($fname, 0, 3)) . ucfirst(substr($lname, 0, 3)) . str_replace('-', '', $dob);

            // Set the destination path for the image, including the file extension
            $destinationPath = "C:/xampp/htdocs/AGRIDIVISION_FINAL/assets/img/brgy_tech/" . $newImageName . ".jpg";

            // Move the uploaded image to the destination path
            if (move_uploaded_file($_FILES['profileimg']['tmp_name'], $destinationPath)) {
                // Add new user to the database with the new image name (without extension)
                $sql = "INSERT INTO brgy_tech (municipal_agriculturist_id, fname, lname, email, num, prov, mun, brgy, street, zip, dob, password, profileimg, regdate, latitude, longitude)"
                    . " VALUES ('$municipal_agriculturist_id', '$fname', '$lname', '$email', '$num', '$prov', '$mun', '$brgy', '$street', '$zip', '$dob', '$password', '$newImageName', '$date', '$latitude', '$longitude')";

                if (mysqli_query($conn, $sql)) {
                    $resultMessage = "New record added successfully";
                    // Redirect only when the record is added successfully
                    echo "<script>window.onload = function() { openModal(); }</script>";
                } else {
                    $resultMessage = "Error: " . mysqli_error($conn);
                }
            } else {
                $resultMessage = "Error uploading image";
            }
        } else {
            $resultMessage = "Error getting latitude and longitude from address.";
        }
    }    
}

// Close the database connection
mysqli_close($conn);
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
            location.replace("municipaltables.php");
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
