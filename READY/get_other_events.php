<?php
include 'db_connection.php';

$sql = "SELECT * FROM other_events WHERE status='approved'";
$result = $conn->query($sql);

$events = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
$conn->close();

echo json_encode($events);
?>
