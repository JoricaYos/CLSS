<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: ../views/dashboard/dashboard.php");
    exit();
}
?>
