<?php
include '../../models/database.php';

// Fetch events from the database
$sql = "SELECT * FROM sched";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $start = new DateTime($row['semester_start']);
        $end = new DateTime($row['semester_end']);
        $interval = new DateInterval('P1W');

        $dayOfWeek = date('w', strtotime($row['day']));
        $start->modify('+' . (($dayOfWeek - $start->format('w') + 7) % 7) . ' days');

        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $date) {
            $events[] = array(
                'id' => $row['id'],  // Add this line
                'title' => $row['subject'],
                'start' => $date->format('Y-m-d') . 'T' . $row['start_time'],
                'end' => $date->format('Y-m-d') . 'T' . $row['end_time']
            );
        }
    }
}

echo json_encode($events);

$conn->close();
?>