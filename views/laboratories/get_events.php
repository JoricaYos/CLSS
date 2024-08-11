<?php
include '../../models/database.php';

$lab = isset($_GET['lab']) ? $_GET['lab'] : 'lab1';
$lab = $conn->real_escape_string($lab);

$events = array();

// Fetch schedules
$sql = "SELECT * FROM sched WHERE lab = '$lab'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $start = new DateTime($row['semester_start']);
        $end = new DateTime($row['semester_end']);
        $interval = new DateInterval('P1W');

        $dayOfWeek = date('w', strtotime($row['day']));
        $start->modify('+' . (($dayOfWeek - $start->format('w') + 7) % 7) . ' days');

        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $date) {
            $events[] = array(
                'id' => 'sched_' . $row['id'],
                'title' => $row['subject'],
                'start' => $date->format('Y-m-d') . 'T' . $row['start_time'],
                'end' => $date->format('Y-m-d') . 'T' . $row['end_time'],
                'color' => '#2F48A1', // Blue color for schedules
                'type' => 'schedule'
            );
        }
    }
}

// Fetch reservations
$sql = "SELECT * FROM reserve WHERE lab = '$lab'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = array(
            'id' => 'reserve_' . $row['id'],
            'title' => $row['title'],
            'start' => $row['start_date'] . 'T' . $row['start_time'],
            'end' => $row['end_date'] . 'T' . $row['end_time'],
            'color' => '#28a745', // Green color for reservations
            'type' => 'reservation',
            'classNames' => ['reservation-event']
        );
    }
}

echo json_encode($events);

$conn->close();
?>