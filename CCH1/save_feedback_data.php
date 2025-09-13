<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <script src="cch_script.js"></script> 
</head>
<body>

<?php

include 'connection.php';

// take values from form, insert it into variables
if (isset($_POST['submitFeedback'])) {
$feedbackName = $_POST ['feedbackName'];
$feedbackEmail = $_POST ['feedbackEmail'];
$feedbackContactNumber = $_POST ['feedbackContactNumber'];
$feedbackSatisfaction = $_POST ['feedbackSatisfaction'];
$docName = $_POST ['docName'];
$consultantDoctor = $_POST ['consultantDoctor'];
$pharmacy = $_POST ['pharmacy'];
$medsAndCare = $_POST ['medsAndCare'];
$appointment = $_POST ['appointment'];
$onlineRegister = $_POST ['onlineRegister'];
$suggestions = $_POST ['suggestions'];
$review = $_POST ['review'];

// insert those variables into the table
$sql = "INSERT INTO patient_feedback "." (name, email, contact_number, satisfaction, consultant_doctor, doctor_rating, pharmacy_rating, meds_rating, appointment_rating, online_registration_rating, review, suggestion ) "."VALUES ('$feedbackName','$feedbackEmail', '$feedbackContactNumber', '$feedbackSatisfaction', '$docName', '$consultantDoctor', '$pharmacy', '$medsAndCare', '$appointment', '$onlineRegister', '$review', '$suggestions')";
$result = mysqli_query($connection, $sql);

if (!$result){
    die ('Could not enter data: '. mysqli_error($connection));
}
else {
    echo "<script>displayThankYouFeedbackMessage(); window.location.href='contact.php';</script>";
}
}

mysqli_close($connection);
?>

</body>
</html>