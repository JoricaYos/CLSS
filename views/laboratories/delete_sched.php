<?php
include '../../models/database.php';

$id = isset($_POST['id']) ? $_POST['id'] : '';

if (empty($id)) {
    die(json_encode(array('success' => false, 'error' => 'No schedule ID specified')));
}

$sql = "DELETE FROM schedules WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => 'Error deleting schedule: ' . $conn->error));
}

?>