<?php
// delete_all_waiting_events.php

include 'db_connection.php';

// SQL to delete all waiting events
$sql = "DELETE FROM waiting_events"; // Adjust the table name as needed

if ($conn->query($sql) === TRUE) {
    echo "All waiting events deleted successfully";
} else {
    echo "Error deleting records: " . $conn->error;
}

$conn->close();
?>
