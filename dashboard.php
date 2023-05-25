<?php
session_start();
require_once 'db_config.php';

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch user's photos
$stmt = $pdo->prepare('SELECT * FROM photos WHERE user_id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Photographer Website</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Welcome, <?php echo $user['username']; ?>!</h1>

    <form method="POST" action="upload_photo.php" enctype="multipart/form-data">
        <input type="file" name="photo" accept=".jpg, .jpeg, .png">
        <input type="submit" value="Upload Photo">
    </form>

    <div class="photos-grid">
        <?php foreach ($photos as $photo): ?>
            <div class="photo">
                <img src="<?php echo $photo['path']; ?>" alt="<?php echo $photo['title']; ?>">
                <p><?php echo $photo['title']; ?></p>
                <a href="delete_photo.php?id=<?php echo $photo['id']; ?>">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>

    <p><a href="profile.php">Edit Profile</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
