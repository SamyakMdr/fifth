<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    echo "<h1>Form Data Submitted:</h1>";
    echo "<p>Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Message: $message</p>";
    echo "<hr>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>
    <h1>Contact Form</h1>
    <form method="post">
        <p>Name:<br>
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"></p>
        <p>Email:<br>
        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"></p>
        <p>Message:<br>
        <textarea name="message" rows="4"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea></p>
        <p><input type="submit" value="Submit"></p>
    </form>
    <pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>
</body>
</html>