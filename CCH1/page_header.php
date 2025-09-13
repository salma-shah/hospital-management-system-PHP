<html>

<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="mainwrapper">
    <div class="logo-wrapper">

    <img src="resources\hoslogo.png" alt=HospitalLogo width="125" height="125">
    <a href="#" class="logo-text">    
    <span>C</span>are <span>C</span>ompass <span>H</span>ospital</a> 
    </div>

<nav>
 <div class= "navigation-wrapper">

<?php

echo "<ul class='navlist'>";

// associate array, where page url value is stored in a key
$components = array (
 "Home" => "home.php", 
 "Services & Registration" => "#",                 
 "Doctor Channeling" => "doctor_channeling.php",
 "Contact Us" => "contact.php",
 "Staff Login" => "staff_login.php" );

 foreach ($components as $pageName => $url) 
 if ($pageName == "Services & Registration") // if services and registrations, dusplay dropdown with more page urls
 {
    echo "<li class='nav-item'>
            <a href='$url'>$pageName</a>
            <div class='dropdown'>
                <a href='accident_and_emergency.php'>Accident and Emergency</a>
                <a href='facilities.php'>Accommodation Facilities</a>
                <a href='clinicals.php'>Clinical & Laboratory Services</a>
                <a href='icu.php'>Intensive and Critical Care Units</a>
                <a href='operating_theatre.php'>Operating Theatre</a>
                 <a href='outpatient_care.php'>Outpatient Care (OPD)</a>
                <a href='pharmacy.php'>Pharmacy</a>
                <a href='vaccination.php'>Vaccination</a>
                <a href='women_wellness.php'>Women's Wellness Center</a>
                <a href='radiology_and_xray.php'>X-ray & Radiology</a>
                <a href='register_online_form.php'><strong>Service Registration</strong></a>
            </div>
          </li>";
 } 
 // otherwise just url for each tab
 else
 {
     echo " <li><a href='$url'>$pageName</a></li> ";
 }

 echo "</ul>";

 // this makes navigation very smooth
?>

</div>
</nav>
</div>

<!-- // search bar -->
  <form action="search_services.php" method=get>
  <div class="search-bar">
        <input type="text" name="keyword" class="search-input" placeholder="Search...">
        <button type="submit" class="search-button" name="searchService" ><i class="fas fa-search"></i></button>
        </div>
      </form>
     

<script>

    window.onscroll = function() {
        var nav = document.querySelector('nav');
        var top = nav.offsetTop; //  the initial position of the nav

        if (window.pageYOffset > top) {
            nav.classList.add('top'); // add the class to the nav
        } else {
            nav.classList.remove('top'); // remove the class
        }
    };
</script>



</body>


</html>