<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../models/database.php';

$sql = "SELECT id, title, description, repeat_weekly, days, start_date AS start, end_date AS end, all_day, start_time, end_time FROM schedules";
$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}

$schedules = array();

while ($row = $result->fetch_assoc()) {
    $startDate = new DateTime($row['start']);
    $endDate = new DateTime($row['end']);
    
    // Create the initial event
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

    // Handle weekly recurrence
    if ($row['repeat_weekly']) {
        $daysOfWeek = explode(',', $row['days']);
        $daysOfWeek = array_map('trim', $daysOfWeek);
        
        foreach ($daysOfWeek as $day) {
            $currentDate = clone $startDate;
            $interval = new DateInterval('P1W');

            while ($currentDate <= $endDate) {
                if ($currentDate->format('D') == $day) {
                    $recurringEvent = array(
                        'title' => $row['title'],
                        'start' => $currentDate->format('Y-m-d') . (!$row['all_day'] ? 'T' . $row['start_time'] : ''),
                        'end' => $currentDate->format('Y-m-d') . (!$row['all_day'] ? 'T' . $row['end_time'] : '')
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
