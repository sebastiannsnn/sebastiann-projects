<?php
include 'db_connection.php';

header('Content-Type: application/json');

$response = ['success' => false];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    
    $sql = "DELETE FROM members WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = $stmt->error;
    }

    $stmt->close();
}

echo json_encode($response);

$conn->close();
?>
