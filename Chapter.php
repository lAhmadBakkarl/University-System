<?php
include("session.php");
print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Main Menu</title>
</head>
<body>
    <div class="container">
    <h1>Main Page</h1>
    <a href="CreateChapter.php">Create Chapter</a><br><br>
    <a href="displayChapter.php">Display Chapters</a><br><br>
    <a href="uploadDoc.php">Upload Document</a><br><br>
    <a href="DisplayCourseByCh.php">Display Course By Chapter</a><br><br>
    
        <button type="submit" name="resetCourses">Reset Courses</button>
    </div>
</body>
</html>