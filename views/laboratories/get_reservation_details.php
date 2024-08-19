<?php
include '../../models/database.php';
session_start();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM reserve WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $row['current_user'] = $_SESSION['id']; 
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Reservation not found']);
}

$stmt->close();
$conn->close();
?>
