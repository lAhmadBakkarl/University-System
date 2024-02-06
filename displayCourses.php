<?php
include('session.php');
$courses = $courseList->getAllCourses();

//back to main menu if back button is clicked
if (isset($_POST['back'])) {
    header('location:main.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table border=1>
    <tr>
        <th>name</th>
    </tr>

    <?php foreach ($courses as $course) { ?>
        <tr>
            <td>
                <a href="displayChapter.php?course=<?php echo $course->getName(); ?>"><?php echo $course->getName(); ?></a>
            </td>
        </tr>
    <?php } ?>

</table>

<form action='main.php' method="post">
    <input type="submit" value="back" name="back">
</form>

</body>
</html>
