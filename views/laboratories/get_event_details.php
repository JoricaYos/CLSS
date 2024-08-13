<?php
include '../../models/database.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$id = $conn->real_escape_string($id);

$sql = "SELECT s.*, p.name as personnel_name 
        FROM sched s 
        LEFT JOIN personnel p ON s.personnel_id = p.id 
        WHERE s.id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $event = array(
        'id' => $row['id'],
        'subject' => $row['subject'],
        'personnel_id' => $row['personnel_id'],
        'personnel_name' => $row['personnel_name'],
        'semester' => $row['semester'],
        'day' => $row['day'],
        'start_time' => $row['start_time'],
        'end_time' => $row['end_time'],
        'lab' => $row['lab']
    );
    echo json_encode($event);
} else {
    echo json_encode(array('error' => 'Event not found'));
}

$conn->close();
?>