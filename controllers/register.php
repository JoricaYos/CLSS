<?php
session_start();
require_once '../models/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $sql = $conn->prepare("INSERT INTO personnel (username, password) VALUES (?, ?)");
    $sql->bind_param("ss", $user, $hashed_password);

    if ($sql->execute()) {
        header('Location: ../views/index.php');
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
