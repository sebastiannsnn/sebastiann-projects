<?php
include 'db_connection.php';

header('Content-Type: application/json');

$sql = "SELECT id, forename, surname, email, phone, status, TIMESTAMPDIFF(MONTH, last_updated, NOW()) AS months_since_update 
        FROM members
        ORDER BY FIELD(status, 'pending', 'active', 'inactive'), last_updated DESC";
$result = $conn->query($sql);

$members = [];
while ($row = $result->fetch_assoc()) {
    // Automatically set to inactive if more than 24 months have passed since last update and auto-renew is 'no'
    if ($row['status'] === 'active' && $row['months_since_update'] > 24) {
        $row['status'] = 'inactive';
    }
    $members[] = $row;
}

echo json_encode($members);

$conn->close();
?>
