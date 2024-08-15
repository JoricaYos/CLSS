<?php
include '../../models/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);
    
    $sql = "DELETE FROM sched WHERE id = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Schedule deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting schedule: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

$conn->close();