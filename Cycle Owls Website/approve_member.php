<?php
include 'db_connection.php';

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];

$sql = "UPDATE members SET status = 'approved' WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $conn->error;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
