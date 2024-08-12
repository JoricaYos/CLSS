<?php
include '../../models/database.php';

$semester = $_POST['semester'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$lab = $_GET['lab'];  

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
    echo json_encode(['conflict' => true, 'message' => 'Schedule conflict detected']);
} else {
    echo json_encode(['conflict' => false]);
}

$stmt->close();
$conn->close();
?>