<?php
session_start();

include ($_SERVER['DOCUMENT_ROOT'] . '/models/database.php');

$personnel_id = $_SESSION['id'];

$query = "SELECT subject, semester, lab, day, start_time, end_time FROM sched WHERE personnel_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $personnel_id);
$stmt->execute();
$result = $stmt->get_result();

$schedules = array();
while ($row = $result->fetch_assoc()) {
    $start = date("g:i A", strtotime($row['start_time']));
    $end = date("g:i A", strtotime($row['end_time']));
    $row['time'] = $start . ' - ' . $end;
    unset($row['start_time'], $row['end_time']); 
    $schedules[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($schedules);