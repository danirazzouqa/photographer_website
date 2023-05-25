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

// Check if profile update form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare('UPDATE users SET username = :username, email = :email WHERE id = :user_id');
    $stmt->execute(['username' => $username, 'email' => $email, 'user_id' => $user_id]);

    // Redirect to same page to reflect changes
    header('Location: profile.php');
    exit();
}

// Check if password change form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password == $confirm_password) {
        // Password hashing for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('UPDATE users SET password = :password WHERE id = :user_id');
        $stmt->execute(['password' => $hashed_password, 'user_id' => $user_id]);

        // Redirect to same page to reflect changes
        header('Location: profile.php');
        exit();
    } else {
        $password_error = "Passwords do not match";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <nav >
            <div >
                <div >
                    <ul class="header-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
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

        <div class="edit-profile">
            <h2>Edit Profile</h2>
            <form method="POST">
                <label>Username: <input type="text" name="username" value="<?php echo $user['username']; ?>" required></label><br>
                <label>Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" required></label><br>
                <input type="submit" name="update_profile" value="Update">
            </form>
        </div>

        <div class="change-password">
            <h2>Change Password</h2>
            <form method="POST">
                <input class="c" type="text" name="password" required value="password"><br>
                <input class="c" type="text" name="confirm_password" value="confirm password" required><br>
                <input type="submit" name="change_password" value="Change Password">
            </form>
            <?php if (isset($password_error)): ?>
                <p><?php echo $password_error; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
