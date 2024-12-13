<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$room_id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = :id");
    $stmt->execute([':id' => $room_id]);
    header("Location: room_manage.php");
    exit;
} catch (PDOException $e) {
    die("Error deleting room: " . $e->getMessage());
}
?>
