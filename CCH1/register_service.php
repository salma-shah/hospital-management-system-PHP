
<?php
session_start();
include 'connection.php';

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['registerOnline'])) {

   // get details from the form once button is clicked
    $patient_name = $_POST['patient_name'];
    $patient_contact = $_POST['patient_contact'];
    $patient_email = $_POST['patient_email'];
    $test_id = $_POST['test_id'];
    $registration_date = $_POST['registration_date'];

   // fetching test price 
    $sqlPrice = "SELECT price FROM tests WHERE test_id = '$test_id'";
    $priceResult = mysqli_query($connection, $sqlPrice);  // execute
    $priceRow = mysqli_fetch_assoc($priceResult);  // store the result of query
    if (!$priceRow) {
        echo "<script>alert('Test not found. Please try again.'); window.location.href = 'home.php';</script>";
        exit;
    }

    $test_price = $priceRow['price'];
   // declare service charge variable
    $service_charge = 450.00;
   // calculate total cost
    $total_cost = $test_price + $service_charge;

    //count number of tests already registered
    $sql = "SELECT COUNT(*) as registration_count FROM registrations WHERE test_id = '$test_id' AND registration_date = '$registration_date'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    //  see the test's maximum number of registraion for the day
    $sqlMax = "SELECT max_registrations FROM tests WHERE test_id = '$test_id'";
    $maxResult = mysqli_query($connection, $sqlMax);
    $maxRow = mysqli_fetch_assoc($maxResult);

// if max limit is not met yet, then registration will be successful and data inserted into table
    if ($row['registration_count'] < $maxRow['max_registrations']) {
        $insertSql = "INSERT INTO registrations (patient_name, patient_contact, patient_email, test_id, registration_date, status, total_cost) 
                      VALUES ('$patient_name', '$patient_contact', '$patient_email', '$test_id', '$registration_date', 'Registered', '$total_cost')";

// successfully booked then change status to Approved
        if (mysqli_query($connection, $insertSql)) {
            $registration_id = mysqli_insert_id($connection);  // returns the auto increment id from last query
            $_SESSION['registration_id'] = $registration_id;  // stores in a session
            echo "<script>
                    alert('You have registered for the test successfully. Your ID is: $registration_id');
                    window.location.href = 'registration_confirmation.php?registration_id=$registration_id';
                  </script>";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        echo "<script>
                alert('All the available slots are taken so please try another day.');
                window.location.href = 'home.php';
              </script>";
    }
}

mysqli_close($connection);
?>

