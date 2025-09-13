<html>
<head><title>Care Compass Hospital Contact</title>

<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script src="cch_script.js"></script>
<script src="validation_script.js"></script>
</head>

<body>

<?php 
      include 'page_header.php'; 
      include 'connection.php';
?>
<br>
<img src="resources/map.jpeg" alt=HospitalMap class="full-width-image">

    <div class="contact-container">
    <div class="cc">
        
        <form name="query" method="POST" action="save_query_data.php" onsubmit="return validateQueryForm();">
            <h1>Contact Us</h1>
<p>If you have any questions or concerns, we encourage you to reach out to us! Whether you're inquiring about our services, need assistance with appointments, or have any other queries, we are here to assist you.</p>
<p>Please provide as much detail as possible so we can better understand your needs. Our dedicated team is committed to reviewing your request promptly and will get back to you as soon as we can.</p>
<p>This may take two to three working days. Thank you for your patience.<p>
            <label for="query_first_name">First Name: </label><br>
            <input type="text" name="query_first_name" id="query_first_name" placeholder="First Name">
            <span id="first_name_err" class="error"></span>
            <br>

            <label for="query_last_name">Last Name: </label><br>
            <input type="text" name="query_last_name" id="query_last_name" placeholder="Last Name">
            <span id="last_name_err" class="error"></span>
            <br>

            <label for="query_email">E-mail: </label><br>
            <input type="text" name="query_email" id="query_email" placeholder="E-mail">
            <span id="email_err" class="error"></span>
            <br>

            <label for="query_contact_number">Contact Number: </label><br>
            <input type="text" name="query_contact_number" id="query_contact_number" placeholder="Contact Number">
            <span id="contact_err" class="error"></span>
            <br>

            <label for="query_inquiry">Inquiry: </label><br>
            <textarea id="query_inquiry" name="query_inquiry" placeholder="Please enter your inquiry here." rows="5" cols="40"></textarea>
            <span id="inquiry_err" class="error"></span>
            <br>

            <button type="submit" name="submit_query">Submit</button>
            <button type="reset" onclick="reset_errors()">Reset</button>
        </form>
    </div>

<div class="contactdetails-container">
<h1>Care Compass Hospital</h1>
<p><h4>Location:</h4></p>
<p>#6 Thorn Gardens</p>
<p>Colombo 04</p>

<p><h4>Care Compass Hospital Contacts</h4></p>

<p>+94 15000 Helpline</p>
<p>1344 (Short code)</p>
<p>+94 11 2750 000<p>

<h4><p>Fax</h4></p>
<p>+94 11 2 575 311</p>

<p><h4>Accident & Emergency</h4></p>
<p>+94 11 1 140 002</p>

<p><h4>Admissions</h4></p>
<p>+94 11 2 140 003</p>

<p><h4>COVID-19 Care Centre Hotline</h4></p>
<p>+94 777 488 455</p>

<p><h4>Pharmacy</h4></p>
<p>Phone: +94 1456 78902</p>

<p><h4>Email</h4></p>

<p><h4>Customer Care</h4></p>
<p>contactus@carecompasshospital.com</p>

<p><h4>Pharmacy</h4></p>
pharmacare@gmail.com

<p><h4>Business Related Inquiries</h4></p>
<p>businessdevelopment@carecompasshospital.com</p>


</div>
</div>

<button class="dropdown-button" id="dropdown-button">Give your valued feedback</button>
<div class="feedback-form" id="feedback-form">
<form name="feedbackForm" method="POST" action="save_feedback_data.php" onsubmit="return validateFeedback();">
<div class="feedback-details">
           Please fill this form and give us your valued feedback.
