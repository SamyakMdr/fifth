<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
require '../db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Invalid CSRF token";
        header("Location: index.php");
        exit();
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // First delete related reservations
        $delete_reservations = $conn->prepare("DELETE FROM reservations WHERE destination_id = ?");
        $delete_reservations->bind_param("i", $id);
        $delete_reservations->execute();
        
        // Then get the image filename before deleting destination
        $query = "SELECT image FROM destinations WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $destination = $result->fetch_assoc();
            $image_file = $destination['image'];
            
            // Delete the destination
            $delete_query = "DELETE FROM destinations WHERE id = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("i", $id);
            
            if ($delete_stmt->execute()) {
                // Delete the associated image file
                if ($image_file && file_exists("../uploads/" . $image_file)) {
                    @unlink("../uploads/" . $image_file);
                }
                
                $conn->commit();
                $_SESSION['success'] = "Destination and related reservations deleted successfully";
                header("Location: index.php");
                exit();
            }
        }
        
        $conn->rollback();
        $_SESSION['error'] = "Destination not found";
        header("Location: index.php");
        exit();
        
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = "Error deleting destination: " . $e->getMessage();
        header("Location: index.php");
        exit();
    }
}

// Rest of your delete confirmation page code...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Destination</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f7fa;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        h1 {
            color: #e74c3c;
            margin-bottom: 20px;
        }
        
        .destination-title {
            font-size: 1.2em;
            font-weight: bold;
            margin: 20px 0;
            color: #2c3e50;
        }
        
        .warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            border-left: 4px solid #ffeeba;
        }
        
        .warning i {
            margin-right: 10px;
        }
        
        .buttons {
            margin-top: 30px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin: 0 10px;
            display: inline-block;
        }
        
        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-exclamation-triangle"></i> Delete Destination</h1>
        
        <div class="warning">
            <i class="fas fa-exclamation-circle"></i>
            <strong>Warning:</strong> This action cannot be undone. All data associated with this destination will be permanently deleted.
        </div>
        
        <p>Are you sure you want to delete the following destination?</p>
        
        <div class="destination-title"><?= htmlspecialchars($title) ?></div>
        
        <form method="POST" class="buttons">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Confirm Delete
            </button>
            <a href="dashboard.php" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </form>
    </div>
</body>
</html>