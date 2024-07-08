<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include($_SERVER['DOCUMENT_ROOT'] . '/models/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $img = "";

    if ($password !== $confirmPassword) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
        exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $_SESSION['id'] . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $img = 'uploads/' . $_SESSION['id'] . '/' . basename($_FILES['profile_image']['name']);
        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . basename($_FILES['profile_image']['name']))) {
            echo json_encode(['status' => 'error', 'message' => 'Error uploading image']);
            exit();
        }
    } else {
        $img = $_SESSION['img'];
    }

    $sql = "UPDATE personnel SET name='$name', username='$username', password='$hashedPassword', img='$img' WHERE id=" . $_SESSION['id'];

    if ($conn->query($sql) === TRUE) {
        $_SESSION['name'] = $name;
        $_SESSION['username'] = $username;
        $_SESSION['img'] = $img;
        echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating profile: ' . $conn->error]);
    }

    $conn->close();
}
?>
