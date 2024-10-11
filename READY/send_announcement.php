<?php
include 'db_connection.php';

header('Content-Type: application/json'); // Ensure the response is always JSON

$response = ['success' => false];

// Enable detailed error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $subject = trim($_POST['subject']);
        $sender = trim($_POST['sender']);
        $send_date = trim($_POST['send_date']);
        $send_time = trim($_POST['send_time']);
        $priority = trim($_POST['priority']);
        $message = ""; // Assuming there's a message field in the form, you should fetch it similarly

        // Handle file upload
        $attachment = "";
        if (!empty($_FILES["attachment"]["name"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file already exists
            if (file_exists($target_file)) {
                $uploadOk = 0;
                $response['error'] = 'File already exists.';
            }

            // Check file size
            if ($_FILES["attachment"]["size"] > 500000) {
                $uploadOk = 0;
                $response['error'] = 'File is too large.';
            }

            // Allow certain file formats
            if (!in_array($fileType, ['jpg', 'png', 'jpeg', 'gif', 'pdf'])) {
                $uploadOk = 0;
                $response['error'] = 'Invalid file format.';
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                if (!isset($response['error'])) {
                    $response['error'] = 'Sorry, your file was not uploaded.';
                }
            } else {
                if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
                    $attachment = basename($_FILES["attachment"]["name"]);
                } else {
                    $response['error'] = 'Sorry, there was an error uploading your file.';
                }
            }
        }

        // Insert announcement into database
        if (empty($response['error'])) {
            $sql = "INSERT INTO announcements (subject, message, sender, attachment, send_date, send_time, priority) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }
            $stmt->bind_param("sssssss", $subject, $message, $sender, $attachment, $send_date, $send_time, $priority);

            if ($stmt->execute()) {
                // Count approved members with consent
                $sql_recipients = "SELECT COUNT(*) as recipientCount FROM members WHERE status = 'approved' AND consent = 'yes'";
                $result = $conn->query($sql_recipients);
                if ($result) {
                    $row = $result->fetch_assoc();
                    $response['recipientCount'] = $row['recipientCount'];
                    $response['success'] = true;
                } else {
                    $response['error'] = 'Failed to count recipients.';
                }
            } else {
                throw new Exception("Execute statement failed: " . $stmt->error);
            }

            $stmt->close();
        }
    } else {
        $response['error'] = 'Invalid request method.';
    }
} catch (Exception $e) {
    error_log($e->getMessage()); // Log the error message for debugging
    $response['error'] = 'Server error: ' . $e->getMessage();
}

echo json_encode($response);
$conn->close();
?>
