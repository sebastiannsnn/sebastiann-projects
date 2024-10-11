<?php
header('Content-Type: application/json');

include 'db_connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $subject = trim($_POST['subject']);
        $admin = trim($_POST['admin']);
        $first_showing = $_POST['first_showing'];
        $last_showing = $_POST['last_showing'];
        $content = trim($_POST['content']);

        // Server-side validation
        if (str_word_count($subject) > 5) {
            throw new Exception('Subject must be a maximum of 5 words.');
        }

        if (str_word_count($content) > 200) {
            throw new Exception('Content must be a maximum of 200 words.');
        }

        if (empty($admin)) {
            throw new Exception('Admin full name is required.');
        }

        if (empty($first_showing) || empty($last_showing)) {
            throw new Exception('Both first and last showing dates are required.');
        }

        $sql = "INSERT INTO news (subject, admin, first_showing, last_showing, content) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }

        $stmt->bind_param("sssss", $subject, $admin, $first_showing, $last_showing, $content);

        if ($stmt->execute()) {
            echo json_encode(array("success" => true));
        } else {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        $stmt->close();
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
