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

    if (isset($_POST['scheduleId']) && !empty($_POST['scheduleId'])) {
        $scheduleId = $_POST['scheduleId'];

        $stmt = $conn->prepare("UPDATE schedules SET title=?, description=?, repeat_weekly=?, days=?, start_date=?, end_date=?, all_day=?, start_time=?, end_time=? WHERE id=?");
        $stmt->bind_param("ssissssssi", $title, $description, $repeatWeekly, $days, $startDate, $endDate, $allDay, $startTime, $endTime, $scheduleId);
    } else {
        $lab = $_POST['lab'];
        $type = $_POST['type'];
        $personnel = null;

        if ($type == 'reserve') {
            session_start();
            $personnel = $_SESSION['name'];
        } else {
            $personnel = '';
        }

        $stmt = $conn->prepare("INSERT INTO schedules (title, description, repeat_weekly, days, start_date, end_date, all_day, start_time, end_time, lab, type, personnel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssssssss", $title, $description, $repeatWeekly, $days, $startDate, $endDate, $allDay, $startTime, $endTime, $lab, $type, $personnel);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>