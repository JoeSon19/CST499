<?php
error_reporting(E_ALL & ~E_NOTICE);
if (session_status() == PHP_SESSION_NONE) {
    // Set session cookie parameters for security
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_secure', '1'); // Enable this if you are using HTTPS
    ini_set('session.use_only_cookies', '1');
    
    // Start the session
    session_start();
}
// Check if the username session variable is set and not empty
if (!empty($_SESSION['user_id'])) {
    $welcomeMessage = "Welcome #" . htmlspecialchars($_SESSION['user_id']) . " You are logged in";
} else {
    $welcomeMessage = '';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="jumbotron">
        <div class="container text-center">
        <h1><strong class="text-primary">CST499 Course Enrollment System</strong></h1>
        <h1>Student Portal</h1>
            <?php if ($welcomeMessage !== ''): ?>
                <p><?= $welcomeMessage; ?></p>
            <?php endif; ?>
        </div>
    </div>
   
   
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="About Us.php"><span class="glyphicon glyphicon-exclamation-sign"></span> About Us</a></li>
                <li><a href="Contact Us.php"><span class="glyphicon glyphicon-earphone"></span> Contact Us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href="my_courses.php"><span class="glyphicon glyphicon-book"></span> My Courses</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <li><a href="registration.php"><span class="glyphicon glyphicon-registration-mark"></span> Registration</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>
