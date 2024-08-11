<?php
session_start();
include '../../controllers/checker.php';

include '../../models/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO personnel (name, username, password, role) VALUES (?, ?, ?, 'student')");
    $stmt->bind_param("sss", $name, $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: ../../index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>