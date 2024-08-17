<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/models/database.php');

function getSchedulesCount($lab)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS count FROM sched WHERE lab = '$lab'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $conn->error;
        return 0;
    }
    $row = $result->fetch_assoc();
    return $row['count'];
}

function getReservationsCount($lab)
{
    global $conn;
    $sql = "SELECT COUNT(*) AS count FROM reserve WHERE lab = '$lab'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $conn->error;
        return 0;
    }
    $row = $result->fetch_assoc();
    return $row['count'];
}

$count_lab1_schedule = getSchedulesCount('lab1');
$count_lab2_schedule = getSchedulesCount('lab2');
$count_lab3_schedule = getSchedulesCount('lab3');
$count_lab4_schedule = getSchedulesCount('lab4');

$count_lab1_reservation = getReservationsCount('lab1');
$count_lab2_reservation = getReservationsCount('lab2');
$count_lab3_reservation = getReservationsCount('lab3');
$count_lab4_reservation = getReservationsCount('lab4');
echo json_encode([
    'schedules' => [
        'lab1' => $count_lab1_schedule,
        'lab2' => $count_lab2_schedule,
        'lab3' => $count_lab3_schedule,
        'lab4' => $count_lab4_schedule
    ],
    'reservations' => [
        'lab1' => $count_lab1_reservation,
        'lab2' => $count_lab2_reservation,
        'lab3' => $count_lab3_reservation,
        'lab4' => $count_lab4_reservation
    ]
]);