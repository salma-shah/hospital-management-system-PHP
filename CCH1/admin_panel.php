<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: staff_login.php");
    exit();
}

$user = $_SESSION['user'];
include('connection.php');

$search = '';
$sql = "SELECT * FROM medical_staff ORDER BY staff_id ASC";
$result = mysqli_query($connection, $sql);

$staff = [];
while ($row = mysqli_fetch_assoc($result)) {
    $staff[] = $row;
}


// appointments
// using apppointments table, you select columns from that 
// then do a join so that medical staff staff id matches with appointments doc id to fetch details related to that doctor
$appointmentQuery = "SELECT a.booking_id, a.patient_name, a.patient_email, a.patient_contact, 
                            m.name AS doctor_name, a.appointment_time, a.appointment_date, a.appointment_status 
                     FROM appointments a 
                     JOIN medical_staff m ON a.doctor_id = m.staff_id";
$appointments = mysqli_query($connection, $appointmentQuery);

// registrations
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

//counting avaiable staff, based on their shift times
$staffSchedule = "SELECT COUNT(*) AS count FROM medical_staff WHERE shift_schedule = '9:00 AM - 5:00 PM'";
$availableStaff = $connection->query($staffSchedule);
$staffCount = $availableStaff->fetch_assoc()['count'];        

// Fetch all users
$sql = "SELECT user_id, user, email, role FROM users ORDER BY user_id ASC";
$result = mysqli_query($connection, $sql);

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Compass Hospital - Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="scrollable_modal.js"></script> 

    <script src="cch_script.js"></script>
    <script src="validation_script.js"></script>
</head>
<body class="panel-body">
   
    <div class="menu-bar">
        <h2>Menu</h2>
        <ul>
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#appointments">Appointments</a></li>
            <li><a href="#registrations">Registrations</a></li>
            <li><a href="#hospitalStaff">Hospital Staff</a></li>
            <li><a href="#manageUsers">Manage User Accounts</a></li>
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
            <!-- displaying rows -->
        <td><?php echo $row['booking_id']; ?></td>
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['patient_email']; ?></td>
            <td><?php echo $row['patient_contact']; ?></td>
            <td><?php echo $row['doctor_name']; ?></td>
            <td><?php echo $row['appointment_time']; ?></td>
            <td><?php echo $row['appointment_date']; ?></td>
            <td class="status-<?php echo strtolower($row['appointment_status']); ?>">
                <?php echo $row['appointment_status']; ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<hr>
     <!-- registrations management  -->
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

 <!-- staff management, add or delete or update or view  -->
        <div id="hospitalStaff">
            <h2>Manage Hospital Staff</h2>
</div>

<div class="staff-search-add-container">
    <input type="text" name="search" id="searchInput" class="staff-search-input" placeholder="Search Staff by ID/Name/Specialty/Role" onkeyup="filterStaff()">
    <button id="add-button">Add Staff</button>  <!--add staff button-->

</div>

<!-- staff Container -->
<div id="staffContainer">
    <!-- Staff cards will be dynamically inserted here -->
</div>

<!-- pagination -->
<ul class="pagination" id="pagination"></ul>

<!-- modal that displays staff details -->
<div id="staffDetailsModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2 id="modalFullName"></h2>
        <p><strong>Staff ID:</strong> <span id="modalId"></span></p>
        <p><strong>Name:</strong> <span id="modalName"></span></p>
        <p><strong>Email:</strong> <span id="modalEmail"></span></p>
        <p><strong>Contact:</strong> <span id="modalContact"></span></p>
        <p><strong>Role:</strong> <span id="modalRole"></span></p>
        <p><strong>Department:</strong> <span id="modalDepartment"></span></p>
        <p><strong>Specialty:</strong> <span id="modalSpecialty"></span></p>
        <p><strong>Qualifications:</strong> <span id="modalQualifications"></span></p>
        <p><strong>Shift:</strong> <span id="modalShift"></span></p>
    </div>
</div>


    <!-- add staff form hidden in a modal-->
