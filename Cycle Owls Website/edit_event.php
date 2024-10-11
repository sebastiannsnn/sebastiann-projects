<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['eventId']; // Change 'id' to 'eventId' to match the form
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
    $status = $_POST['status'];

    $sql = "UPDATE events SET 
        name='$name', 
        type='$type', 
        date='$date', 
        time='$time', 
        duration='$duration', 
        meeting='$meeting', 
        distance='$distance', 
        elevation='$elevation', 
        `group`='$group', 
        leader='$leader', 
        contact='$contact', 
        altcontact='$altcontact', 
        comments='$comments', 
        status='$status' 
        WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Event updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
