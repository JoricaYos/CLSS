<?php
session_start();
require_once '../models/database.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "SELECT * FROM personnel WHERE username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        $_SESSION['username'] = $user;
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['img'] = $row['img'];
        $_SESSION['password'] = $row['password'];

        if ($row['role'] == 'Admin' || $row['role'] == 'Personnel') {
            header("Location: ../views/dashboard/dashboard.php");
        } else {
            header("Location: ../views/laboratories/lab1.php");
        }
        exit();
    } else {
        header("Location: ../index.php?error=invalid_password");
    }
} else {
    header("Location: ../index.php?error=no_user");
}
$conn->close();
?>
