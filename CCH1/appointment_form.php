<?php
session_start();
include 'connection.php';
?>
<!-- 
 form to book an appointment  -->
<!DOCTYPE html>
<html>
<head>
    <title>Book an Appointment</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="cch_script.js"></script>
    <script src="validation_script.js"></script>
</head>
<body>
<div class="appointment-container">
    <h2>Book an Appointment</h2>
    <div class="discount-banner">
    Make an appointment online and save Rs 300/=
</div>

<!-- checks field and ensures valid data, on submit button -->
<form name="appointmentForm" action="book_appointment.php" method="POST" onsubmit="return validateAppointmentForm();">
    <label for="patient_name">Name:</label>
    <input type="text" name="patient_name">
    <span id="name_err" class="error"></span>

    <label for="contact_number">Contact Number:</label>
    <input type="text" name="patient_contact">
    <span id="contact_err" class="error"></span>

    <label for="email">Email:</label>
    <input type="text" name="email">
    <span id="email_err" class="error"></span>

    <label for="doctor">Which Doctor would you like to have a consultation with?</label>
    <select name="doctor_id">
        <option value="Select">Select Doctor</option>
        <optgroup label="Doctors">
        <?php 
        $sql = "SELECT staff_id, name, specialty FROM medical_staff WHERE role = 'Doctor' ORDER BY name"; 
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . htmlspecialchars($row['staff_id']) . "'>Dr. " . htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['specialty']) . "</option>";
        }
        ?> 

<optgroup label="Physicians">
            <?php
            $sql = "SELECT name, specialty FROM medical_staff WHERE role = 'Physician' ORDER BY name";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $displayPhysician = "Dr. " . $row['name'];
                echo "<option value='" . $row['name'] . "'> " . $displayPhysician . " - " . $row['specialty'] . "</option>";
            }
            ?>
        </optgroup>
    </select>
    <span id="doctor_err" class="error"></span>

    <label for="appointment_date">Choose the date of your appointment:</label>
    <input type="date" id="appointment_date" name="appointment_date">
    <span id="date_err" class="error"></span>

    <label for="appointment_time">What time slot would you prefer?</label>
    <select name="appointment_time">
        <option value="select">Select Time</option>
        <option value="08:30 AM">08:30 AM</option>
        <option value="10:00 AM">10:00 AM</option>
        <option value="11:20 AM">11:20 AM</option>
        <option value="01:00 PM">01:00 PM</option>
        <option value="02:30 PM">02:30 PM</option>
        <option value="04:00 PM">04:00 PM</option>
        <option value="05:40 PM">05:40 PM</option>
    </select>
    <span id="time_err" class="error"></span>

    <button type="submit" name="bookAppointment">Book Now</button>
</form>

            </div>
</body>
</html>
