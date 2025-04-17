<?php
require 'db.php';

$q = $conn->query("SELECT * FROM destinations");
while ($r = $q->fetch_assoc()):
?>
<div class="tour-card">
    <img src="uploads/<?= $r['image'] ?>" alt="<?= $r['title'] ?>">
    <h3><?= $r['title'] ?></h3>
    <p class="tour-description"><?= $r['description'] ?></p>
    <p><strong><?= $r['nights'] ?>N/<?= $r['days'] ?>D</strong></p>
    <p>Rs. <?= $r['cost'] ?></p>
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
<?php endwhile; ?>