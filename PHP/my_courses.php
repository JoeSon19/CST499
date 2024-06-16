<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require 'DatabaseHandler.php'; // Include your DatabaseHandler class file

// Check if the user is logged in
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$db = new DatabaseHandler();
$conn = $db->connect();

// Fetch current classes for the logged-in user
$query = "SELECT c.course_id, c.course_name, c.course_number, c.instructor_name, c.credits, c.semester 
          FROM tblCourse c 
          JOIN tblEnrollment e ON c.course_id = e.course_id 
          WHERE e.user_id = :user_id";
$params = [':user_id' => $user_id];
$current_classes = $db->executeSelectQuery($query, $params);

// Fetch all available classes
$query = "SELECT course_id, course_name, course_number, instructor_name, credits, semester 
          FROM tblCourse WHERE course_id NOT IN 
          (SELECT course_id FROM tblEnrollment WHERE user_id = :user_id)";
$available_classes = $db->executeSelectQuery($query, $params);

// Handle adding a class
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_class_id'])) {
    $class_id = $_POST['add_class_id'];
    $query = "INSERT INTO tblEnrollment (user_id, course_id) VALUES (:user_id, :course_id)";
    $params = [':user_id' => $user_id, ':course_id' => $class_id];
    $db->executeQuery($query, $params);
    header('Location: my_courses.php');
    exit;
}

// Handle deleting a class
if (isset($_GET['delete_class_id'])) {
    $class_id = $_GET['delete_class_id'];
    $query = "DELETE FROM tblEnrollment WHERE user_id = :user_id AND course_id = :course_id";
    $params = [':user_id' => $user_id, ':course_id' => $class_id];
    $db->executeQuery($query, $params);
    header('Location: my_courses.php');
    exit;
}

?>
<?php include 'master.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>My Courses</title>
</head>
<body>
    <div class="container">
        <h2>My Current Classes</h2>
        <ul class="list-group">
            <?php while ($row = $current_classes->fetch(PDO::FETCH_ASSOC)): ?>
                <li class="list-group-item">
                    <strong><?= htmlspecialchars($row['course_name']) ?> (<?= htmlspecialchars($row['course_number']) ?>)</strong> 
                    - Instructor: <?= htmlspecialchars($row['instructor_name']) ?>, Credits: <?= htmlspecialchars($row['credits']) ?>, Semester: <?= htmlspecialchars($row['semester']) ?>
                    <a href="my_courses.php?delete_class_id=<?= $row['course_id'] ?>" class="btn btn-danger btn-sm pull-right">Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>

        <h2>Available Classes</h2>
        <ul class="list-group">
            <?php while ($row = $available_classes->fetch(PDO::FETCH_ASSOC)): ?>
                <li class="list-group-item">
                    <strong><?= htmlspecialchars($row['course_name']) ?> (<?= htmlspecialchars($row['course_number']) ?>)</strong> 
                    - Instructor: <?= htmlspecialchars($row['instructor_name']) ?>, Credits: <?= htmlspecialchars($row['credits']) ?>, Semester: <?= htmlspecialchars($row['semester']) ?>
                    <form method="post" action="my_courses.php" class="pull-right">
                        <input type="hidden" name="add_class_id" value="<?= $row['course_id'] ?>">
                        <button type="submit" class="btn btn-success btn-sm">Add</button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
