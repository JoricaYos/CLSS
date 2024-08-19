<?php
session_start();
include '../../models/database.php';
include 'check_reservation_conflicts.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$personnel_id = $_SESSION['id'];

$title = mysqli_real_escape_string($conn, $_POST['title']);
$lab = mysqli_real_escape_string($conn, $_POST['lab']);
$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
$start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
$end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
$force = isset($_POST['force']) ? filter_var($_POST['force'], FILTER_VALIDATE_BOOLEAN) : false;

if (!$force && checkReservationConflicts($lab, $start_date, $start_time, $end_time)) {
    echo json_encode(['status' => 'conflict', 'message' => 'This reservation conflicts with an existing reservation']);
    exit;
}

$sql = "INSERT INTO reserve (title, lab, personnel_id, start_date, start_time, end_time) 
        VALUES ('$title', '$lab', $personnel_id, '$start_date', '$start_time', '$end_time')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success', 'message' => 'Reservation added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error adding reservation: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>