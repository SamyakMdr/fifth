<?php
session_start();
require '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'];
    $p = sha1($_POST['password']); 
    $q = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $q->bind_param("ss", $u, $p);
    $q->execute();
    $res = $q->get_result();
    if ($res->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid credentials";
    }
}
?>
<link rel="stylesheet" href="add.css">
<form method="POST">
    <input type="text" name="username" required placeholder="Username"><br>
    <input type="password" name="password" required placeholder="Password"><br>
    <button type="submit">Login</button>
</form>
