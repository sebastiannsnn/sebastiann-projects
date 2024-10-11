<?php
$servername = "localhost";
$username = "sn6855";
$password = "Qi2ih*763P!f_r7g";
$dbname = "sn6855_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
