
<?php
session_start();
include 'connection.php';

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}


if (isset($_POST['bookAppointment'])) {

 // get details from the form once button is clicked
    $patient_name = $_POST['patient_name'];
    $patient_contact = $_POST['patient_contact'];
    $patient_email = $_POST['email'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $currentTimestamp = date('Y-m-d-His'); // Format: YYYYMMDDHHMMSS
    $new_booking_id = $currentTimestamp; 

    //count number of appointments the doctor has
    $sql = "SELECT COUNT(*) as appointment_count FROM appointments WHERE doctor_id = '$doctor_id' AND appointment_date = '$appointment_date'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    //  see the doctor's maximum number of appointments for the day
    $sqlMax = "SELECT max_appointments FROM appointment_limit WHERE doctor_id = '$doctor_id'";
    $maxResult = mysqli_query($connection, $sqlMax);
    $maxRow = mysqli_fetch_assoc($maxResult);
    
    // if max limit is not met yet, then appointment will be successful
    if ($row['appointment_count'] < $maxRow['max_appointments']) {
        $insertSql = "INSERT INTO appointments (booking_id, patient_name, patient_contact, patient_email, doctor_id, appointment_time, appointment_date, appointment_status) 
                      VALUES ('$new_booking_id', '$patient_name', '$patient_contact', '$patient_email', '$doctor_id', '$appointment_time', '$appointment_date', 'Approved')";
                                   
    // successfully booked then change appointment status to Approved
        if (mysqli_query($connection, $insertSql)) {
            $_SESSION['booking_id'] = $new_booking_id;
            echo "<script>
           
                    alert('Appointment booked successfully. Your Booking ID is: $new_booking_id');
                    window.location.href = 'appointment_confirmation.php?booking_id=$new_booking_id';
                  </script>";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        echo "<script>
                alert('Your appointment was not booked because all the available slots are taken.');
                window.location.href = 'home.php';
              </script>";
    }
}

mysqli_close($connection);
?>

