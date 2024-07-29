<?php
include '../../models/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $semester = $_POST['semester'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $startColumn = 'sem' . $semester . '-start';
    $endColumn = 'sem' . $semester . '-end';

    $sql = "UPDATE semester SET `$startColumn` = ?, `$endColumn` = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $startDate, $endDate);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
