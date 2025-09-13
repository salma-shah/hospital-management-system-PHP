<?php
session_start();
include 'connection.php';

// Check if registration ID is set in the session
if (isset($_SESSION['registration_id'])) {
    $registration_id = $_SESSION['registration_id'];

    // Fetch the total cost from the registrations table
    $query = "SELECT total_cost FROM registrations WHERE registration_id = '$registration_id'";
    $result = mysqli_query($connection, $query);
    $registration = mysqli_fetch_assoc($result);

    if ($registration) {
        $total_cost = $registration['total_cost'];
    } else {
        echo "No registration found with that Registration ID.";
        exit;
    }
} else {
    echo "Registration ID is missing.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="script.js"></script>
</head>
<body>

<form name="paymentForm" action="payment.php" method="POST" class="payment-form" onsubmit="return validatePaymentForm();">
    <label for="registration_id" class="form-label">Registration ID:</label>
    <input type="text" id="registration_id" name="registration_id" class="form-input" value="<?php echo htmlspecialchars($registration_id); ?>" readonly>
    <span id="registration_err" class="error"></span>

    <label for="amount" class="form-label">Amount:</label>
    <input type="number" id="amount" name="amount" class="form-input" value="<?php echo htmlspecialchars($total_cost); ?>" readonly>
    <span id="amount_err" class="error"></span>

    <label class="form-label">Payment Method:</label>
    <div class="payment-icons">
        <img src="resources/card_types.png" alt="Accepted Cards">
    </div>
    <div class="radio-group">
        <input type="radio" name="card_type" value="american_express" required>
        <label>American Express</label>
        <input type="radio" name="card_type" value="visa" required>
        <label>Visa</label>
        <input type="radio" name="card_type" value="mastercard" required>
        <label>Mastercard</label>
    </div>
    <span id="card_type_err" class="error"></span>

    <button type="submit" name="payOnline" class="submit-button">Pay Now</button>
</form>
    </div>
</body>
</html>


