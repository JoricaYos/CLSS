<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../models/database.php';

$sql = "SELECT title, description, start_date AS start, end_date AS end, all_day, start_time, end_time FROM schedules";
$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}

$schedules = array();

while ($row = $result->fetch_assoc()) {
    $event = array(
        'title' => $row['title'],
        'start' => $row['start'],
        'end' => $row['end']
    );

    if (!$row['all_day']) {
        $event['start'] .= 'T' . $row['start_time'];
        $event['end'] .= 'T' . $row['end_time'];
    }

    $schedules[] = $event;
}

echo json_encode($schedules);

$conn->close();
?>
