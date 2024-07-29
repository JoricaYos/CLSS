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
    $lab = $_POST['lab'];
    $type = $_POST['type'];
    $force = isset($_POST['force']) && $_POST['force'] === 'true';

    // Check for existing schedules if not forced
    if (!$force) {
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM schedules WHERE lab = ? AND ((start_date <= ? AND end_date >= ?) OR (start_date <= ? AND end_date >= ?)) AND ((all_day = 1) OR (start_time < ? AND end_time > ?))");
        $checkStmt->bind_param("sssssss", $lab, $endDate, $startDate, $startDate, $endDate, $endTime, $startTime);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $conflictCount = $checkResult->fetch_row()[0];

        if ($conflictCount > 0) {
            echo json_encode(['success' => false, 'conflict' => true]);
            exit;
        }
    }

    if (isset($_POST['scheduleId']) && !empty($_POST['scheduleId'])) {
        $scheduleId = $_POST['scheduleId'];

        $stmt = $conn->prepare("UPDATE schedules SET title=?, description=?, repeat_weekly=?, days=?, start_date=?, end_date=?, all_day=?, start_time=?, end_time=? WHERE id=?");
        $stmt->bind_param("ssissssssi", $title, $description, $repeatWeekly, $days, $startDate, $endDate, $allDay, $startTime, $endTime, $scheduleId);
    } else {
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