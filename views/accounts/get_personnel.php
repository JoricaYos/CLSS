<?php
include '../../models/database.php';

$sql = "SELECT id, name, role, username, status
        FROM personnel
        ORDER BY id DESC";

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
