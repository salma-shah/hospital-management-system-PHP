<html>
<head>
    <title>Care Compass Hospital Accodommodation & General Facilities</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script src="cch_script.js"></script>
</head>

<body>
<?php 
include 'page_header.php';
?>
<div class="page-wrapper">
<div class='banner-container'>
<img src='resources/accomodation.jpg' alt='Accomodation' id='accommodation' width='1000' height='550'>
</div>
<div class='content-wrapper'>
    <img src = "resources/accomodation_section.jpg" alt=accomodation width="700" height="325">
<div class = "content-text">
<h2>Accommodation & Services</h2>

<p>We provide accommodation facilities that are enriched with more than 74 years of experience 
    in making our guests feel the comfort and warmth of home. </p>
    <p>Our facility is equipped with a range of rooms designed to suit your every need, and manned by highly trained staff to ensure a pleasant and remedial stay.</p>
    <p>Rooms we offer:</p>
    <ul>
<li>Grand Room</li>
<li>Deluxe Room</li>
<li>Standard Room</li>
<li>Shared Room</li>
</ul>
</div>
</div>


<div class="tab">
  <button class="tablinks" onclick="openRoom(event, 'grandRoom')">Grand Room</button>
  <button class="tablinks" onclick="openRoom(event, 'deluxeRoom')">Deluxe Room</button>
  <button class="tablinks" onclick="openRoom(event, 'standardRoom')">Standard Room</button>
  <button class="tablinks" onclick="openRoom(event, 'sharedRoom')">Shared Room</button>
</div>

<div id="grandRoom" class="roomcontent">
<div class="content-text">
  <h3>Grand Room</h3>
  <p>The grand room in the hospital serves as a central hub for patients, visitors, and medical staff, with over 550 square feet of place. It is designed to be spacious, well-lit, and welcoming, ensuring comfort and accessibility for everyone.</p>
  <img src = "resources/grand_room.jpg" alt=accomodation width="400" height="200">
  <ul>
<li>Spacious and comfortable </li>
<li>Smooth flooring and automatic lighting</li>
<li> Wheelchair Friendly; accessibile pathways for patients</li>
<li>Daily free service of food and beverages, specially crafted from our cafeteria. </li>
<li>Vistor lounge and luxurious attached bathroom.</li>
</ul>
</div>
</div>

<div id="deluxeRoom" class="roomcontent">
    <div class="content-text">
  <h3>Deluxe Room</h3>
  <p>The deluxe room in the hospital is well-accomodated and offers various benefits. It is designed to be spacious, and inviting, ensuring comfort for everyone.</p>
  <img src = "resources/deluxe_room.jpg" alt=accomodation width="600" height="200">
  <ul>
<li> Spacious and comfortable </li>
<li>Smooth mahogany flooring and automatic lighting</li>
<li> Wheelchair Friendly; accessibile pathways for patients</li>
<li>Daily free service of food and beverages, specially crafted from our cafeteria. </li>
</ul>
</div>
</div>

<div id="standardRoom" class="roomcontent">
<div class="content-text">
  <h3>Standard Room</h3>
  <p>The standard room is designed to provide a comfortable and functional space for patient care. It is equipped with essential medical facilities while ensuring a restful environment.</p>
  <img src = "resources/standard_room.jpg" alt=accomodation width="600" height="200">
  <ul>
  <li>Patient Bed: Adjustable and designed for comfort and support.</li>
  <li>Medical equipment and emergency call buttons.</li>
  <li>Storage space: lockers and bedside tables for personal belongings.</li>
  <li>Bathroom Facilities. </li>
</ul>
</div>
</div>

<div id="sharedRoom" class="roomcontent">
<div class="content-text">
  <h3>Shared Room</h3>
  <p>The shared room is designed to accommodate multiple patients while maintaining privacy. It provides a supportive environment for recovery.</p>
  <img src = "resources/shared_room.jpg" alt=accomodation width="600" height="200">
<li> Typically houses two to four patient beds with partitions for privacy.</li>
  <li>Shared facilities: common restroom and storage for belongings.</li>
  <li>Each bed is equipped with essential medical monitoring devices and call buttons.</li>
  <li> Limited seating for visitors. 
<li>Regular cleaning and sanitation to ensure patient safety.</li>
</ul>
</div>
</div>

</div>

<div id="footer-placeholder"></div>

<script>
   displayFooter();
</script>

</body>
</html>