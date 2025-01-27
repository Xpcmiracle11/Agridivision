<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include 'setupdb.php';

// Check if the user is logged in
if (!isset($_SESSION['brgy_tech_id'])) {
    header('Location: login.php');
    exit();
}

// If the user is logged in, include the dashboard page
include 'techreg.html';
$brgy_tech_id = $_SESSION['brgy_tech_id'];


$resultMessage = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if form is submitted
if (isset($_POST['rsbsanum'])) {
    $rsbsanum = $_POST['rsbsanum'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $extension = $_POST['extension'];
    $gender = $_POST['gender'];
    $house = $_POST['house'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $religion = $_POST['religion'];
    $civil_status = $_POST['civil_status'];
    $mother_lname = $_POST['mother_lname'];
    $mother_fname = $_POST['mother_fname'];
    $mother_mname = $_POST['mother_mname'];
    $household_head = $_POST['household_head'];
    $household_head_name = $_POST['household_head_name'];
    $relationship = $_POST['relationship'];
    $household_members = $_POST['household_members'];
    $household_male = $_POST['household_male'];
    $household_female = $_POST['household_female'];
    $education = $_POST['education'];
    $disability = $_POST['disability'];
    $beneficiary = $_POST['beneficiary'];
    $indigenous = $_POST['indigenous']; 
    $indigenous_group = $_POST['indigenous_group'];
    $government_id = $_POST['government_id'];
    $id_type = $_POST['id_type'];
    $id_number = $_POST['id_number'];
    $farmer_association = $_POST['farmer_association'];
    $association_name = $_POST['association_name'];
    $contact_person = $_POST['contact_person'];
    $contact_person_phone = $_POST['contact_person_phone'];
    //Password
    $fnameLetters = substr($fname, 0, 3);
    $lnameLetters = substr($lname, 0, 3);
    $dobWithoutDashes = str_replace('-', '', $dob);
    $dobLetters = substr($dobWithoutDashes, 0, 3);
    $password = $fnameLetters . $lnameLetters . $dobLetters;
    //
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    //Commodity
    $farm_area = $_POST['farm_area'];
    $ancestral_domain = $_POST['ancestral_domain'];
    $farm_document_no = $_POST['farm_document_no'];
    $agrarian_beneficiary = $_POST['agrarian_beneficiary'];
    $ownership_type = $_POST['ownership_type'];
    $commodity_id = $_POST['commodity_id'];
    $commodity_name = $_POST['commodity_name'];
    $farm_type = $_POST['farm_type'];


    $date = date('Y-m-d');
    // Sanitize user inputs to prevent SQL injection
    $rsbsanum = mysqli_real_escape_string($conn, trim($rsbsanum));
    $lname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($lname))));
    $fname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($fname))));
    $mname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($mname))));
    $extension = mysqli_real_escape_string($conn, trim(ucwords(strtolower($extension))));
    $gender = mysqli_real_escape_string($conn, trim(ucwords(strtolower($gender))));
    $house = mysqli_real_escape_string($conn, trim(ucwords(strtolower($house))));
    $street = mysqli_real_escape_string($conn, trim(ucwords(strtolower($street))));
    $barangay = mysqli_real_escape_string($conn, trim(ucwords(strtolower($barangay))));
    $province = mysqli_real_escape_string($conn, trim(ucwords(strtolower($province))));
    $municipality = mysqli_real_escape_string($conn, trim(ucwords(strtolower($municipality))));
    $phone = mysqli_real_escape_string($conn, trim($phone));
    $email = mysqli_real_escape_string($conn, trim(strtolower($email)));
    $dob = mysqli_real_escape_string($conn, trim($dob));
    $religion = mysqli_real_escape_string($conn, trim(ucwords(strtolower($religion))));
    $civil_status = mysqli_real_escape_string($conn, trim(ucwords(strtolower($civil_status))));
    $mother_lname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($mother_lname))));
    $mother_fname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($mother_fname))));
    $mother_mname = mysqli_real_escape_string($conn, trim(ucwords(strtolower($mother_mname))));
    $household_head = mysqli_real_escape_string($conn, trim(ucwords(strtolower($household_head))));
    $relationship = mysqli_real_escape_string($conn, trim(ucwords(strtolower($relationship))));
    $household_members = mysqli_real_escape_string($conn, trim($household_members));
    $household_male = mysqli_real_escape_string($conn, trim($household_male));
    $household_female = mysqli_real_escape_string($conn, trim($household_female));
    $education = mysqli_real_escape_string($conn, trim(ucwords(strtolower($education))));
    $disability = mysqli_real_escape_string($conn, trim(ucwords(strtolower($disability))));
    $beneficiary = mysqli_real_escape_string($conn, trim(ucwords(strtolower($beneficiary))));
    $indigenous = mysqli_real_escape_string($conn, trim(ucwords(strtolower($indigenous))));
    $indigenous_group = mysqli_real_escape_string($conn, trim(ucwords(strtolower($indigenous_group))));
    $government_id = mysqli_real_escape_string($conn, trim(ucwords(strtolower($government_id))));
    $id_type = mysqli_real_escape_string($conn, trim(ucwords(strtolower($id_type))));
    $id_number = mysqli_real_escape_string($conn, trim($id_number));
    $farmer_association = mysqli_real_escape_string($conn, trim(ucwords(strtolower($farmer_association))));
    $association_name = mysqli_real_escape_string($conn, trim(ucwords(strtolower($association_name))));
    $contact_person = mysqli_real_escape_string($conn, trim(ucwords(strtolower($contact_person))));
    $contact_person_phone = mysqli_real_escape_string($conn, trim($contact_person_phone));
    $password = mysqli_real_escape_string($conn, trim($password));
    $latitude = mysqli_real_escape_string($conn, trim($latitude));
    $longitude = mysqli_real_escape_string($conn, trim($longitude));
    //Commodity
    $farm_area = mysqli_real_escape_string($conn, trim($farm_area));
    $ancestral_domain = mysqli_real_escape_string($conn, trim($ancestral_domain));
    $farm_document_no = mysqli_real_escape_string($conn, trim($farm_document_no));
    $agrarian_beneficiary = mysqli_real_escape_string($conn, trim($agrarian_beneficiary));
    $ownership_type = mysqli_real_escape_string($conn, trim($ownership_type));
    $commodity_id = mysqli_real_escape_string($conn, trim($commodity_id));
    $commodity_name = mysqli_real_escape_string($conn, trim($commodity_name));
    $farm_type = mysqli_real_escape_string($conn, trim(ucwords(strtolower($farm_type))));


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

    // Check if email already exists in business_owner table
    $checkBusinessOwnerSql = "SELECT * FROM business_owner WHERE email = '$email'";
    $checkBusinessOwnerResult = mysqli_query($conn, $checkBusinessOwnerSql);

    // Check if email exists in any of the tables
    if (mysqli_num_rows($checkAdminResult) > 0 ||
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
                $sql = "INSERT INTO farmer (brgy_tech_id, rsbsanum, lname, fname, mname, extension, gender, house, street, barangay, province, municipality, phone, email, dob,
                    religion, civil_status, mother_lname, mother_fname, mother_mname, household_head, household_head_name, relationship, household_members, 
                    household_male, household_female, education, disability, beneficiary, indigenous, indigenous_group, government_id, id_type, id_number, 
                    farmer_association, association_name, contact_person, contact_person_phone, password, regdate, latitude, longitude)
                    VALUES ('$brgy_tech_id', '$rsbsanum', '$lname', '$fname', '$mname', '$extension', '$gender', '$house', '$street', '$barangay', '$province', '$municipality', '$phone', '$email', '$dob', 
                    '$religion', '$civil_status', '$mother_lname', '$mother_fname', '$mother_mname', '$household_head', '$household_head_name', '$relationship', '$household_members', 
                    '$household_male', '$household_female', '$education', '$disability', '$beneficiary', '$indigenous', '$indigenous_group', '$government_id', '$id_type', '$id_number', 
                    '$farmer_association', '$association_name', '$contact_person', '$contact_person_phone', '$password', '$date', '$latitude', '$longitude')";
            
                if (mysqli_query($conn, $sql)) {
                    // Get the last inserted ID
                    $last_id = mysqli_insert_id($conn);
            
                    // Construct the farmer_id with the "FM" prefix
                    $farmer_id = "FM" . $last_id;
            
                    // Update the record with the constructed farmer_id
                    $updateSql = "UPDATE farmer SET farmer_id='$farmer_id' WHERE id=$last_id";
                    mysqli_query($conn, $updateSql);
            
                    // Variables for the second insert
                    $farm_id = "F" . $last_id; // Assuming you want to construct farm_id in a similar way
            
                    // Second insert into the farm table
                    $sqlFarmer = "INSERT INTO farm(farm_id, farmer_id, farm_area, ancestral_domain, farm_document_no, agrarian_beneficiary,
                        ownership_type, commodity_id, commodity_name, farm_type) VALUES ('$farm_id','$farmer_id', '$farm_area', '$ancestral_domain',
                        '$farm_document_no', '$agrarian_beneficiary', '$ownership_type', '$commodity_id', '$commodity_name', '$farm_type')";
            
                    if (mysqli_query($conn, $sqlFarmer)) {
                        $resultMessage = "New record added successfully";
                        echo "<script>window.onload = function() { openModal(); }</script>";
                        // Redirect or display success message as needed
                    } else {
                        $resultMessage = "Error in second insert: " . mysqli_error($conn);
                    }
                } else {
                    $resultMessage = "Error in first insert: " . mysqli_error($conn);
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
            location.replace("techtable.php");
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Get a reference to the form element
        var registrationForm = document.getElementById("registrationForm");

        // Call the openModal function when the page loads, only if there is a valid submission
        <?php if (!empty($resultMessage)) { ?>
            openModal();
        <?php } ?>
    });
</script>
