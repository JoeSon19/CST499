<?php
error_reporting(E_ALL & ~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php require 'master.php'; // This includes your navigation bar and any other repeated elements ?>

<div class="container">
    <h1 class="text-center">Contact Us</h1>
    <p class="text-center">At <strong class="text-primary">CST499 Course Enrollment System</strong>, we're always ready to assist you. Whether you have questions, need support, or want more information about our course enrollment services, we're here to help. </p>

    <div class="row">
        <div class="col-md-6">
            <h2>Get in Touch</h2>
            <p><strong>Phone:</strong> +1 (555) 123-4567<br>
            Available from 9:00 AM to 6:00 PM, Monday to Friday (Eastern Time)</p>
            
            <p><strong>Email:</strong> info@cst499coursesystem.com<br>
            We'll get back to you as soon as possible.</p>
            
            <p><strong>Office Location:</strong> 123 Main Street, Suite 100, Cityville, ST 12345<br>
            Visit us for a personal consultation during our office hours.</p>
        </div>
        
        <div class="col-md-6">
            <h2>Customer Support</h2>
            <p>Our team is committed to providing you with the highest level of service. For any support-related inquiries, please contact us.</p>
            
            <p><strong>Support Hotline:</strong> +1 (555) 987-6543</p>
            <p><strong>Support Email:</strong> support@cst499coursesystem.com</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2>Feedback and Inquiries</h2>
            <p>Your feedback is invaluable to us. For feedback, suggestions, or specific inquiries, please reach out. We're always looking to improve and serve you better.</p>
        </div>
    </div>
</div>



<?php require_once 'footer.php'; // This includes your footer ?>

</body>
</html>
