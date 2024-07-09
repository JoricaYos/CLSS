<?php
include '../../models/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['scheduleTitle'];
    $description = $_POST['description'];
    $repeatWeekly = isset($_POST['repeatWeekly']) ? 1 : 0;
    $days = isset($_POST['editDays']) ? implode(',', $_POST['editDays']) : '';
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $allDay = isset($_POST['allDay']) ? 1 : 0;
    $startTime = $allDay ? null : $_POST['startTime'];
    $endTime = $allDay ? null : $_POST['endTime'];

    $stmt = $conn->prepare("UPDATE schedules SET title=?, description=?, repeat_weekly=?, days=?, start_date=?, end_date=?, all_day=?, start_time=?, end_time=? WHERE id=?");
    $stmt->bind_param("ssissssssi", $title, $description, $repeatWeekly, $days, $startDate, $endDate, $allDay, $startTime, $endTime, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
