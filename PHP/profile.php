<?php
session_start();
require_once 'DatabaseHandler.php'; // Include the DatabaseHandler class
// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$dbHandler = new DatabaseHandler();
$conn = $dbHandler->connect();
// Assuming the user's ID is stored in the session
$user_id = $_SESSION['user_id'];
// Fetch user information from the database
$stmt = $dbHandler->executeSelectQuery("SELECT email, firstName, lastName, address, phone, GPA, Major FROM tbluser WHERE id = :id", [':id' => $user_id]);
if ($stmt && $stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Handle error or redirect if user data cannot be fetched
    echo "User data not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <!-- Ensure you link to the CSS files for Bootstrap and Font Awesome if you're using them -->
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/your/custom/styles.css">
    <!-- Alternatively, you can include the style directly here -->
    <style>
        .profile-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
        }
        .profile-title {
            color: #333;
            margin-bottom: 20px;
        }
        .profile-detail {
            margin: 10px 0;
            color: #555;
            font-size: 16px;
        }
        .profile-detail i {
            color: #777;
            width: 30px;
            text-align: center;
            margin-right: 10px;
        }
        .detail-value {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<?php include 'master.php'; ?>
<div class="container text-center">
    <h1>Welcome to your Profile</h1>
    <div class="profile-card">
    <div class="container text-left">        
        <p class="profile-detail"><i class="fa fa-envelope"></i>Email: <span class="detail-value"><?= htmlspecialchars($user['email']) ?></span></p>
        <p class="profile-detail"><i class="fa fa-user"></i>First Name: <span class="detail-value"><?= htmlspecialchars($user['firstName']) ?></span></p>
        <p class="profile-detail"><i class="fa fa-user"></i>Last Name: <span class="detail-value"><?= htmlspecialchars($user['lastName']) ?></span></p>
        <p class="profile-detail"><i class="fa fa-home"></i>Address: <span class="detail-value"><?= htmlspecialchars($user['address']) ?></span></p>
        <p class="profile-detail"><i class="fa fa-phone"></i>Phone: <span class="detail-value"><?= htmlspecialchars($user['phone']) ?></span></p>
        <p class="profile-detail"><i class="fa fa-dollar-sign"></i>GPA: <span class="detail-value"><?= htmlspecialchars($user['GPA']) ?></span></p>
        <p class="profile-detail"><i class="fa fa-id-card"></i>Major: <span class="detail-value"><?= htmlspecialchars($user['Major']) ?></span></p>

        <div class="change-password-button">
            <a href="change_password.php" class="btn btn-warning">Change Password</a>
        </div>

    </div>
</div>
<?php include 'footer.php'; ?>

</body>
</html>
