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

$stmt = $conn->prepare("SELECT sem1_start, sem1_end, sem2_start, sem2_end FROM semester LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
$semesterDates = $result->fetch_assoc();

if ($semester == 1) {
    $semesterStart = $semesterDates['sem1_start'];
    $semesterEnd = $semesterDates['sem1_end'];
} else {
    $semesterStart = $semesterDates['sem2_start'];
    $semesterEnd = $semesterDates['sem2_end'];
}

$stmt = $conn->prepare("UPDATE sched SET subject = ?, personnel_id = ?, semester = ?, day = ?, start_time = ?, end_time = ?, lab = ?, semester_start = ?, semester_end = ? WHERE id = ?");
$stmt->bind_param("siissssssi", $subject, $personnel, $semester, $day, $startTime, $endTime, $lab, $semesterStart, $semesterEnd, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Schedule updated successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>