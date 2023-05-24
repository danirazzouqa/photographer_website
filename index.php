<?php
session_start();
require_once 'db_config.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>Photographer Website</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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
</body>
</html>
