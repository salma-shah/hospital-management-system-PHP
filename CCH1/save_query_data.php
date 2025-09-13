<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for your Query</title>
    <script src="cch_script.js"></script> 
</head>
<body>

<?php

include 'connection.php';

if (isset($_POST['submit_query'])) {
    $query_first_name = $_POST['query_first_name'];
    $query_last_name = $_POST['query_last_name'];
    $query_email = $_POST['query_email'];
    $query_contact_number = $_POST['query_contact_number'];
    $query_inquiry = $_POST['query_inquiry'];

    $sql = "INSERT INTO patient_query (first_name, last_name, email, contact_number, inquiry) 
            VALUES ('$query_first_name', '$query_last_name', '$query_email', '$query_contact_number', '$query_inquiry')";

    $result = mysqli_query($connection, $sql);

    if (!$result) {
        die('Could not enter data: ' . mysqli_error($connection));
    } else {
        echo "<script>displayThankYouQueryMessage(); window.location.href='contact.php';</script>";
    }
}

mysqli_close($connection);

?>

</body>
</html>

