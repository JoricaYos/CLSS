<?php
include '../../models/database.php';

$id = $_GET['id'];

$sql = "SELECT s.subject, p.name AS personnel, s.start_time, s.end_time 
        FROM sched s 
        JOIN personnel p ON s.personnel_id = p.id 
        WHERE s.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Event not found']);
}

$stmt->close();
$conn->close();
?>