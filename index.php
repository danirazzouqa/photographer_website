<?php
session_start();
require_once 'db_config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Photographer Website</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
    <header>
        <nav style="background-color: crimson;">
            <ul class="header-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profile.php">Profile</a></li>
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
        <h1>Welcome to the Photographer Website!</h1>
        <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to access the dashboard.</p>

        <h2>About</h2>
        <p>This website is dedicated to photographers who want to showcase their work and connect with their audience.</p>

        <h2>Features</h2>
        <ul>
            <li>Register an account to create a profile and manage your photos.</li>
            <li>Login to access your dashboard and view your uploaded photos.</li>
            <li>Edit your profile information to personalize your online presence.</li>
            <li>Add, update, or delete your photos to showcase your portfolio.</li>
        </ul>

        <h2>Contact</h2>
        <p>For any inquiries or support, please email us at contact@photographerwebsite.com.</p>
    </div>
</body>
</html>
