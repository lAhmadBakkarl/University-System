<?php
include('initSession.php');

//back to main menu if back button is clicked
if (isset($_POST['back'])) {
    header('location:display_chapters.php?course='.$_GET['course']);
    exit;
}

//get course and chapter names from the GET parameter
if (!isset($_GET['course']) || empty($_GET['course']) || !isset($_GET['chapter']) || empty($_GET['chapter'])) {
    header('location:display_courses.php');
    exit;
} else {
    $courseName = $_GET['course'];
    $chapterName = $_GET['chapter'];
    $course = $courseList->getCourseByName($courseName);
    if ($course == null) {
        header('location:display_courses.php');
        exit;
    } else {
        $chapter = $course->getChapterByName($chapterName);
        if ($chapter == null) {
            header('location:display_chapters.php?course='.$courseName);
            exit;
        } else {
            $documents = $chapter->getDocuments();
        }
    }
}

//delete document if delete button is clicked
if (isset($_POST['delete'])) {
    $documentName = $_POST['document_name'];
    $chapter->deleteDocumentByName($documentName);
    header('location:display_documents.php?course='.$courseName.'&chapter='.$chapterName);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $chapterName; ?> Documents</title>
</head>
<body>

<h2><?php echo $chapterName; ?> Documents</h2>

<table border="1">
    <tr>
        <th>Document Name</th>
    </tr>
    <?php foreach ($documents as $document) { ?>
        <tr>
            <td><?php echo $document->getName(); ?></td>
            <td><a href="#" onclick="if(confirm('Are you sure you want to delete <?php echo $document->getName(); ?>?')) { document.getElementById('delete-form-<?php echo $document->getId(); ?>').submit(); }">Delete</a></td>
            <td><a href="modify_document.php?course=<?php echo $courseName; ?>&chapter=<?php echo $chapterName; ?>&document=<?php echo $document->getName(); ?>">Modify</a></td>
        </tr>
        <form id="delete-form-<?php echo $document->getId(); ?>" action="display_documents.php?course=<?php echo $courseName; ?>&chapter=<?php echo $chapterName; ?>" method="post">
            <input type="hidden" name="document_name" value="<?php echo $document->getName(); ?>">
            <input type="hidden" name="delete" value="delete">
        </form>
    <?php } ?>
</table>

<form action='add_document.php' method="get">
    <input type="hidden" name="course" value="<?php echo $courseName; ?>">
    <input type="hidden" name="chapter" value="<?php echo $chapterName; ?>">
    <input type="submit" value="Add">
</form>

<form action='display_chapters.php?course=<?php echo $courseName; ?>' method="post">
    <input type="submit" value="back" name="back">
</form>

</body>
</html>
