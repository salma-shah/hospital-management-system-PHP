<?php
session_start();
include 'connection.php';

 // Check if booking ID is set in the session
 if (isset($_SESSION['booking_id'])) {
    $booking_id = $_SESSION['booking_id']; }

if ($booking_id) {
    // fetch appointment details based on the booking ID
    $query = "SELECT * FROM appointments WHERE booking_id = '$booking_id'";
    $result = mysqli_query($connection, $query);
    $appointment = mysqli_fetch_assoc($result);

    // Check if appointment exists
    if ($appointment) {
        $patient_name = $appointment['patient_name'];
        $patient_email = $appointment['patient_email'];
        $patient_contact = $appointment['patient_contact'];
        $doctor_id = $appointment['doctor_id'];
        $appointment_time = $appointment['appointment_time'];
        $appointment_date = $appointment['appointment_date'];
        $appointment_status = $appointment['appointment_status'];

        // check where doctor id in appointments table matches staff id in medical stafff table
    $sqlGetDoctorName = "SELECT name FROM medical_staff WHERE staff_id = '$doctor_id'";
    $doctorResult = mysqli_query($connection, $sqlGetDoctorName);
    
    if ($doctorRow = mysqli_fetch_assoc($doctorResult)) {
        $doctor_name = $doctorRow['name']; // doctor's name fetched from database using id so doctor name will be displayed
    } else {
        $doctor_name = "Unknown Doctor"; 
    }

    } else {
        // if appointment is not found
        echo "<script>alert('No appointment found with that booking ID.');</script>";
        exit;
    }
} else {
    echo "<script>alert('Booking ID is missing.');</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"> <!-- External stylesheet -->
</head>
<body>
<div class="confirmation-container">
    <h2>Appointment Confirmation</h2>
    <!-- displaying details -->
    <p style="font-size: larger;">Please take a screenshot or download this form for confirmation of your appointment.</p>
    <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking_id); ?></p>
    <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($patient_name); ?></p>
    <p><strong>Patient Email:</strong> <?php echo htmlspecialchars($patient_email); ?></p>
    <p><strong>Patient Contact:</strong> <?php echo htmlspecialchars($patient_contact); ?></p>
    <p><strong>Doctor:</strong> <?php echo htmlspecialchars($doctor_name); ?></p>
    <p><strong>Appointment Time:</strong> <?php echo htmlspecialchars($appointment_time); ?></p>
    <p><strong>Appointment Date:</strong> <?php echo htmlspecialchars($appointment_date); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($appointment_status); ?></p>
    <button onclick="window.location.href='home.php'">Return to Home</button>
    <button class="download-button">&#x2193;      Download File</button>
</div>

</body>
</html>
