<?php
include '../session_bootstrap.php';
include '../db.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("UPDATE property SET status = 'Sold' WHERE property_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: view_property.php");
exit();
?>
