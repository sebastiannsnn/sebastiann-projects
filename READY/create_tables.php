<?php
include 'db_connection.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// SQL to drop existing tables
$drop_members_table = "DROP TABLE IF EXISTS members";
$drop_announcements_table = "DROP TABLE IF EXISTS announcements";

// Execute the drop queries
$conn->query($drop_members_table);
$conn->query($drop_announcements_table);

// SQL to create `members` table
$members_table = "CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    forename VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    dob DATE NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(50) NOT NULL,
    address TEXT NOT NULL,
    emergency_contact VARCHAR(255) NOT NULL,
    emergency_phone VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    membership_option ENUM('standard', 'student', 'senior') NOT NULL,
    payment_method ENUM('card', 'paypal', 'cash') NOT NULL,
    auto_renew ENUM('yes', 'no') NOT NULL,
    consent ENUM('yes', 'no') NOT NULL,
    status ENUM('pending', 'active', 'inactive') NOT NULL DEFAULT 'pending',
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// SQL to create `announcements` table
$announcements_table = "CREATE TABLE IF NOT EXISTS announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    sender VARCHAR(255) NOT NULL,
    attachment VARCHAR(255),
    send_date DATE NOT NULL,
    send_time TIME NOT NULL,
    priority ENUM('high', 'normal', 'low') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the create queries
if ($conn->query($members_table) === TRUE) {
    echo "Table members created successfully<br>";
} else {
    echo "Error creating members table: " . $conn->error . "<br>";
}

if ($conn->query($announcements_table) === TRUE) {
    echo "Table announcements created successfully<br>";
} else {
    echo "Error creating announcements table: " . $conn->error . "<br>";
}

$conn->close();
?>
