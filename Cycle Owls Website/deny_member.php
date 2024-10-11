<?php
header('Content-Type: application/json');
include 'db_connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['email'])) {
            $email = $data['email'];

            // Delete member from the database
            $sql = "DELETE FROM members WHERE email = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Prepare failed: ' . $conn->error);
            }

            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                echo json_encode(array("success" => true));
            } else {
                throw new Exception('Execute failed: ' . $stmt->error);
            }

            $stmt->close();
        } else {
            throw new Exception('Email not provided');
        }
    } else {
        throw new Exception('Invalid request method');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("error" => $e->getMessage()));
} finally {
    $conn->close();
}
?>
