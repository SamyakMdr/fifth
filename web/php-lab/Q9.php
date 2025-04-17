<?php
$theme = $fontSize = '';
$message = '';
$preferencesSet = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['set_preferences'])) {
    $theme = $_POST['theme'] ?? 'light';
    $fontSize = $_POST['font_size'] ?? 'medium';
    setcookie('user_theme', $theme, time() + (30 * 24 * 60 * 60));
    setcookie('user_font_size', $fontSize, time() + (30 * 24 * 60 * 60));
    $message = "Preferences saved successfully!";
    $preferencesSet = true;
}
if (isset($_COOKIE['user_theme'])) {
    $theme = $_COOKIE['user_theme'];
    $preferencesSet = true;
}
if (isset($_COOKIE['user_font_size'])) {
    $fontSize = $_COOKIE['user_font_size'];
    $preferencesSet = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Preferences</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            <?php if ($theme == 'dark'): ?>
                background-color: #333;
                color: #fff;
            <?php else: ?>
                background-color: #f5f5f5;
                color: #333;
            <?php endif; ?>
            
            <?php if ($fontSize == 'small'): ?>
                font-size: 14px;
            <?php elseif ($fontSize == 'large'): ?>
                font-size: 18px;
            <?php else: ?>
                font-size: 16px;
            <?php endif; ?>
        }
        .pref-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            <?php if ($theme == 'dark'): ?>
                border-color: #555;
                background-color: #444;
            <?php else: ?>
                background-color: #fff;
            <?php endif; ?>
        }
    </style>
</head>
<body>
    <h1>User Preferences</h1>
    <?php if (!empty($message)): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>
    <div class="pref-box">
        <h2>Set Your Preferences</h2>
        <form method="post">
            <p>
                <label for="theme">Theme:</label><br>
                <select name="theme" id="theme">
                    <option value="light" <?php echo ($theme == 'light') ? 'selected' : ''; ?>>Light</option>
                    <option value="dark" <?php echo ($theme == 'dark') ? 'selected' : ''; ?>>Dark</option>
                </select>
            </p>            
            <p>
                <label for="font_size">Font Size:</label><br>
                <select name="font_size" id="font_size">
                    <option value="small" <?php echo ($fontSize == 'small') ? 'selected' : ''; ?>>Small</option>
                    <option value="medium" <?php echo ($fontSize == 'medium') ? 'selected' : ''; ?>>Medium</option>
                    <option value="large" <?php echo ($fontSize == 'large') ? 'selected' : ''; ?>>Large</option>
                </select>
            </p>
            <p>
                <input type="submit" name="set_preferences" value="Save Preferences">
            </p>
        </form>
    </div>
    <?php if ($preferencesSet): ?>
        <div class="pref-box">
            <h2>Your Current Preferences</h2>
            <p><strong>Theme:</strong> <?php echo ucfirst($theme); ?></p>
            <p><strong>Font Size:</strong> <?php echo ucfirst($fontSize); ?></p>
            <p><small>These preferences will be remembered for 30 days.</small></p>
        </div>
    <?php endif; ?>
    <pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>
</body>
</html>