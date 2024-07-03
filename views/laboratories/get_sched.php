<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../models/database.php';

$lab = isset($_GET['lab']) ? $_GET['lab'] : '';

if (empty($lab)) {
    die("Error: No lab specified");
}

$sql = "SELECT id, title, description, repeat_weekly, days, start_date AS start, end_date AS end, all_day, start_time, end_time, type FROM schedules WHERE lab = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $lab);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Error: " . $conn->error);
}

$schedules = array();

while ($row = $result->fetch_assoc()) {
    $startDate = new DateTime($row['start']);
    $endDate = new DateTime($row['end']);
    $endDate->modify('+1 day');

    if (!$row['repeat_weekly']) {
        if ($row['all_day']) {
            $event = array(
                'title' => $row['title'],
                'description' => $row['description'],
                'start' => $row['start'],
                'end' => $endDate->format('Y-m-d'),
                'type' => $row['type'],
                'allDay' => true
            );
            $schedules[] = $event;
        } else {
            $currentDate = clone $startDate;
            $interval = new DateInterval('P1D');

            while ($currentDate < $endDate) {
                $event = array(
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'start' => $currentDate->format('Y-m-d') . 'T' . $row['start_time'],
                    'end' => $currentDate->format('Y-m-d') . 'T' . $row['end_time'],
                    'type' => $row['type'],
                    'allDay' => false
                );
                $schedules[] = $event;
                $currentDate->add($interval);
            }
        }
    } else {
        $daysOfWeek = explode(',', $row['days']);
        $daysOfWeek = array_map('trim', $daysOfWeek);

        foreach ($daysOfWeek as $day) {
            $currentDate = clone $startDate;
            $interval = new DateInterval('P1W');

            while ($currentDate < $endDate) {
                if ($currentDate->format('D') == $day) {
                    $recurringEvent = array(
                        'title' => $row['title'],
                        'description' => $row['description'],
                        'start' => $row['all_day'] ? $currentDate->format('Y-m-d') : $currentDate->format('Y-m-d') . 'T' . $row['start_time'],
                        'end' => $row['all_day'] ? $currentDate->format('Y-m-d') : $currentDate->format('Y-m-d') . 'T' . $row['end_time'],
                        'type' => $row['type'],
                        'allDay' => $row['all_day'] ? true : false
                    );

                    $schedules[] = $recurringEvent;
                }
                $currentDate->add($interval);
            }
        }
    }
}

echo json_encode($schedules);

$conn->close();
?>
