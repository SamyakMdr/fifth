<?php
$name = $email = $phone = $message = '';
$errors = [];
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(htmlspecialchars($_POST['name'] ?? ''));
    $email = trim(htmlspecialchars($_POST['email'] ?? ''));
    $phone = trim(htmlspecialchars($_POST['phone'] ?? ''));
    $message = trim(htmlspecialchars($_POST['message'] ?? ''));
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    if (!empty($phone) && !preg_match('/^(97|98)\d{8}$/', $phone)) {
        $errors['phone'] = "Phone must start with 97 or 98 and be 10 digits";
    }
    if (empty($errors)) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>
    <h1>Contact Form</h1>
    <?php if ($success): ?>
        <h2>Form Data Submitted:</h2>
        <p>Name: <?php echo $name; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <?php if (!empty($phone)): ?>
            <p>Phone: <?php echo $phone; ?></p>
        <?php endif; ?>
        <p>Message: <?php echo $message; ?></p>
        <hr>
    <?php endif; ?>
    <form method="post">
        <p>Name: <span style="color:red">*</span><br>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <?php if (isset($errors['name'])): ?>
            <span style="color:red"><?php echo $errors['name']; ?></span>
        <?php endif; ?>
        </p>
        <p>Email: <span style="color:red">*</span><br>
        <input type="email" name="email" value="<?php echo $email; ?>">
        <?php if (isset($errors['email'])): ?>
            <span style="color:red"><?php echo $errors['email']; ?></span>
        <?php endif; ?>
        </p>
        <p>Phone (optional):<br>
        <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="97xxxxxxxx or 98xxxxxxxx">
        <?php if (isset($errors['phone'])): ?>
            <span style="color:red"><?php echo $errors['phone']; ?></span>
        <?php endif; ?>
        </p>
        <p>Message:<br>
        <textarea name="message" rows="4"><?php echo $message; ?></textarea>
        </p>
        <p><input type="submit" value="Submit"></p>
        <p><small>Fields marked with <span style="color:red">*</span> are required</small></p>
    </form>
    <pre>
        Name: Samyak Manandhar
        Symbol: 79010513
        Registration Number: 5-2-410-62-2022
        BSc.CSIT 5th Semester
    </pre>
</body>
</html>