<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
require '../db.php';

// Initialize variables
$fields = [
    'title' => '', 'description' => '', 'nights' => '', 'days' => 1, 
    'cost' => '', 'image' => '', 'rating' => 3,
    'highlights' => array_fill(0, 5, ''),
    'itinerary' => array_fill(0, 10, '')
];
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic fields
    $fields['title'] = $_POST['title'];
    $fields['description'] = $_POST['description'];
    $fields['nights'] = $_POST['nights'];
    $fields['days'] = $_POST['days'];
    $fields['cost'] = $_POST['cost'];
    $fields['rating'] = $_POST['rating'];
    
    // Process highlights (5 maximum)
    $fields['highlights'] = [];
    for ($i = 1; $i <= 5; $i++) {
        if (!empty(trim($_POST["highlight_$i"]))) {
            $fields['highlights'][] = trim($_POST["highlight_$i"]);
        }
    }
    
    // Process itinerary (up to 10 days)
    $fields['itinerary'] = [];
    for ($i = 1; $i <= 10; $i++) {
        if (!empty(trim($_POST["day_$i"]))) {
            $fields['itinerary'][] = "Day $i: " . trim($_POST["day_$i"]);
        }
    }
    
    // Handle image upload
    if (isset($_FILES['image'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_path = "../uploads/" . $image_name;
        
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $fields['image'] = $image_name;
        } else {
            $error = "Failed to upload image.";
        }
    }
    
    // Insert new destination
    if ($fields['title'] && $fields['description'] && $fields['nights'] && 
        $fields['days'] && $fields['cost'] && $fields['image']) {
        
        // Convert arrays to text for database
        $highlights_text = implode("\n", $fields['highlights']);
        $itinerary_text = implode("\n", $fields['itinerary']);
        
        $query = "INSERT INTO destinations 
                 (title, description, nights, days, cost, image, highlights, itinerary, rating) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssiidsssd", 
            $fields['title'], $fields['description'], $fields['nights'], $fields['days'], 
            $fields['cost'], $fields['image'], $highlights_text, $itinerary_text, $fields['rating']);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Destination</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="add.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f7fa;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h2 {
            color: #2c3e50;
            font-size: 2em;
        }
        
        .body {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .form-section {
            margin-bottom: 30px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        
        .form-section h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #2c3e50;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        
        input:focus, textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        
        textarea {
            min-height: 100px;
        }
        
        .highlight-item, .itinerary-day {
            margin-bottom: 15px;
        }
        
        .star-rating {
            direction: rtl;
            display: inline-block;
        }
        
        .star-rating input[type="radio"] {
            display: none;
        }
        
        .star-rating label {
            color: #ddd;
            font-size: 24px;
            padding: 0 5px;
            cursor: pointer;
        }
        
        .star-rating input[type="radio"]:checked ~ label {
            color: #ffcc00;
        }
        
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffcc00;
        }
        
        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        
        button:hover {
            background: #2980b9;
        }
        
        .submit {
            background: #95a5a6;
            margin-left: 10px;
        }
        
        .submit:hover {
            background: #7f8c8d;
        }
        
        .submit a {
            color: white;
            text-decoration: none;
        }
        
        .instructions {
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Add New Destination</h2>
    </div>
    <div class="body">
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <!-- Basic Information Section -->
            <div class="form-section">
                <h3>Basic Information</h3>
                
                <div class="form-group">
                    <label for="title">Destination Title*</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($fields['title']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description*</label>
                    <textarea name="description" required><?= htmlspecialchars($fields['description']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Star Rating*</label>
                    <div class="star-rating">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" 
                                <?= $fields['rating'] == $i ? 'checked' : '' ?> required>
                            <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nights">Nights*</label>
                    <input type="number" name="nights" value="<?= htmlspecialchars($fields['nights']) ?>" required min="1">
                </div>
                
                <div class="form-group">
                    <label for="days">Days*</label>
                    <input type="number" name="days" id="days-input" value="<?= htmlspecialchars($fields['days']) ?>" required min="1" max="10">
                </div>
                
                <div class="form-group">
                    <label for="cost">Cost (Rs.)*</label>
                    <input type="number" step="0.01" name="cost" value="<?= htmlspecialchars($fields['cost']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="image">Upload Image*</label>
                    <input type="file" name="image" required>
                </div>
            </div>
            
            <!-- Tour Highlights Section -->
            <div class="form-section">
                <h3>Tour Highlights (Up to 5)</h3>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="highlight-item">
                        <label for="highlight_<?= $i ?>">Highlight <?= $i ?></label>
                        <input type="text" name="highlight_<?= $i ?>" id="highlight_<?= $i ?>" 
                            value="<?= htmlspecialchars($fields['highlights'][$i-1] ?? '') ?>" 
                            placeholder="Enter highlight <?= $i ?>">
                    </div>
                <?php endfor; ?>
                <p class="instructions">Enter the most important features of this tour package.</p>
            </div>
            
            <!-- Daily Itinerary Section -->
            <div class="form-section">
                <h3>Daily Itinerary</h3>
                <div id="itinerary-container">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <div class="itinerary-day" id="day-<?= $i ?>-container" 
                            style="<?= $i > $fields['days'] ? 'display: none;' : '' ?>">
                            <label for="day_<?= $i ?>">Day <?= $i ?> Activities*</label>
                            <input type="text" name="day_<?= $i ?>" id="day_<?= $i ?>"
                                value="<?= isset($fields['itinerary'][$i-1]) ? 
                                    htmlspecialchars(str_replace("Day $i: ", '', $fields['itinerary'][$i-1])) : '' ?>"
                                placeholder="Activities for Day <?= $i ?>"
                                <?= $i <= $fields['days'] ? 'required' : '' ?>>
                        </div>
                    <?php endfor; ?>
                </div>
                <p class="instructions">Describe the activities for each day of the tour.</p>
            </div>
            
            <button type="submit">Add Destination</button>
            <button type="button" class="submit"><a href="dashboard.php">Back to Dashboard</a></button>
        </form>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const daysInput = document.getElementById('days-input');
            
            // Initialize with correct number of days
            updateItineraryFields(parseInt(daysInput.value));
            
            // Update when days value changes
            daysInput.addEventListener('change', function() {
                updateItineraryFields(parseInt(this.value));
            });
            
            function updateItineraryFields(days) {
                // Show/hide day fields and set required attribute
                for (let i = 1; i <= 10; i++) {
                    const container = document.getElementById(`day-${i}-container`);
                    const input = document.getElementById(`day_${i}`);
                    
                    if (i <= days) {
                        container.style.display = 'block';
                        input.required = true;
                    } else {
                        container.style.display = 'none';
                        input.required = false;
                    }
                }
            }
            
            // Initialize star rating UI
            document.querySelectorAll('.star-rating label').forEach(star => {
                star.addEventListener('click', function() {
                    const radioId = this.getAttribute('for');
                    document.getElementById(radioId).checked = true;
                });
            });
        });
    </script>
</body>
</html>