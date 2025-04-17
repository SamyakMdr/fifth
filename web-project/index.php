<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelEase - Explore the World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css?v1.0">
    <script src="script.js?v=2 defer"></script>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-plane"></i>
            <span>TravelEase</span>
        </div>
        <div id="searchStatus" style="display: none;">
        <div class="loading-indicator" style="display: none;">
            <i class="fas fa-spinner fa-spin"></i> Searching...
        </div>
        <div class="no-results" style="display: none; color: #ff6b6b; margin: 20px 0;">
            <i class="fas fa-exclamation-circle"></i> No tours found matching your search.
        </div>
    </div>
        <ul class="nav-links" id="navLinks">
            <li><a href="#">Home</a></li>            
            <li><a href="#">Tours</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li>
                <button class="book-now-btn">Book Now</button>
            </li>
        </ul>
        <div class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    <!-- Landing Page Image -->
    <div class="landing-image">
        <img src="img/banner.png" alt="Landing Image" width="100%">
    </div>

    <!-- Dynamic Tour Cards -->
    <section class="tour-section">
        <h2>Explore Destinations</h2>
        <h6>Visit the tour packages at affortable price</h6>
        <div class="tour-container">
        <?php
            require 'db.php';
            $q = $conn->query("SELECT * FROM destinations");
            while ($r = $q->fetch_assoc()):
            ?>
            <div class="tour-card" onclick="window.location.href='tour-details.php?id=<?= $r['id'] ?>'">
    <img src="uploads/<?= $r['image'] ?>" alt="<?= $r['title'] ?>">
    <h3><?= $r['title'] ?></h3>
    <p class="tour-description"><?= $r['description'] ?></p>
    <p><strong><?= $r['nights'] ?>N/<?= $r['days'] ?>D</strong></p>
    <p>Rs. <?= $r['cost'] ?></p>

    <div class="rating">
    <?php 
    $rating = $r['rating']; // Get rating from database instead of random
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
    ?>
    <span>(<?= number_format($rating, 1) ?>)</span>
</div>

    <a href="reserve.php?id=<?= $r['id'] ?>" class="reserve-btn" onclick="event.stopPropagation()">Reserve</a>
</div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <h2 class="section-title">Get in Touch</h2>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Contact Information</h3>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h4>Address</h4>
                        <p>123 Travel Street, Kathmandu, Nepal</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <h4>Phone</h4>
                        <p>+977 1234567890</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h4>Email</h4>
                        <p>info@travelease.com</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <h4>Working Hours</h4>
                        <p>Mon-Fri: 9AM - 6PM</p>
                        <p>Sat: 10AM - 4PM</p>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <form id="contactForm" action="process_form.php" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name*</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address*</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject*</label>
                        <input type="text" id="subject" name="subject" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message*</label>
                        <textarea id="message" name="message" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
