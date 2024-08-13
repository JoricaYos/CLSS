<?php
include '../../models/database.php';

$id = $_POST['id'];
$subject = $_POST['subject'];
$personnel = $_POST['personnel'];
$semester = $_POST['semester'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$lab = $_POST['lab'];

$sql = "UPDATE sched SET 
        subject = '$subject',
        personnel = '$personnel',
        semester = '$semester',
        day = '$day',
        start_time = '$startTime',
        end_time = '$endTime'
        WHERE id = $id AND lab = '$lab'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Schedule updated successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error updating schedule: ' . $conn->error]);
}

$conn->close();
?>