<div id="addStaffModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeAddModal">&times;</span>
        <h2>Add Staff</h2>
        <form name="addStaffForm" method="POST" action="manage_staff_data.php" onsubmit="return validateAddStaffForm();">
            <input type="text" name="name" placeholder="Name" required>
            <div id="name_err" class="error"></div>
            <input type="email" name="email" placeholder="Email" required>
            <div id="email_err" class="error"></div>
            <input type="text" name="contact_number" placeholder="Contact Number" required>
            <div id="contact_number_err" class="error"></div>
            <input type="text" name="role" placeholder="Role" required>
            <div id="role_err" class="error"></div>
            <input type="text" name="department" placeholder="Department" required>
            <div id="department_err" class="error"></div>
            <input type="text" name="specialty" placeholder="Specialty" required>
            <div id="specialty_err" class="error"></div>
            <input type="text" name="qualifications" placeholder="Qualifications" required>
            <div id="qualifications_err" class="error"></div>
            <input type="text" name="shift_schedule" placeholder="Shift Schedule" required>
            <div id="shift_schedule_err" class="error"></div>
            <div class="staff-buttons"><button type="submit" name="add">Add Staff</button></div>
        </form>
    </div>
</div>


            <!-- update staff Form -->
            <div id="updateStaffModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeUpdateModal" onclick="closeUpdateModal()">&times;</span>
                <h2>Update Staff Details</h2>
                <form method="POST" action="manage_staff_data.php">
                    <input type="hidden" id="updateId" name="staff_id">
                    <input type="text" id="updateName" name="name" placeholder="Name" required>
                    <input type="email" id="updateEmail" name="email" placeholder="Email" required>
                    <input type="text" id="updateContact" name="contact_number" placeholder="Contact Number" required>
                    <input type="text" id="updateRole" name="role" placeholder="Role" required>
                    <input type="text" id="updateDepartment" name="department" placeholder="Department" required>
                    <input type="text" id="updateSpecialty" name="specialty" placeholder="Specialty" required>
                    <input type="text" id="updateQualifications" name="qualifications" placeholder="Qualifications" required>
                    <input type="text" id="updateShift" name="shift_schedule" placeholder="Shift Schedule" required>
                    <div class="staff-buttons"><button type="submit" name="update">Update Staff</button></div>
                </form>
            </div>
        </div>
    </div>
    </div>
    
<!--  creating staff accounts -->
<hr>
<div class="user-management-container">
<div id="manageUsers">
    <h2>Manage User Accounts</h2>

    <!-- table of user accounts already present -->
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['user']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['role']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<div class="staff-buttons" style="max-width: 100px;"><button id="addUserAccountButton">Add User Account</button></div>

<!-- create user account Modal -->
 <div id="createUserAccountModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeAddUserModal" onclick="closeAddUserModal()">&times;</span>
        <h2>Create New Staff Account</h2>

<form name="createUserAccountForm" action="create_user_account.php" method="POST" onsubmit="return validateCreateUserForm();" style="display: flex; flex-direction: column; max-width: 400px;">
    <label for="user">User:</label>
    <input type="text" id="user" name="user" required>
    <span id="user_err" class="error"></span>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <span id="password_err" class="error"></span>
    
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>
    <span id="confirm_password_err" class="error"></span>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <span id="email_err" class="error"></span>

    <label for="role">Role:</label>
    <select id="role" name="role" required>
    <option value="" selected disabled>Select the Role</option> 
        <option value="Administrator">Administrator</option>
        <option value="Receptionist">Receptionist</option>
        <option value="Doctor">Doctor</option>
    </select>
    <span id="role_err" class="error"></span>
    
    <div class="staff-buttons" style="margin-top: 10px;">
        <button type="submit" name="createAccount" id="createAccount">Create Account</button> <!-- button to create new user account -->
    </div>
</form>

    </div>
</div> 

<script>
    const staff = <?php echo json_encode($staff); ?>; // fetch staff data from PHP
</script>
<script src="staff_pagination_script.js"></script>
</body>
</html>
