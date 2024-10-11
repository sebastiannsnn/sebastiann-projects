<?php
header('Content-Type: application/json');

include 'db_connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $eventId = $_POST['eventId'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $duration = $_POST['duration'];
        $location = $_POST['location'];
        $comments = $_POST['comments'];

        // Log input values for debugging
        error_log("Event ID: $eventId");
        error_log("Name: $name");
        error_log("Type: $type");
        error_log("Date: $date");
        error_log("Time: $time");
        error_log("Duration: $duration");
        error_log("Location: $location");
        error_log("Comments: $comments");

        $sql = "UPDATE other_events SET name=?, type=?, date=?, time=?, duration=?, location=?, comments=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            error_log("Prepare failed: " . $conn->error);
            http_response_code(500);
            echo json_encode(array("error" => "Prepare failed: " . $conn->error));
            exit;
        }

        $stmt->bind_param("sssssssi", $name, $type, $date, $time, $duration, $location, $comments, $eventId);

        if ($stmt->execute()) {
            // Fetch updated events
            $result = $conn->query("SELECT * FROM other_events");
            if ($result === false) {
                error_log("Query failed: " . $conn->error);
                http_response_code(500);
                echo json_encode(array("error" => "Query failed: " . $conn->error));
                exit;
            }
            $events = array();
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
            echo json_encode($events);
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
