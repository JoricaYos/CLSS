<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/models/database.php');

if (!isset($_SESSION['id'])) {
    echo json_encode(array('error' => 'User not logged in'));
    exit;
}

$personnel_id = $_SESSION['id'];

$sql = "SELECT title, start_date, start_time, end_time 
        FROM reserve 
        WHERE personnel_id = ?
        ORDER BY start_date DESC, start_time DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $personnel_id);
$stmt->execute();
$result = $stmt->get_result();

$reservations = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

echo json_encode($reservations);

$stmt->close();
$conn->close();
?>