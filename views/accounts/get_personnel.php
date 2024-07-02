<?php
include '../../models/database.php';

$sql = "SELECT p.name, p.role, p.username, COUNT(s.id) AS reservations
        FROM personnel p
        LEFT JOIN schedules s ON p.name = s.personnel
        GROUP BY p.name, p.role, p.username";

$result = $conn->query($sql);

$personnel = array();
if ($result->num_rows > 0) {
    $count = 1;
    while($row = $result->fetch_assoc()) {
        $row['#'] = $count++;
        $personnel[] = $row;
    }
}

echo json_encode(array("data" => $personnel));
$conn->close();
?>