</div>
        <br>          
    <label for="feedbackName">Name</label>
    <input type="text" id="feedbackName" name="feedbackName" required>
    <span id="feedbackNameErr" class="error"></span>

    <label for="feedbackEmail">Email Address</label>
    <input type="text" id="feedbackEmail" name="feedbackEmail">
    <span id="feedbackEmailErr" class="error"></span>

    <label for="feedbackContactNumber">Contact Number</label>
    <input type="text" id="feedbackContactNumber" name="feedbackContactNumber" required>
    <span id="feedbackContactNumberErr" class="error"></span>

    <label>Are you satisfied with our service?</label>
    <span id="feedbackSatisfactionErr" class="error"></span>
    <div class="radio-group">
        <input type="radio" id="yes" name="feedbackSatisfaction" value="yes" checked>
        <label for="yes">Yes</label>

        <input type="radio" id="no" name="feedbackSatisfaction" value="no">
        <label for="no">No</label>
    </div>

    <label>Which doctor did you visit?</label>
    <span id="docNameErr" class="error"></span>
    <select name="docName" id="docName">
    <option value="" selected disabled>Select a Doctor</option> 
        <optgroup label="Doctors">
            <?php
            $sql = "SELECT name, specialty FROM medical_staff WHERE role = 'Doctor' ORDER BY name";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $displayDr = "Dr. " . $row['name'];
                echo "<option value='" . $row['name'] . "'> " . $displayDr . " - " . $row['specialty'] . "</option>";
            }
            ?>
        </optgroup>

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

    <br><br>
    <label>Please rate your experience with the following aspects of your visit:</label>

    <label>Consultant doctor: </label>
    <span id="consultantDoctorErr" class="error"></span>

    <div class="radio-group">
        <input type="radio" id="docVeryGood" name="consultantDoctor" value="5">
        <label for="docVeryGood">Very good</label>

        <input type="radio" id="docGood" name="consultantDoctor" value="4">
        <label for="docGood">Good</label>

        <input type="radio" id="docFair" name="consultantDoctor" value="3">
        <label for="docFair">Fair</label>

        <input type="radio" id="docPoor" name="consultantDoctor" value="2">
        <label for="docPoor">Poor</label>

        <input type="radio" id="docVeryPoor" name="consultantDoctor" value="1">
        <label for="docVeryPoor">Very Poor</label>
    </div>
    
    <label>Pharmacy: </label>
    <span id="pharmacyErr" class="error"></span>

    <div class="radio-group">
        <input type="radio" id="pharmacyVeryGood" name="pharmacy" value="5">
        <label for="pharmacyVeryGood">Very good</label>

        <input type="radio" id="pharmacyGood" name="pharmacy" value="4">
        <label for="pharmacyGood">Good</label>

        <input type="radio" id="pharmacyFair" name="pharmacy" value="3">
        <label for="pharmacyFair">Fair</label>

        <input type="radio" id="pharmacyPoor" name="pharmacy" value="2">
        <label for="pharmacyPoor">Poor</label>

        <input type="radio" id="pharmacyVeryPoor" name="pharmacy" value="1">
        <label for="pharmacyVeryPoor">Very Poor</label>
    </div>
   
    <label>Medication & Care: </label>
    <span id="medsAndCareErr" class="error"></span>
            <div class="radio-group">
                
                <input type="radio" id="medsAndCareVeryGood" name="medsAndCare" value="5">
                <label for="veryGood">Very good</label>

                <input type="radio" id="medsAndCareGood" name="medsAndCare" value="4">
                <label for="good">Good</label>

                <input type="radio" id="medsAndCareFair" name="medsAndCare" value="3">
                <label for="good">Fair</label>

                <input type="radio" id="medsAndCarePoor" name="medsAndCare" value="2">
                <label for="good">Poor</label>

                <input type="radio" id="medsAndCareVeryPoor" name="medsAndCare" value="1">
                <label for="good">Very Poor</label>
            </div>
           

            <label>Making an appointment: </label>
            <span id="appointmentErr" class="error"></span>
            <div class="radio-group">
                
                <input type="radio" id="appointmentVeryGood" name="appointment" value="5">
                <label for="veryGood">Very good</label>

                <input type="radio" id="appointmentGood" name="appointment" value="4">
                <label for="good">Good</label>

                <input type="radio" id="appointmentFair" name="appointment" value="3">
                <label for="good">Fair</label>

                <input type="radio" id="appointmentPoor" name="appointment" value="2">
                <label for="good">Poor</label>

                <input type="radio" id="appointmentVeryPoor" name="appointment" value="1">
                <label for="good">Very Poor</label>
            </div>
           

            <label>Registering for online services: </label>
            <span id="onlineRegisterErr" class="error"></span>
            <div class="radio-group">
                
                <input type="radio" id="onlineRegisterVeryGood" name="onlineRegister" value="5">
                <label for="veryGood">Very good</label>

                <input type="radio" id="onlineRegisterGood" name="onlineRegister" value="4">
                <label for="good">Good</label>

                <input type="radio" id="onlineRegisterFair" name="onlineRegister" value="3">
                <label for="good">Fair</label>

                <input type="radio" id="onlineRegisterPoor" name="onlineRegister" value="2">
                <label for="good">Poor</label>

                <input type="radio" id="onlineRegisterVeryPoor" name="onlineRegister" value="1">
                <label for="good">Very Poor</label>
            </div>
           

    <label for="review">Leave a review of your experience at Care Compass Hospital:</label>
    <textarea id="review" name="review" rows="8" cols="20" required></textarea>
    <span id="reviewErr" class="error"></span>

    <label for="suggestions">Suggestions to improve Care Compass Hospital's service:</label>
    <textarea id="suggestions" name="suggestions" rows="8" cols="20" required></textarea>
    <span id="suggestionsErr" class="error"></span>

    <button type="submit" name="submitFeedback">Submit feedback</button>
    <br>
    <button type="reset">Reset</button>
        </form>
</div>
<?php

?>


<div id="footer-placeholder"></div>

<script>
   displayFooter();
</script>
</body>



</html>