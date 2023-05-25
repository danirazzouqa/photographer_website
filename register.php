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
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $email, $hashedPassword]);
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
        <h1>Register</h1>
        <form method="POST" action="">
            <div>
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

            <?php if (isset($error['database'])): ?>
                <p><?php echo $error['database']; ?></p>
            <?php endif; ?>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
