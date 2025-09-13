<?php
include 'connection.php';

// check if form was submitted by checking for button clicks
if (isset($_POST['setLimits'])) {
    // retrieve posted values from form
    $doctor_id = $_POST['doctor_id'];
    $max_appointments = $_POST['max_appointments'];

    // check if doctor already has an entry in the appointment_limit table
    $sqlCheck = "SELECT * FROM appointment_limit WHERE doctor_id = '$doctor_id'";
    $resultCheck = mysqli_query($connection, $sqlCheck);

    if (!$resultCheck) {
        die("Query failed: " . mysqli_error($connection)); // debugging output if there is a query error
    }

    if (mysqli_num_rows($resultCheck) > 0) {
        // since there is a limit, we can just update the existing one
        $updateSql = "UPDATE appointment_limit 
                      SET max_appointments = $max_appointments 
                      WHERE doctor_id = '$doctor_id'";
        
        if (mysqli_query($connection, $updateSql)) {
            echo "<script>alert('Maximum appointments updated successfully.'); window.location.href='staff_panel.php';</script>";

        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        // insert new entry if it is not set already
        $insertSql = "INSERT INTO appointment_limit (doctor_id, max_appointments) 
                      VALUES ('$doctor_id', '$max_appointments')";

        if (mysqli_query($connection, $insertSql)) {
            echo "<script>alert('Maximum appointments set successfully.'); window.location.href='staff_panel.php';</script>";

        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
}

// close the database connection to free memory
mysqli_close($connection);
?>


