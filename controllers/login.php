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

        if ($row['role'] == 'Admin') {
            header("Location: ../views/dashboard/dashboard.php");
        } elseif ($row['role'] == 'Personnel') {
            header("Location: ../views/dashboard/dashboard.php");
        } elseif ($row['role'] == 'View1') {
            header("Location: ../views/view-only/view1.php");
        } elseif ($row['role'] == 'View2') {
            header("Location: ../views/view-only/view2.php");
        } elseif ($row['role'] == 'View3') {
            header("Location: ../views/view-only/view3.php");
        } elseif ($row['role'] == 'View4') {
            header("Location: ../views/view-only/view4.php");
        } else {
            header("Location: ../views/laboratories/lab1.php");
        }
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found.";
}
$conn->close();
?>