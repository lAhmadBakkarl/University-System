<?php
include('initSession.php');

//back to main menu if back button is clicked
if (isset($_POST['back'])) {
    header('location:main.php');
    exit;
}

//get course name from the GET parameter
if (!isset($_GET['course']) || empty($_GET['course'])) {
    header('location:display_courses.php');
    exit;
} else {
    $courseName = $_GET['course'];
    $course = $courseList->getCourseByName($courseName);
    if ($course == null) {
        header('location:display_courses.php');
        exit;
    } else {
        $chapters = $course->getChapters();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $courseName; ?> Chapters</title>
</head>
<body>

<h2><?php echo $courseName; ?> Chapters</h2>

<table border="1">
    <tr>
        <th>Chapter Name</th>
    </tr>
    <?php foreach ($chapters as $chapter) { ?>
        <tr>
            <td><a href="display_documents.php?course=<?php echo $courseName; ?>&chapter=<?php echo $chapter->getName(); ?>"><?php echo $chapter->getName(); ?></a></td>
        </tr>
    <?php } ?>
</table>

<form action='display_courses.php' method="post">
    <input type="submit" value="back" name="back">
</form>

</body>
</html>
