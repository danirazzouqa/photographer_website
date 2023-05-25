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

// Determine the current page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

// Define the number of records per page
$photos_per_page = 8;

// Prepare SQL to fetch photos with limit and offset
$stmt = $pdo->prepare('SELECT * FROM photos WHERE user_id = :user_id LIMIT :offset, :limit');
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':offset', ($page - 1) * $photos_per_page, PDO::PARAM_INT);
$stmt->bindValue(':limit', $photos_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the photos for the current page
$photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total number of pages
$stmt = $pdo->prepare('SELECT COUNT(*) FROM photos WHERE user_id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$total_photos = $stmt->fetchColumn();
$total_pages = ceil($total_photos / $photos_per_page);
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

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?php echo $i; ?></strong>
            <?php else: ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>

    <p><a href="profile.php">Edit Profile</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
