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
    <a href="addStudent.php">Add student</a><br><br>
    <a href="addCourse.php">Add Course</a><br><br>

    <a href="registerStudentsToCourse.php">Register to courses</a><br><br>
    <a href="enterGradesForStd.php">Enter grades for Course</a><br><br>

    <a href="displayCourses.php">Display all courses</a><br><br>
    <a href="displayStudentsByCourse.php">Display all students by course</a><br><br>
    <a href="displayStudentsByMajor.php">Display all students by major</a><br><br>
    <a href="displayGradesOfStd.php">Display grades of student</a><br><br>
    <a href="displaygradebycourse.php">Display grades by course</a><br><br>
    <a href="Chapter.php">Chapters</a><br><br>
        <button type="submit" name="resetStudents">Reset Students</button>
        <button type="submit" name="resetCourses">Reset Courses</button>
    </div>
</body>
</html>