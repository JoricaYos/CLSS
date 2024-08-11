<?php
include '../../models/database.php';

$semester = $_POST['semester'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$lab = $_GET['lab'];  // Get the lab from the URL parameter

// Update the SQL query to include the lab condition
$sql = "SELECT * FROM sched 
        WHERE semester = ? 
        AND day = ? 
        AND lab = ? 
        AND ((start_time <= ? AND end_time > ?) 
             OR (start_time < ? AND end_time >= ?) 
             OR (start_time >= ? AND end_time <= ?))";

$stmt = $conn->prepare($sql);
$stmt->bind_param("issssssss", $semester, $day, $lab, $endTime, $startTime, $endTime, $startTime, $startTime, $endTime);
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