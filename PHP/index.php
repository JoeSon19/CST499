<?php
error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Using HTTPS for all external resources to avoid mixed content issues -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php require 'master.php'; ?>

<div class="container text-center">
    <h1 class="display-4">Welcome to the <strong class="text-primary">CST499 Course Enrollment System</strong></h1>
    <p class="lead">Empowering Your Success Academic Journey with Innovative Course Enrollment</p>
</div>


<?php require_once 'footer.php'; ?>

</body>
</html>
