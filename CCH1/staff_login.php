<html>
    <head><title>Care Compass Hospital Staff Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="cch_script.js"></script> 
</head>
    <body class="login-body">
    <div class="login-header">
        <h2>Staff Login</h2>
</div>
        
<?php
session_start();
if ($_SERVER['REQUEST_METHOD']== "POST"){

include 'connection.php';

$user = $_POST["user"];
$email = $_POST["email"];
$password =$_POST["password"];

// hash the entered password, so it will match the one in the table
$hashedPassword = hash('sha256', $password);

$sql = "SELECT * FROM users WHERE user= '$user' AND email = '$email' AND password = '$hashedPassword'";
$result = mysqli_query($connection, $sql);
    
    if (mysqli_num_rows($result)== 1) 
    {
        $row = mysqli_fetch_array($result); 

        // if matches, then store user and role in session
        $_SESSION['user'] = $row['user']; 
        $_SESSION['role'] = $row['role'];
     
        if ($row['role'] == 'Administrator')
        { 
            header("Location: admin_panel.php"); 
        }
        else 
        {
            header("Location: staff_panel.php"); 
        }
        exit();
    }
    else 
    {
 echo "<script>displayInvalidMessage(); window.location.href='staff_login.php';</script>";
    }
}
?>

<div class="login-container">
<form name ="Login" method="post" action="">
    
<h2>Please enter the details to login.</h2><br>
<div class="input-group">
<label for="user">User: </label>
<input type="text" name="user" placeholder= "User" required>
</div>
<br>
<div class="input-group">
<label for="email">Email: </label>
<input type="text" name="email" placeholder= "Email" required>
</div>
<br>
<div class="input-group">
<label for="password">Password: </label>
<input type="password" name="password"  placeholder= "Password" required>
</div>
<br>
<div class="input-group">
<button type=submit name=Submit>Login</button>
<button type="reset">Reset</button>
</div>
</form>
</div>
<br>

</body>
</html>