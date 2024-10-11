<?php
include 'db_connection.php';

try {
    // SQL statement to create the news table
    $sql = "CREATE TABLE IF NOT EXISTS news (
        id INT AUTO_INCREMENT PRIMARY KEY,
        subject VARCHAR(255) NOT NULL,
        admin VARCHAR(255) NOT NULL,
        first_showing DATE NOT NULL,
        last_showing DATE NOT NULL,
        content TEXT NOT NULL
    )";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Table news created successfully.";
    } else {
        echo "Error creating table: " . $conn->error;
    }

} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
} finally {
    $conn->close();
}
?>
