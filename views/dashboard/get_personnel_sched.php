<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/models/database.php');

$personnel_id = $_SESSION['id'];

$dayOrder = [
    'Monday' => 1,
    'Tuesday' => 2,
    'Wednesday' => 3,
    'Thursday' => 4,
    'Friday' => 5,
    'Saturday' => 6,
    'Sunday' => 7
];

$labNames = [
    'lab1' => 'Computer Laboratory 1',
    'lab2' => 'Computer Laboratory 2',
    'lab3' => 'Computer Laboratory 3',
    'lab4' => 'Computer Laboratory 4'
];

$query = "SELECT subject, semester, lab, day, start_time, end_time FROM sched WHERE personnel_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $personnel_id);
$stmt->execute();
$result = $stmt->get_result();

$schedules = array();
while ($row = $result->fetch_assoc()) {
    $start = date("g:i A", strtotime($row['start_time']));
    $end = date("g:i A", strtotime($row['end_time']));
    $row['time'] = $start . ' - ' . $end;
    $row['sort_time'] = $row['start_time'];

    $row['lab'] = isset($labNames[$row['lab']]) ? $labNames[$row['lab']] : $row['lab'];

    $row['semester'] = $row['semester'] == '1' ? '1st Semester' :
        ($row['semester'] == '2' ? '2nd Semester' : $row['semester']);

    $row['sort_semester'] = $row['semester'] == '1st Semester' ? 1 : 2;

    $schedules[] = $row;
}

$stmt->close();
$conn->close();

usort($schedules, function ($a, $b) use ($dayOrder) {
    $semesterDiff = $a['sort_semester'] - $b['sort_semester'];
    if ($semesterDiff != 0) {
        return $semesterDiff;
    }

    $dayDiff = $dayOrder[$a['day']] - $dayOrder[$b['day']];
    if ($dayDiff != 0) {
        return $dayDiff;
    }
    return strtotime($a['sort_time']) - strtotime($b['sort_time']);
});

foreach ($schedules as &$schedule) {
    unset($schedule['sort_time']);
    unset($schedule['sort_semester']);
    unset($schedule['start_time']);
    unset($schedule['end_time']);
}

echo json_encode($schedules);