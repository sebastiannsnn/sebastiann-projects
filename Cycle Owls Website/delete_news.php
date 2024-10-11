<?php
header('Content-Type: application/json');

include 'db_connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve JSON input and decode it
        $data = json_decode(file_get_contents("php://input"), true);
        $newsId = $data['newsId'];

        $sql = "DELETE FROM news WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            error_log("Prepare failed: " . $conn->error);
            http_response_code(500);
            echo json_encode(array("error" => "Prepare failed: " . $conn->error));
            exit;
        }

        $stmt->bind_param("i", $newsId);

        if ($stmt->execute()) {
            echo json_encode(array("success" => true));
        } else {
            http_response_code(500);
            error_log("Execute failed: " . $stmt->error);
            echo json_encode(array("error" => "Execute failed: " . $stmt->error));
        }

        $stmt->close();
    } else {
        http_response_code(405);
        echo json_encode(array("error" => "Invalid request method"));
    }
} catch (Exception $e) {
    http_response_code(500);
    error_log("Exception: " . $e->getMessage());
    echo json_encode(array("error" => $e->getMessage()));
} finally {
    $conn->close();
}
?>
