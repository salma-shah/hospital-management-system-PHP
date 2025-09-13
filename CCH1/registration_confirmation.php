<?php
session_start();
include 'connection.php';
// debugging
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

 // check if reg ID is set in the session
 if (isset($_SESSION['registration_id'])) {
    $registration_id = $_SESSION['registration_id']; }

if ($registration_id) {
    // fetch details based on the reg ID
    $query = "SELECT * FROM registrations WHERE registration_id = '$registration_id'";
    $result = mysqli_query($connection, $query);
    $registration = mysqli_fetch_assoc($result);

    // Check if it exists
    if ($registration) {
        $patient_name = $registration['patient_name'];
        $patient_email = $registration['patient_email'];
        $patient_contact = $registration['patient_contact'];
        $test_id = $registration['test_id'];
        $registration_date = $registration['registration_date'];
        $appointment_status = $registration['status'];
        $total_cost = $registration['total_cost'];
     
// fetching test's name
    $sqlGetTestName = "SELECT name FROM tests WHERE test_id = '$test_id'";
    $testResult = mysqli_query($connection, $sqlGetTestName);
    
    if ($testRow = mysqli_fetch_assoc($testResult)) {
        $test_name = $testRow['name']; // test's name fetched from database using id so test name will be displayed
    } else {
        $test_name = "There is no such test"; 
    }

    } else {
        echo "No registration found with that Registration ID.";
        exit;  // exit and terminate script
    }
} else {
    echo "Registration ID is missing."; // this ensures confirmation form CANNOT be viewed, unless registration is made
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"> <!-- External stylesheet -->
</head>
<body>
<div class="confirmation-container">
    <h2>Registration Confirmation</h2>
    <!-- displaying details -->
    <p style="font-size: larger;">Please take a screenshot or download this form as proof of your online registration to show at the hospital.</p>
    <p><strong>Registration ID:</strong> <?php echo htmlspecialchars($registration_id); ?></p>
    <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($patient_name); ?></p>
    <p><strong>Patient Email:</strong> <?php echo htmlspecialchars($patient_email); ?></p>
    <p><strong>Patient Contact:</strong> <?php echo htmlspecialchars($patient_contact); ?></p>
    <p><strong>Test:</strong> <?php echo htmlspecialchars($test_name); ?></p>
    <p><strong>Date:</strong> <?php echo htmlspecialchars($registration_date); ?></p>
    <p><strong>Total Price:</strong> <?php echo htmlspecialchars($total_cost); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($appointment_status); ?></p>
    <button onclick="window.location.href='home.php'">Return to Home</button>
    <button class="image-button">&#x2193;      Download File</button>
    <p style="font-size: larger;">If you wish to pay online:</p>
    <button class="image-button" name="payOnline" onclick="window.location.href='online_payment_form.php'">&#x1F4B3;     Pay Online.</button>
    <!-- go to payment form -->
</div>

</body>
</html>
