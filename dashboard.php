<?php
session_start();
require_once 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch user's photos
$query = "SELECT * FROM photos WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$photos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Photographer Website</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Welcome, <?php echo $user['username']; ?>!</h1>
    <p><a href="index.php">Home</a></p>
    <h2>Your Photos:</h2>
    <?php foreach ($photos as $photo) { ?>
        <div class="photo">
            <h3><?php echo $photo['title']; ?></h3>
            <p><?php echo $photo['description']; ?></p>
            <p>Created at: <?php echo $photo['created_at']; ?></p>
        </div>
    <?php } ?>
    <p><a href="profile.php">Edit Profile</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>