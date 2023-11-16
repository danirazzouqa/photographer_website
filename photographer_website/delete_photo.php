<?php
// delete_photo.php
session_start();
require_once 'db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $photo_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('SELECT * FROM photos WHERE id = :photo_id AND user_id = :user_id');
    $stmt->execute(['photo_id' => $photo_id, 'user_id' => $user_id]);
    $photo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($photo) {
        unlink($photo['path']);

        $stmt = $pdo->prepare('DELETE FROM photos WHERE id = :photo_id AND user_id = :user_id');
        $stmt->execute(['photo_id' => $photo_id, 'user_id' => $user_id]);
    }

    header('Location: dashboard.php');
    exit();
}
?>
