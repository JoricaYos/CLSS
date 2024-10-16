<?php
session_start();
require_once '../models/database.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM personnel WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        if ($row['status'] === 'active') {
            $_SESSION['username'] = $user;
            $_SESSION['role'] = $row['role'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['img'] = $row['img'];
            $_SESSION['password'] = $row['password'];


            // condition for logging in, based on what role the account was logged in (navigates depending on the account role)
            if ($row['role'] == 'Admin' || $row['role'] == 'Instructor' || $row['role'] == 'Dean/Principal' || $row['role'] == 'Custodian') {
                header("Location: ../views/dashboard/dashboard.php");
            } else {
                header("Location: ../views/laboratories/lab.php");
            }
            exit();
        } else {
            header("Location: ../index.php?error=inactive_status");
        }
    } else {
        header("Location: ../index.php?error=invalid_password");
    }
} else {
    header("Location: ../index.php?error=no_user");
}
$conn->close();
?>