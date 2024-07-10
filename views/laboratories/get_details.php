<?php
include '../../models/database.php';

if (isset($_GET['id'])) {
    $scheduleId = $_GET['id'];

    $stmt = $pdo->prepare("SELECT id, title, description, repeat_weekly, days, start_date, end_date, all_day, start_time, end_time FROM schedules WHERE id = ?");
    $stmt->execute([$scheduleId]);
    $schedule = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($schedule) {
        $schedule['repeat_weekly'] = (bool) $schedule['repeat_weekly'];
        $schedule['all_day'] = (bool) $schedule['all_day'];

        if ($schedule['repeat_weekly'] && !empty($schedule['days'])) {
            $schedule['days'] = explode(',', $schedule['days']);
        }

        header('Content-Type: application/json');
        echo json_encode($schedule);
        exit;
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Schedule not found']);
        exit;
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing id parameter']);
    exit;
}
?>
