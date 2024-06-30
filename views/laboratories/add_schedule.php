<?php
include '../../models/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['Subject']; 
    $start_date = $_POST['StartTime'];
    $end_date = $_POST['EndTime'];
    $description = $_POST['Description'];
    $location = $_POST['Location'];

    $stmt = $conn->prepare("INSERT INTO schedules (title, start_date, end_date, description, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $start_date, $end_date, $description, $location);

    if ($stmt->execute()) {
        echo "Schedule added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
