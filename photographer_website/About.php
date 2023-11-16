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
?>

<!DOCTYPE html>
<html>
<head>
    <title>About - My Photography Website</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

   
    <header>
        <nav>
            <ul >
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
                    
                </li>
            </ul>
        </nav>
    </header>
    
    <div class="container">
    <main>
        <section class="about-website">
            <h2>Our Mission</h2>
            <p>This website is dedicated to photographers who want to showcase their work and connect with their audience. We understand the passion and dedication that goes into every shot and the story each image tells. We want to provide a platform for photographers to share their unique perspectives and engage with their viewers.</p>
            <p>Our goal is to foster a vibrant and dynamic community where photographers can share their work, receive feedback, and inspire each other. From beginners to professionals, our platform welcomes photographers of all skill levels and backgrounds.</p>
        </section>

        <section class="about-features">
            <h2>Features</h2>
            <p>Photographers can create a profile, upload their photos, manage their portfolio, and interact with their audience. The website also provides a wealth of resources and information for photographers, including tutorials, articles, and a forum for discussions.</p>
            <p>Whether you are a photographer looking to showcase your work, or a viewer in search of inspiring photography, we invite you to join our community.</p>
        </section>

        <section class="contact-info">
            <h2>Contact Us</h2>
            <p>For any inquiries or support, please email us at <a href="mailto:contact@photographerwebsite.com">contact@photographerwebsite.com</a> or through the <a href="Contact Us.php">contact form</a>.</p>
        </section>
    </main>

    <footer>
        <p>© 2023 Our Photography Website. All rights reserved.</p>
    </footer>
    </div>
    </div>
</body>
</html>
