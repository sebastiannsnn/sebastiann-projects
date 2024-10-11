<?php
include 'db_connection.php';

header('Content-Type: application/json');

$response = ['success' => false];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $forename = trim($_POST['forename']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $status = trim($_POST['status']);

    $sql = "UPDATE members SET forename=?, surname=?, email=?, phone=?, status=?, last_updated=NOW() WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $forename, $surname, $email, $phone, $status, $id);

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
