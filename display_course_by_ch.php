<?php
include_once('Classes.php');

if(!isset($_SESSION['courseList'])) {
    $_SESSION['courseList'] = new CourseListClass();
}

$courseList = $_SESSION['courseList'];
$selectedCourse = null; 

if(isset($_POST['courseName'])) {
    $selectedCourse = $courseList->getCourseByName($_POST['courseName']);
}

if(isset($_POST['deleteChapter'])) {
    $chapterToDelete = $_POST['deleteChapter'];
    if($selectedCourse != null && $selectedCourse->chapterExists($chapterToDelete)){
        $index = array_search($chapterToDelete, array_column($selectedCourse->getChapters(), 'name'));
        $selectedCourse->deleteChapter($index);
        $_SESSION['courseList'] = $courseList;
    }
    header('Location: display_course_by_ch.php');
    exit;
}

if(isset($_POST['modifyChapter'])) {
    $chapterToModify = $_POST['modifyChapter'];
    var_dump($chapterToModify);
    $_SESSION['chapterToModify'] = $chapterToModify;
    if($selectedCourse != null) {
     header("Location: display_Chapters.php?course=" . urlencode($course->getName()));
     exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Course by Chapters</title>
</head>
<body>
    <h1>Select a course to display its chapters:</h1>
    <form method="post">
        <select name="courseName">
            <?php foreach($courseList->getAllCourses() as $course): ?>
                <option value="<?php echo $course->getName(); ?>"
                    <?php if(isset($selectedCourse) && $selectedCourse->getName() == $course->getName()): ?>
                        selected
                    <?php endif; ?>
                ><?php echo $course->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Display</button>
    </form>

    <?php if(isset($selectedCourse)): ?>
        <h2>Chapters for <?php echo $selectedCourse->getName(); ?>:</h2>
        <table border="1">
            <tr>
                <th>Chapter Name</th>
            </tr>
            <?php foreach($selectedCourse->getChapters() as $chapter): ?>
                <tr>
                    <td><?php echo $chapter->getName(); ?></td>
                    <td><form method="post" onsubmit="return confirm('Are you sure you want to delete this chapter?')">
                            <input type="hidden" name="deleteChapter" value="<?php echo $chapter->getName(); ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="modifyChapter" value="<?php echo $chapter->getName(); ?>">
                            <button type="submit">Modify</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
