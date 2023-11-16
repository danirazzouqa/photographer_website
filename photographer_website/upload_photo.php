<?php
// upload_photo.php
session_start();
require_once 'db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png');
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($extension), $allowed)) {
            $filename = uniqid() . "." . $extension;
            $destination = 'uploads/' . $filename;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $destination)) {
                $user_id = $_SESSION['user_id'];
                $stmt = $pdo->prepare('INSERT INTO photos (user_id, path) VALUES (:user_id, :path)');
                $stmt->execute(['user_id' => $user_id, 'path' => $destination]);

                header('Location: dashboard.php');
                exit();
            }
        }
    }

    echo "File upload failed.";
}
?>
