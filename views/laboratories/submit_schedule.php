<?php
include '../../models/database.php';

// Get data from POST request
$subject = $_POST['subject'];
$personnel = $_POST['personnel'];
$semester = $_POST['semester'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];

// Get semester dates
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

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO sched (subject, personnel_id, semester, day, start_time, end_time, semester_start, semester_end) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siisssss", $subject, $personnel, $semester, $day, $startTime, $endTime, $semesterStart, $semesterEnd);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Schedule added successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>