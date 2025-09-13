<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <script src="cch_script.js"></script> 
</head>
<body>

<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['confirm_password']);
    $role = $_POST['role'];
    
      // check if the email entered already exists
      $checkForDuplicateEmail = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($connection, $checkForDuplicateEmail);

      if (mysqli_num_rows($result) > 0) {
        // email already exists so no insertion
        echo "<script>alert('This email already exists. Please use a different email.');</script>";
      } 
    else {
    $query = "INSERT INTO users (user, password, role, email) 
              VALUES ('$user', '$password', '$role', '$email')";

    if (mysqli_query($connection, $query)) {

        echo  "<script>
        alert('Account created successfully!');
        setTimeout(function() {
            window.location.href='admin_panel.php';
        }, 2000);
      </script>";
    } else {
        echo "<script>
                alert('We could not create the account. Please try again.');
                setTimeout(function() {
                    window.location.href='admin_panel.php';
                }, 2000); 
              </script>";
    }
}
}
?>
</body>
</html>