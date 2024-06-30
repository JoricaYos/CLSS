<?php
include '../../models/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['scheduleTitle'];
    $description = $_POST['description'];
    $repeatWeekly = isset($_POST['repeatWeekly']) ? 1 : 0;
    $days = isset($_POST['days']) ? implode(',', $_POST['days']) : '';
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $allDay = isset($_POST['allDay']) ? 1 : 0;
    $startTime = $allDay ? null : $_POST['startTime'];
    $endTime = $allDay ? null : $_POST['endTime'];

    $stmt = $conn->prepare("INSERT INTO schedules (title, description, repeat_weekly, days, start_date, end_date, all_day, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissssss", $title, $description, $repeatWeekly, $days, $startDate, $endDate, $allDay, $startTime, $endTime);

    if ($stmt->execute()) {
        echo "New schedule added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
