<?php
session_start();
include 'connection.php';
?>
<!-- form to register for a service  -->
<!DOCTYPE html>
<html>
<head>
    <title>Service Registration</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="cch_script.js"></script>
    <script src="validation_script.js"></script>
</head>
<body>
<div class="appointment-container">
    <h2>Register for a medical test/scan</h2>

    <form name="registerForm" action="register_service.php" method="POST" onsubmit="return validateRegForm();">
    <label for="patient_name">Name:</label>
    <input type="text" name="patient_name" required>
    <span id="name_err" class="error"></span>

    <label for="contact_number">Contact Number:</label>
    <input type="text" name="patient_contact" required>
    <span id="contact_err" class="error"></span>

    <label for="patient_email">Email:</label>
    <input type="text" name="patient_email" required>
    <span id="email_err" class="error"></span>

    <label for="test">Which service do you want to register for?</label>
    <select name="test_id" required>
        <option value="" selected disabled>Select a Test</option>
        <?php 
        $sql = "SELECT test_id, name FROM tests ORDER BY name"; 
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . htmlspecialchars($row['test_id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
        }
        ?>
    </select>
    <span id="test_err" class="error"></span>

    <label for="registration_date">Choose the date of your appointment:</label>
    <input type="date" id="registration_date" name="registration_date" required>
    <span id="date_err" class="error"></span>

    <button type="submit" name="registerOnline">Register Now</button>
</form>

            </div>
</body>
</html>

