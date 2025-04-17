<?php
require 'db.php';

$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

// Prepare SQL query with LIKE for partial matching
$query = "SELECT * FROM destinations WHERE 
          title LIKE ? OR 
          description LIKE ? OR 
          location LIKE ?";

$stmt = $conn->prepare($query);
$searchParam = "%$searchTerm%";
$stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();

$hasResults = false;

while ($r = $result->fetch_assoc()):
    $hasResults = true;
?>
<div class="tour-card">
    <img src="uploads/<?= htmlspecialchars($r['image']) ?>" alt="<?= htmlspecialchars($r['title']) ?>">
    <h3><?= htmlspecialchars($r['title']) ?></h3>
    <p class="tour-description"><?= htmlspecialchars($r['description']) ?></p>
    <p><strong><?= htmlspecialchars($r['nights']) ?>N/<?= htmlspecialchars($r['days']) ?>D</strong></p>
    <p>Rs. <?= htmlspecialchars($r['cost']) ?></p>
    <div class="rating">
        <?php 
        $rating = rand(35, 50) / 10; 
        $fullStars = floor($rating);
        $hasHalfStar = ($rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
        
        for ($i = 0; $i < $fullStars; $i++) {
            echo '<i class="fas fa-star"></i>';
        }
        if ($hasHalfStar) {
            echo '<i class="fas fa-star-half-alt"></i>';
        }
        for ($i = 0; $i < $emptyStars; $i++) {
            echo '<i class="far fa-star"></i>';
        }
        if ($rating == 0) {
            echo str_repeat('<i class="far fa-star"></i>', 5);
        }
        ?>
        <span>(<?= number_format($rating, 1) ?>)</span>
    </div>
    <a href="reserve.php?id=<?= $r['id'] ?>" class="reserve-btn">Reserve</a>
</div>
<?php 
endwhile;

if (!$hasResults) {
    // Return empty string which will trigger no results message
    echo '';
}
?>