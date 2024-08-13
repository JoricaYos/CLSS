<?php
include '../../models/database.php';
session_start();

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['role'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $password = password_hash($username, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO personnel (name, username, role, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $username, $role, $password);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "New personnel added successfully";
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $response['success'] = false;
        $response['message'] = "Required fields are missing";
    }

    $conn->close();
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
