<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $forename = trim($_POST['forename']);
    $surname = trim($_POST['surname']);
    $gender = trim($_POST['gender']);
    $dob = trim($_POST['dob']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $emergency_contact = trim($_POST['emergency_contact']);
    $emergency_phone = trim($_POST['emergency_phone']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $membership_option = trim($_POST['membership_option']);
    $payment_method = trim($_POST['payment_method']);
    $auto_renew = trim($_POST['auto_renew']);
    $consent = trim($_POST['consent']);

    // Prepare and bind statement
    $sql = "INSERT INTO members (forename, surname, gender, dob, email, phone, address, emergency_contact, emergency_phone, password, membership_option, payment_method, auto_renew, consent) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss", $forename, $surname, $gender, $dob, $email, $phone, $address, $emergency_contact, $emergency_phone, $password, $membership_option, $payment_method, $auto_renew, $consent);

    // Execute statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
