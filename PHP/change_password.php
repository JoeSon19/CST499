<?php
session_start();
require_once 'DatabaseHandler.php'; // Include the DatabaseHandler class

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Initialize the DatabaseHandler
$dbHandler = new DatabaseHandler();
$conn = $dbHandler->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];
    $userId = $_SESSION['user_id'];

    // Fetch the current hashed password from the database
    $stmt = $dbHandler->executeSelectQuery("SELECT password FROM tbluser WHERE id = :id", [':id' => $userId]);

    if ($stmt && $stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = $user['password'];

        if (password_verify($currentPassword, $hashedPassword)) {
            if ($newPassword === $confirmNewPassword) {
                // Hash the new password    
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                // Update the password in the database
                $updateStmt = $dbHandler->executeQuery("UPDATE tbluser SET password = :password WHERE id = :id", [':password' => $newHashedPassword, ':id' => $userId]);

                if ($updateStmt) {
                    echo "<p>Password changed successfully.</p>";
                } else {
                    echo "<p>Error updating password.</p>";
                }
            } else {
                echo "<p>New passwords do not match.</p>";
            }
        } else {
            echo "<p>Current password is incorrect.</p>";
        }
    } else {
        echo "<p>User not found.</p>";
    }
}
?>

<!-- HTML content follows -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .goback-btn {
            background-color: black;
            color: white;
        }

        .goback-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Change Password</h2>
    <form action="change_password.php" method="post">
        <div class="form-group">
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_new_password">Confirm New Password:</label>
            <input type="password" name="confirm_new_password" required>
        </div>
        <button type="submit">Change Password</button>
        <button type="button" onclick="window.location.href = 'index.php'" class="back-button goback-btn">Go Back</button>
    </form>
</div>

</body>
</html>
