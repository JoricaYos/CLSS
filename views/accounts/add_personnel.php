<?php
include '../../models/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['role']) && isset($_POST['sched-color'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $schedColor = $_POST['sched-color'];
        $password = password_hash($username, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO personnel (name, username, role, password, `sched-color`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $username, $role, $password, $schedColor);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "New personnel added successfully";
        } else {
            $_SESSION['error_message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Required fields are missing";
    }

    $conn->close();
    header("Location: accounts.php");
    exit();
}
?>
