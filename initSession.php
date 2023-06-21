<?php
include_once('Classes.php');
session_start();

if(!isset($_SESSION['courseList'])) {
    $_SESSION['courseList'] = new CourseListClass();
}

$courseList = $_SESSION['courseList'];
?>
