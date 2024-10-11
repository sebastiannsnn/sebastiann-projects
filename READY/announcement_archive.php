<?php
include 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'delete') {
        $announcement_id = intval($_POST['id']);
        $sql = "DELETE FROM announcements WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $announcement_id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    }
} else {
    $sql = "SELECT a.id, a.subject, a.message, a.created_at, COUNT(m.id) as recipientCount
            FROM announcements a
            LEFT JOIN members m ON m.status = 'approved' AND m.consent = 'yes'
            GROUP BY a.id
            ORDER BY a.created_at DESC";
    $result = $conn->query($sql);

    $announcements = [];
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }

    echo json_encode($announcements);
}

$conn->close();
?>
