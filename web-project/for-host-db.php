<?php
$host = 'sql300.byetcluster.com';
$user = 'b31_38725849'; // Replace with your actual database username
$pass = 'athmanduk1'; // Replace with your actual database password
$db   = 'b31_38725849_travel_db';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>