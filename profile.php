<?php
session_start();
require_once 'db_config.php';

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Set user_id variable
$user_id = $_SESSION['user_id'];

// Check if profile update form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare('UPDATE users SET username = :username, email = :email WHERE id = :user_id');
    $stmt->execute(['username' => $username, 'email' => $email, 'user_id' => $user_id]);

    // Redirect to the same page to reflect changes
    header('Location: profile.php');
    exit();
}

// Check if password change form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password == $confirm_password) {
        // Password hashing for security
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('UPDATE users SET password = :password WHERE id = :user_id');
        $stmt->execute(['password' => $hashed_password, 'user_id' => $user_id]);

        // Redirect to the same page to reflect changes
        header('Location: profile.php');
        exit();
    } else {
        $password_error = "Passwords do not match";
    }
}

// Fetch user details from the database
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if profile photo update form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_photo'])) {
    $profile_photo = $_FILES['profile_photo'];

    // Check if file was uploaded without errors
    if ($profile_photo['error'] === 0) {
        $file_name = $profile_photo['name'];
        $file_tmp = $profile_photo['tmp_name'];
        $file_type = $profile_photo['type'];
        $file_size = $profile_photo['size'];

        // Move the uploaded file to the uploads directory
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($file_name);

        if (move_uploaded_file($file_tmp, $target_file)) {
            // Update user record with new profile photo path
            $stmt = $pdo->prepare('UPDATE users SET photo_path = :photo_path WHERE id = :user_id');
            $stmt->execute(['photo_path' => $target_file, 'user_id' => $user_id]);

            // Redirect to the same page to reflect changes
            header('Location: profile.php');
            exit();
        } else {
            $photo_error = "There was an error uploading your photo.";
        }
    } else {
        $photo_error = "There was an error uploading your photo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="Contact Us.php">Contact Us</a></li>
            <div class="social-links">
                <a href="https://www.facebook.com/YourUsername" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.linkedin.com/in/YourUsername" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://github.com/YourUsername" target="_blank"><i class="fab fa-github"></i></a>
            </div>
            <li>
                <div class="login-register">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="logout.php">Logout</a>
                    <?php else: ?>
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </nav>
</header>
<div class="container">
    <h1 class="profileh1">Welcome, <?php echo $user['username']; ?>!</h1>
    <div class="profile">
        <?php if ($user['photo_path'] && file_exists($user['photo_path'])): ?>
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
            <input type="submit" name="update_profile" value="Update Profile">
        </form>
    </div>
    <div class="change-password">
        <h2>Change Password</h2>
        <form method="POST">
            <label>New Password: <input type="password" name="new_password" required></label><br>
            <label>Confirm Password: <input type="password" name="confirm_password" required></label><br>
            <input type="submit" name="change_password" value="Change Password">
        </form>
        <?php if (isset($password_error)): ?>
            <p><?php echo $password_error; ?></p>
        <?php endif; ?>
    </div>
    <?php if (isset($photo_error)): ?>
        <p><?php echo $photo_error; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
