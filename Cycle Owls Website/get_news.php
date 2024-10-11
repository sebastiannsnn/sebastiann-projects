<?php
include 'db_connection.php';

$sql = "SELECT * FROM news WHERE last_showing >= CURDATE() ORDER BY first_showing ASC";
$result = $conn->query($sql);

$news = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $news[] = $row;
    }
}
$conn->close();

echo json_encode($news);
?>
