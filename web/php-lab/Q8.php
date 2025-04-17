<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_button'])) {
    $message = "The button was clicked!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Button Click Example</title>
</head>
<body>
    <h1>Button Click Demo</h1>
    <form method="post">
        <p>
            <input type="submit" name="submit_button" value="Click Me">
        </p>
    </form>
    <?php if (!empty($message)): ?>
        <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
    <?php endif; ?>
    <pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>
</body>
</html>