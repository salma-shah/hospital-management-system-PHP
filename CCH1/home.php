<html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Care Compass Hospital Home
        </title>
        <script src="cch_script.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    
</head>

    <body>
<?php include 'page_header.php' ; ?>
    
<div class="page-wrapper">

<div class="text-bg">
<h1>Welcome to Care Compass Hospital</h1></div>
<p><h4>Our dedicated team of highly skilled medical professionals <br>
    and state-of-the-art facilities ensure that you and your loved ones receive the best possible care. <br>
    Explore our website to learn more about our services, meet our doctors, and book your appointments with ease. <br> </h4> <br>
<h2>Experience healthcare redefined at Care Compass Hospital—where your well-being is our mission.</h2></p><br>

<br>

<div class="image-container">
<img src="resources/hospital_img1.jpg" alt=HospitalImage id="hos_img" width="1000" height="550">
</div>

<div class="aboutus-wrapper">
    <div class = "aboutus-text">
    <h2>About Us</h2>
    <p>Since our foundation in 1988, we have built a reputation for leadership in medical innovation and excellence.</p>
    <p>This reputation is based on the straightforward belief that enhancing community health should be motivated by both compassion and enthusiasm.</p>
    <p>Our hospital network spans key locations across the country, ensuring accessible and quality healthcare for communities. We have branches in Colombo, Kandy and Kurenegale.<p>
    <p>We provide critical care units and a variety of roomy, contemporary accommodations.</p>
    <p>The top consultants, experts, and staff at Care Compass Hospital are committed to delivering outstanding clinical results 
    and the highest level of client satisfaction.</p><br>
    </div>
    <img src="resources/hospitalheader.png" alt=HospitalHeader width="360" height="360">
</div>

<div class="mentalhealth-wrapper">
<img src = "resources/mentalhealth_icon.jpg" alt=MentalHealth width="300" height="300">
<div class = "mentalhealth-text">
    <h2>Are you okay?</h2>
    <p>Don't be afraid to ask for help.</p>
    <p>The <b>National Mental Health Helpline</b> is a free and confidential helpline for anyone feeling low, anxious or depressed and unlike themselves.</p>
    <p>To access the helpline, call <b>+94 15000</b> and press number '<b>3</b>' for Mental Health.</p>
</div>
</div>

<div class="feature-container">
<div class= "feature-wrapper">
<img src = "resources/bed_icon.png" alt=bed width="85" height="85">
<div class= "feature-title">
<h3>Accommodation Facilities</h3>
</div>
<br>
<br>
<p>Care Compass Hospital provides a range of accommodations to make your stay comfortable.</p>
<br>
<button onclick="window.open('facilities.php', '_blank')">Learn More</button>
</div>
<br>
<div class= "feature-wrapper">
<img src = "resources/appointment_icon.png" alt=bed width="85" height="85">
<div class= "feature-title">
<h3>Book an Appointment</h3>
</div>
<br>
<br>
<p>Make an appointment for a health checkup online now, at a better service rate.</p>
<br>
<button onclick="window.open('appointment_form.php', '_blank')">Book Here</button>
</div>
</div>

<script>
    const rollOverImage = document.getElementById("hos_img");

    rollOverImage.addEventListener("mouseover", () =>{
        rollOverImage.src = "resources/hospital_img.jpg"  // when hover
    })

    rollOverImage.addEventListener("mouseout", () =>{
        rollOverImage.src = "resources/hospital_img1.jpg"  // default
    })

</script>
</div>

<div id="footer-placeholder"></div>
<script>
   displayFooter();
</script>

    </body>
</html>