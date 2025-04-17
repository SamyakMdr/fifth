<?php 
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM destinations WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$tour = $result->fetch_assoc();

if (!$tour) {
    header("Location: index.php");
    exit();
}

// Process highlights and itinerary from database
$highlights = !empty($tour['highlights']) ? explode("\n", $tour['highlights']) : [];
$itinerary = !empty($tour['itinerary']) ? explode("\n", $tour['itinerary']) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tour['title']) ?> | TravelEase</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v1.0">
    <style>
        .tour-details {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .tour-header {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .tour-image {
            flex: 1;
            border-radius: 8px;
            overflow: hidden;
            max-height: 400px;
        }
        
        .tour-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        .tour-info {
            flex: 1;
        }
        
        .tour-title {
            font-size: 2.2em;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .tour-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .tour-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .tour-price {
            font-size: 1.8em;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .tour-description {
            line-height: 1.8;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
            text-align: left;
        }
        
        .tour-highlights {
            margin: 40px 0;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        
        .highlight-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .highlight-item i {
            margin-right: 10px;
            color: #3498db;
            margin-top: 3px;
        }
        
        .reserve-btn-large {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 15px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1em;
            transition: all 0.3s;
            margin-top: 20px;
        }
        
        .reserve-btn-large:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .tour-itinerary {
            margin: 40px 0;
        }
        
        .itinerary-accordion {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
        }.itinerary-accordion {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .itinerary-item {
        margin-bottom: 5px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
    }
    
    .itinerary-day {
        padding: 15px;
        background-color: #f8f9fa;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.3s;
    }
    
    .itinerary-day:hover {
        background-color: #e9ecef;
    }
    
    .accordion-icon {
        transition: transform 0.3s;
    }
    
    .itinerary-activities {
        padding: 0 15px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, padding 0.3s ease;
        line-height: 1.6;
    }
    
    .itinerary-item.active .itinerary-activities {
        padding: 15px;
        max-height: 1000px; /* Adjust based on your content */
    }
    
    .itinerary-item.active .accordion-icon {
        transform: rotate(180deg);
    }
        
        .rating {
            margin: 15px 0;
        }
        
        .rating .fas.fa-star {
            color: #ffcc00;
        }
        
        .rating .fas.fa-star-half-alt {
            color: #ffcc00;
        }
        
        .rating .far.fa-star {
            color: #ffcc00;
        }
        
        .rating-value {
            margin-left: 5px;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .tour-header {
                flex-direction: column;
            }
            
            .tour-image {
                max-height: 300px;
            }
            
            .tour-meta {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-plane"></i>
            <span>TravelEase</span>
        </div>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Home</a></li>            
            <li><a href="index.php#tours">Tours</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li>
                <button class="book-now-btn">Book Now</button>
            </li>
        </ul>
        <div class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    <div class="tour-details">
        <div class="tour-header">
            <div class="tour-image">
                <img src="uploads/<?= htmlspecialchars($tour['image']) ?>" alt="<?= htmlspecialchars($tour['title']) ?>">
            </div>
            <div class="tour-info">
                <h1 class="tour-title"><?= htmlspecialchars($tour['title']) ?></h1>
                
                <div class="tour-meta">
                    <span><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($tour['days']) ?> Days</span>
                    <span><i class="fas fa-moon"></i> <?= htmlspecialchars($tour['nights']) ?> Nights</span>
                    <?php if (!empty($tour['location'])): ?>
                        <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($tour['location']) ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="tour-price">Rs. <?= number_format($tour['cost'], 2) ?></div>
                
                <div class="rating">
                    <?php 
                    $rating = $tour['rating'] ?? 0;
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
                    <span class="rating-value">(<?= number_format($rating, 1) ?>)</span>
                </div>
                
                <a href="reserve.php?id=<?= $tour['id'] ?>" class="reserve-btn-large">
                    <i class="fas fa-calendar-check"></i> Reserve Now
                </a>
            </div>
        </div>
        
        
        <div class="tour-description">
            <h2 class="section-title">Tour Description</h2>
                <div class="description-container">
                    <p class="description-text" id="descriptionText">
                        <?= nl2br(htmlspecialchars($tour['description'])) ?>
                    </p>
                <?php if (strlen($tour['description']) > 300): ?>
                    <button class="read-more-btn" id="readMoreBtn">Read More</button>
                <?php endif; ?>
                </div>
        </div>

        <?php if (!empty($highlights)): ?>
        <div class="tour-highlights">
            <h2 class="section-title">Tour Highlights</h2>
            <?php foreach ($highlights as $highlight): ?>
                <?php if (!empty(trim($highlight))): ?>
                    <div class="highlight-item">
                        <i class="fas fa-check-circle"></i>
                        <span><?= htmlspecialchars(trim($highlight)) ?></span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($itinerary)): ?>
        <div class="tour-itinerary">
            <h2 class="section-title">Daily Itinerary</h2>
                <div class="itinerary-accordion">
                    <?php foreach ($itinerary as $day): ?>
                        <?php if (!empty(trim($day))): ?>
                            <?php 
                            $dayParts = explode(':', $day, 2);
                            $dayTitle = trim($dayParts[0]);
                            $activities = isset($dayParts[1]) ? trim($dayParts[1]) : '';
                            ?>
                            <div class="itinerary-item">
                                <div class="itinerary-day">
                                    <?= htmlspecialchars($dayTitle) ?>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="itinerary-activities">
                                    <?= htmlspecialchars($activities) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
        </div>

    <?php endif; ?>

    </div>


    <section class="contact-section">
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


    
    <script src="script.js?v=2"></script>
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const descriptionText = document.getElementById('descriptionText');
        const readMoreBtn = document.getElementById('readMoreBtn');
        
        if (descriptionText && readMoreBtn) {
            // Initially collapse long descriptions
            descriptionText.classList.add('collapsed');
            
            readMoreBtn.addEventListener('click', function() {
                descriptionText.classList.toggle('collapsed');
                readMoreBtn.classList.toggle('expanded');
                readMoreBtn.textContent = descriptionText.classList.contains('collapsed') ? 'Read More' : 'Read Less';
            });
        }
    });

document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.itinerary-item');
    
    // Initialize all items as collapsed
    items.forEach(item => {
        item.classList.remove('active');
        
        // Add click event to each day header
        const dayHeader = item.querySelector('.itinerary-day');
        dayHeader.addEventListener('click', function() {
            // Toggle the clicked item
            item.classList.toggle('active');
            
            // Optional: Close other open items
            /*
            items.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            */
        });
    });
});
</script>
</body>
</html>