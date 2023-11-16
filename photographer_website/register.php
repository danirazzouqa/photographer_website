<?php
session_start();
require_once 'db_config.php';

$error = []; // array to hold validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate username, email and password
    if (empty($username)) {
        $error['username'] = "Username is required";
    }
    if (empty($email)) {
        $error['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Invalid email format";
    }
    if (empty($password)) {
        $error['password'] = "Password is required";
    }

    // If validation passes
    if (empty($error)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL statement to insert new user
        $sql = "INSERT INTO users (username, email, password, photo_path) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $email, $hashedPassword, $photoPath]);
            header('Location: login.php'); // redirect to login page after successful registration
        } catch (PDOException $e) {
            $error['database'] = "Error: Could not execute $sql. " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Register</h1>
        <form  method="POST" action="">
            <div class="register">
            <div >
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <?php if (isset($error['username'])): ?>
                    <p><?php echo $error['username']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <?php if (isset($error['email'])): ?>
                    <p><?php echo $error['email']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <?php if (isset($error['password'])): ?>
                    <p><?php echo $error['password']; ?></p>
                <?php endif; ?>
            </div>
            </div>

            <?php if (isset($error['database'])): ?>
                <p><?php echo $error['database']; ?></p>
            <?php endif; ?>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
