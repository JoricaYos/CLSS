<?php
include '../../models/database.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$title = isset($_POST['title']) ? $conn->real_escape_string($_POST['title']) : '';
$date = isset($_POST['date']) ? $conn->real_escape_string($_POST['date']) : '';
$startTime = isset($_POST['startTime']) ? $conn->real_escape_string($_POST['startTime']) : '';
$endTime = isset($_POST['endTime']) ? $conn->real_escape_string($_POST['endTime']) : '';

$sql = "UPDATE reserve SET title = ?, start_date = ?, start_time = ?, end_time = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $title, $date, $startTime, $endTime, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to update reservation']);
}

$stmt->close();
$conn->close();
?>