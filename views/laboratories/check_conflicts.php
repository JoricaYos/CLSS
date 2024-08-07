<?php
include '../../models/database.php';

$semester = $_POST['semester'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];

// Query to check for conflicts, without considering personnel
$sql = "SELECT * FROM sched 
        WHERE semester = ? 
        AND day = ? 
        AND ((start_time <= ? AND end_time > ?) 
             OR (start_time < ? AND end_time >= ?) 
             OR (start_time >= ? AND end_time <= ?))";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssss", $semester, $day, $endTime, $startTime, $endTime, $startTime, $startTime, $endTime);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Conflict found
    echo json_encode(['conflict' => true, 'message' => 'Schedule conflict detected']);
} else {
    // No conflict
    echo json_encode(['conflict' => false]);
}

$stmt->close();
$conn->close();
?>