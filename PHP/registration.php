
<?php
require_once 'DatabaseHandler.php';
error_reporting(E_ALL & ~E_NOTICE);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form fields
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address']; // New field
    $phone = $_POST['phone']; // New field
    $GPA = $_POST['GPA']; // New field
    $Major = $_POST['Major']; // New field
    $db = new DatabaseHandler();
    $conn = $db->connect();
    // Update SQL statement with new fields
    $sql = "INSERT INTO tblUser (email, password, firstName, lastName, address, phone, GPA, Major) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Bind parameters and execute
    if ($stmt->execute([$email, $password, $firstName, $lastName, $address, $phone, $GPA, $Major])) {
        echo "<div class='alert alert-success'>Registration successful!</div>";
    } else {
        echo "<div class='alert alert-danger'>Registration failed. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            color: #666;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        .btn-default {
            background-color: #5cb85c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-default:hover {
            background-color: #4cae4c;
        }
        .btn-back {
            background-color: #6c757d; /* Bootstrap's default gray */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-back:hover {
            background-color: #5a6268; /* A darker shade of gray for hover effect */
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="password" required>
            </div>
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="GPA">GPA:</label>
                <input type="number" step="0.01" class="form-control" id="GPA" name="GPA" required>
            </div>
            <div class="form-group">
                <label for="Major">Major:</label>
                <input type="text" class="form-control" id="Major" name="Major" required>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            <button type="button" onclick="window.location.href = 'index.php'" class="btn btn-default btn-back">Go Back</button>
        </form>
    </div>
</body>
</html>


