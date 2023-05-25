<?php
session_start();
require_once 'db_config.php';

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <nav style="background-color: crimson;">
            <div class="container">
                <div class="navbar">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                    </ul>
                </div>
                <div class="navbar-right">
                    <ul>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1>Welcome, <?php echo $user['username']; ?>!</h1>

        <div class="profile">
            <?php if ($user['photo_path']): ?>
                <img src="<?php echo $user['photo_path']; ?>" alt="Profile Photo">
            <?php else: ?>
                <img src="default-profile-photo.jpg" alt="Default Profile Photo">
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="profile_photo" accept=".jpg, .png, .jpeg">
                <input type="submit" value="Upload">
            </form>
        </div>
    </div>
</body>
</html>
