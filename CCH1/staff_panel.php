<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: staff_login.php");
    exit();
}

$user = $_SESSION['user'];
$role = $_SESSION['role'];

include('connection.php');

// fetch doctors and physicians for select dropdown
$sqlDoctors = "SELECT staff_id, name, specialty FROM medical_staff WHERE role = 'Doctor' ORDER BY name"; 
$resultDoctors = mysqli_query($connection, $sqlDoctors);

$sqlPhysicians = "SELECT staff_id, name, specialty FROM medical_staff WHERE role = 'Physician' ORDER BY name"; 
$resultPhysicians = mysqli_query($connection, $sqlPhysicians);

// get appointments
// using apppointments table, you select columns from that 
//then do a join so that medical staff staff id matches with appointments doc id to fetch details related to that doctor
$appointmentQuery = "SELECT a.booking_id, a.patient_name, a.patient_email, a.patient_contact, 
                            m.name AS doctor_name, a.appointment_time, a.appointment_date, a.appointment_status 
                     FROM appointments a 
                     JOIN medical_staff m ON a.doctor_id = m.staff_id";
$appointments = mysqli_query($connection, $appointmentQuery);


// registrations
// using case condition to check whcih registrations have bene paid for online
// fetching test name using test id from tests
// and checking if registraion id is present in online payments table
$registrationQuery = "SELECT r.registration_id, r.patient_name, r.patient_email, r.patient_contact,
                             t.name, 
                             CASE 
                                 WHEN op.registration_id IS NOT NULL THEN 'PAID ONLINE'
                                 ELSE 'NOT PAID'
                             END AS payment_status
                      FROM registrations r
                      LEFT JOIN tests t ON r.test_id = t.test_id
                      LEFT JOIN online_payments op ON r.registration_id = op.registration_id";
$registrations = mysqli_query($connection, $registrationQuery);

// counting staff based on shift schedule
$staffSchedule = "SELECT COUNT(*) AS count FROM medical_staff WHERE shift_schedule = '9:00 AM - 5:00 PM'";
$availableStaff = $connection->query($staffSchedule);
$staffCount = $availableStaff->fetch_assoc()['count'];  

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospital - Staff Panel</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="cch_script.js"></script>
</head>
<body class="panel-body">
   
    <div class="menu-bar">
        <h2>Menu</h2>
        <ul>
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#dashboard">Appointments</a></li>
            <li><a href="#registrations">Registrations</a></li>
            <!-- only receptionists role can set max appointments -->
            <?php if ($role === 'Receptionist') { ?>
            <li><a href="#setAppointments">Set Max Appointments</a></li>
            <?php } ?>
            <li><a href="staff_logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div id="dashboard">
            <div class="panel-bar">
                <h2>Welcome, <?php echo htmlspecialchars($user); ?></h2>
                <div class="profile">
                    <img src="resources/profile_icon.png" alt="Profile">
                </div>
            </div>

            <div class="cards">
            <div class="card"><h3>Appointments</h3>
            <p><?php echo mysqli_num_rows($appointments); ?></p></div>
            <div class="card"><h3>Test / Scan Registrations</h3>
            <p><?php echo mysqli_num_rows($registrations); ?></p></div>
            <div class="card"><h3>Staff Availability</h3>
            <?php echo $staffCount;?></div>
           
</div>


        <hr>
     <!-- appointments management  -->
     <div id="appointments">
    <h2>View Appointments</h2>
    <table class="appointment-table">
        <tr>
            <th>Appointment ID</th>
            <th>Patient Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Doctor</th>
            <th>Time</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($appointments)) { ?>
        <tr>
        <td><?php echo $row['booking_id']; ?></td>
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['patient_email']; ?></td>
            <td><?php echo $row['patient_contact']; ?></td>
            <td><?php echo $row['doctor_name']; ?></td>
            <td><?php echo $row['appointment_time']; ?></td>
            <td><?php echo $row['appointment_date']; ?></td>
            <!-- status is turned to lowercase, to check which class it matches with -->
            <td class="status-<?php echo strtolower($row['appointment_status']); ?>">  
                <?php echo $row['appointment_status']; ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<hr>
 <!-- appointments management  -->
 <div id="registrations">
    <h2>View Registrations</h2>
    
    <table class="appointment-table">
    <tr>
        <th>Registration ID</th>
        <th>Patient Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Test Name</th>
        <th>Payment Status</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($registrations)) { ?>
        <tr>
            <td><?php echo $row['registration_id']; ?></td>
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['patient_email']; ?></td>
            <td><?php echo $row['patient_contact']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['payment_status']; ?></td>
        </tr>
    <?php } ?>
</table>
    </div>
    <hr>

        <!-- Set Maximum Appointments Section -->
        <?php if ($role === 'Receptionist') { ?>
        <div id="setAppointments" class="max-appointments-form">
            <h2>Set Maximum Appointments per Day</h2>
            <form action="doctor_appointments_limit.php" method="POST">
                <label for="doctor_id">Select Doctor:</label>
                <select name="doctor_id" required>
                    <optgroup label="Doctors">
                    <?php while ($row = mysqli_fetch_assoc($resultDoctors)) { ?>
                        <option value="<?php echo htmlspecialchars($row['staff_id']); ?>">
                            Dr. <?php echo htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['specialty']); ?>
                        </option>
                    <?php } ?>
                    </optgroup>

                    <optgroup label="Physicians">
                    <?php while ($row = mysqli_fetch_assoc($resultPhysicians)) { ?>
                        <option value="<?php echo htmlspecialchars($row['staff_id']); ?>">
                            Dr. <?php echo htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['specialty']); ?>
                        </option>
                    <?php } ?>
                    </optgroup>
                </select>

                <label for="max_appointments">Maximum Appointments:</label>
                <input type="string" name="max_appointments" required>

                <button type="submit" name="setLimits">Set Limits</button>
            </form>
        </div>
        <?php } ?>

    </div>
</body>
</html>

