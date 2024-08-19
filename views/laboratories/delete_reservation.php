<?php
include '../../models/database.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$sql = "DELETE FROM reserve WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to delete reservation']);
}

$stmt->close();
$conn->close();
?>