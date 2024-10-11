<?php
header('Content-Type: application/json');

include 'db_connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newsId = $_POST['newsId'];
        $subject = $_POST['subject'];
        $admin = $_POST['admin'];
        $first_showing = $_POST['first_showing'];
        $last_showing = $_POST['last_showing'];
        $content = $_POST['content'];

        $sql = "UPDATE news SET subject=?, admin=?, first_showing=?, last_showing=?, content=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            error_log("Prepare failed: " . $conn->error);
            http_response_code(500);
            echo json_encode(array("error" => "Prepare failed: " . $conn->error));
            exit;
        }

        $stmt->bind_param("sssssi", $subject, $admin, $first_showing, $last_showing, $content, $newsId);

        if ($stmt->execute()) {
            // Fetch updated news items
            $result = $conn->query("SELECT * FROM news");
            if ($result === false) {
                error_log("Query failed: " . $conn->error);
                http_response_code(500);
                echo json_encode(array("error" => "Query failed: " . $conn->error));
                exit;
            }
            $news = array();
            while ($row = $result->fetch_assoc()) {
                $news[] = $row;
            }
            echo json_encode($news);
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
