<?php
include 'connection.php';

if (isset($_POST['payOnline'])) {
    $registration_id = $_POST['registration_id'];
    $amount = $_POST['amount']; 
    $card_type = $_POST['card_type'];

    $sql = "INSERT INTO online_payments (registration_id, amount, card_type) 
            VALUES ('$registration_id', '$amount', '$card_type')";
    
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        die('Could not process payment: ' . mysqli_error($connection));
    } else {
        echo "<script>alert('Payment successful!'); window.location.href='home.php';</script>";
    }
}
?>
