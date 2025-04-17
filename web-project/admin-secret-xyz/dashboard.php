<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
require '../db.php';

// Success/error messages
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

// Get all destinations
$result = $conn->query("SELECT * FROM destinations ORDER BY title ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelEase Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css?v=1.0">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-plane"></i> TravelEase Destinations</h1>
            <div class="header-actions">
                <button class="button button-add">
                    <i class="fas fa-plus"></i> <a href="add.php">Add New Destination</a>
                </button>
                <button class="button button-logout">
                    <i class="fas fa-sign-out-alt"></i> <a href="logout.php">Logout</a>
                </button>
            </div>
        </div>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Nights/Days</th>
                    <th>Cost</th>
                    <th>Rating</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><img src="../uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>"></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td class="description" title="<?= htmlspecialchars($row['description']) ?>">
                        <?= htmlspecialchars($row['description']) ?>
                    </td>
                    <td><?= $row['nights'] ?>N/<?= $row['days'] ?>D</td>
                    <td>Rs. <?= number_format($row['cost'], 2) ?></td>
                    <td>
                        <?php
                        $rating = $row['rating'] ?? 0;
                        $fullStars = floor($rating);
                        $hasHalfStar = ($rating - $fullStars) >= 0.5;
                        
                        for ($i = 0; $i < $fullStars; $i++) {
                            echo '<i class="fas fa-star" style="color: #ffcc00;"></i>';
                        }
                        if ($hasHalfStar) {
                            echo '<i class="fas fa-star-half-alt" style="color: #ffcc00;"></i>';
                        }
                        for ($i = 0; $i < (5 - $fullStars - ($hasHalfStar ? 1 : 0)); $i++) {
                            echo '<i class="far fa-star" style="color: #ffcc00;"></i>';
                        }
                        ?>
                        <span>(<?= number_format($rating, 1) ?>)</span>
                    </td>
                    <td class="actions">
                        <a href="edit.php?id=<?= $row['id'] ?>" class="edit" title="Edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="delete" title="Delete" 
                           onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars(addslashes($row['title'])) ?>? This action cannot be undone.');">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>