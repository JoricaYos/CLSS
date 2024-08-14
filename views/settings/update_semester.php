<?php
include '../../models/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $semester = $_POST['semester'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $startColumn = 'sem' . $semester . '_start';
    $endColumn = 'sem' . $semester . '_end';

    $conn->begin_transaction();

    try {
        $sql1 = "UPDATE semester SET `$startColumn` = ?, `$endColumn` = ? WHERE id = 1";
        $stmt1 = $conn->prepare($sql1);

        if (!$stmt1) {
            throw new Exception("Preparation failed: " . $conn->error);
        }

        $stmt1->bind_param("ss", $startDate, $endDate);

        if (!$stmt1->execute()) {
            throw new Exception("Execution failed: " . $stmt1->error);
        }

        $stmt1->close();

        $sql2 = "UPDATE sched SET semester_start = ?, semester_end = ? WHERE semester = ?";
        $stmt2 = $conn->prepare($sql2);

        if (!$stmt2) {
            throw new Exception("Preparation failed: " . $conn->error);
        }

        $stmt2->bind_param("ssi", $startDate, $endDate, $semester);

        if (!$stmt2->execute()) {
            throw new Exception("Execution failed: " . $stmt2->error);
        }

        $stmt2->close();

        $conn->commit();
        echo "success";
    } catch (Exception $e) {
        $conn->rollback();
        echo "error: " . $e->getMessage();
    }

    $conn->close();
}
?>