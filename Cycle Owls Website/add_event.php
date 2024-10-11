<?php
// Database connection details
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $duration = $_POST['duration'];
    $meeting = $_POST['meeting'];
    $distance = $_POST['distance'];
    $elevation = $_POST['elevation'];
    $group = $_POST['group'];
    $leader = $_POST['leader'];
    $contact = $_POST['contact'];
    $altcontact = $_POST['altcontact'];
    $comments = $_POST['comments'];

    // SQL query to insert event
    $sql = "INSERT INTO events (name, type, date, time, duration, meeting, distance, elevation, `group`, leader, contact, altcontact, comments, status) 
            VALUES ('$name', '$type', '$date', '$time', '$duration', '$meeting', '$distance', '$elevation', '$group', '$leader', '$contact', '$altcontact', '$comments', 'pending')";

    // Execute query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
