<?php
header('Content-Type: application/json');

include 'db_connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $duration = $_POST['duration'];
        $location = $_POST['location'];
        $comments = $_POST['comments'];
        $status = 'approved'; // Automatically approved since only admin can add

        // Log input values for debugging
        error_log("Name: $name");
        error_log("Type: $type");
        error_log("Date: $date");
        error_log("Time: $time");
        error_log("Duration: $duration");
        error_log("Location: $location");
        error_log("Comments: $comments");

        $sql = "INSERT INTO other_events (name, type, date, time, duration, location, comments, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            error_log("Prepare failed: " . $conn->error);
            http_response_code(500);
            echo json_encode(array("error" => "Prepare failed: " . $conn->error));
            exit;
        }

        $stmt->bind_param("ssssssss", $name, $type, $date, $time, $duration, $location, $comments, $status);

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
