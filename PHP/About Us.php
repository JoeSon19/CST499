<?php
error_reporting(E_ALL & ~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <!-- Using HTTPS for all external resources to avoid mixed content issues -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php require 'master.php'; // This includes your navigation bar and any other repeated elements ?>

<section class="container my-5 p-5 text-center bg-light rounded shadow-lg">
    <header>
        <h1 class="mb-4 display-4">About Us</h1>
    </header>
    <article>
        <p class="lead">
            Here at <strong class="text-primary">CST499 Course Enrollment System</strong>, we specialize in simplifying academic enrollment processes. Founded in 2024, our mission is to streamline course registration through innovative technology. Our team of experts is dedicated to providing cutting-edge solutions, ensuring seamless integration and improved efficiency for your educational institution.
        </p>
    </article>
    <div class="mt-4">
        <a href="Contact Us.php" class="btn btn-primary btn-lg">Get in Touch</a>
    </div>
</section>

<?php require_once 'footer.php'; // This includes your footer ?>

</body>
</html>
