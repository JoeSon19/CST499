<?php
session_start();
require_once 'DatabaseHandler.php'; // Include the DatabaseHandler class

$dbHandler = new DatabaseHandler();
$conn = $dbHandler->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $conn) {
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];
    
    $stmt = $dbHandler->executeSelectQuery("SELECT * FROM tbluser WHERE email = :email", [':email' => $user_username]);
    
    if ($stmt && $stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($user_password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button,
        .back-button { /* Added .back-button class for styling */
            width: 100%;
            padding: 10px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px; /* Add some space between buttons */
        }

        button {
            background-color: #5cb85c; /* Changed color to blue */
        }

        button:hover,
        .back-button:hover { /* Added hover effect for .back-button */
            opacity: 0.8;
        }

        .back-button { /* Specific styles for the back button */
            background-color: gray; /* Changed background color to gray */
        }

        .error {
            color: #ff0000;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if(isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
            <button type="button" onclick="window.location.href = 'index.php'" class="back-button">Go Back</button>
        </form>
    </div>
</body>
</html>
