<?php

include('connection.php');
include 'page_header.php'; 

// initialize search variable to be empty first
$search = '';

// query to fetch doctors without filtering then store it in a variable
$sql = "SELECT * FROM medical_staff WHERE role IN ('Doctor', 'Physician') ORDER BY name ASC";
$result = mysqli_query($connection, $sql);

// store results in an array for displaying later
$doctors = [];
while ($row = mysqli_fetch_assoc($result)) {
    $doctors[] = $row;
}

// Close the database connection
mysqli_close($connection);
?>

<html>
<head><title>Care Compass Hospital Doctor Channeling</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script src="cch_script.js"></script>
</head>
<body>

<div class='banner-container'>
<img src='resources/doctor_channeling.jpg' alt='DoctorChanneling' id='doc_channeling' width='1100' height='550'>
</div>
<div class='link'>
<a href='appointment_form.php' target='_blank'>Click here to book an appointment now.</a>
</div>

<div style='display: flex; justify-content: flex-end; width: 90%;'>
<div class='search-doctor-bar'>
<form method="post" action="">
<input type="text" name="search" id="searchInput" class="search-box" placeholder="Search by Name or Specialty" onkeyup="filterDoctors()">
<button type="submit" class="search-button">Search</button>
</form>
</div>
</div>

<div class="doctor-table">
<table id="table">
    <thead>
        <tr>
            <th>Doctor ID</th>
            <th>Name</th>
            <th>Specialty</th>
            <th>Email</th>
            <th>Qualifications</th>
            <th>Contact Number</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        <!-- data will be populated -->
    </tbody>
</table>
</div>


<ul class="pagination" id="pagination">
    <!-- page numbers will be populated accordingly by our script -->
</ul>


<script>
    const doctors = <?php echo json_encode($doctors); ?>; // fetch doctors data from PHP
</script>
<script src="doctor_pagination_script.js"></script>

<div id="footer-placeholder"></div>
<script>
   displayFooter();
</script>


</body>
</html>
