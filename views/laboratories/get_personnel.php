<?php
include '../../models/database.php';

$sql = "SELECT id, name FROM personnel WHERE role = 'personnel' ORDER BY name";
$result = $conn->query($sql);

$personnel = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $personnel[] = $row;
    }
}

echo json_encode($personnel);

$conn->close();
?>