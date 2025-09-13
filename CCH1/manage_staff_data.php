
<script src="cch_script.js"></script>
<?php
session_start();
include 'connection.php';

// add new staff to the database
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $specialty = $_POST['specialty'];
    $qualifications = $_POST['qualifications'];
    $shift_schedule = $_POST['shift_schedule'];
    
    $result= $connection->query("INSERT INTO medical_staff (name, email, contact_number, role, department, specialty, qualifications, shift_schedule) VALUES ('$name', '$email', '$contact_number', '$role', '$department', '$specialty', '$qualifications', '$shift_schedule')");

    if (!$result){
        die ('Could not enter data: '. mysqli_error($connection));
    }
    else {
        echo "<script>displaySuccessfulAddingStaffMessage(); window.location.href='admin_panel.php';</script>";
    }

}

// update existing staff details
if (isset($_POST['update'])) {
    $staff_id = $_POST['staff_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $specialty = $_POST['specialty'];
    $qualifications = $_POST['qualifications'];
    $shift_schedule = $_POST['shift_schedule'];
    
    $result= $connection->query("UPDATE medical_staff SET name='$name', email='$email', contact_number='$contact_number', role='$role', department='$department', specialty='$specialty', qualifications='$qualifications', shift_schedule='$shift_schedule' WHERE staff_id=$staff_id");
    if (!$result){
        die ('Could not enter data: '. mysqli_error($connection));
    }
    else {
        echo "<script>displaySuccessfulStaffUpdateMessage(); window.location.href='admin_panel.php';</script>";
    }
    
}
// deleting staff member
if (isset($_GET['delete'])) {
    $staff_id = $_GET['delete'];
    $sql = "DELETE FROM medical_staff WHERE staff_id = '$staff_id'";
     // delete staff id and its details from table
    mysqli_query($connection, $sql);
    header("location: admin_panel.php"); // Redirect after deletion
    exit();
}

?>