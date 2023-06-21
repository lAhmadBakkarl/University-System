<?php
include('initSession.php');

function isCourseNameExists($name, $courseList) {
    foreach ($courseList as $course) {
        if ($course->getName() == $name) {
            return true;
        }
    }
    return false;
}

if (isset($_POST['addCoursebtn'])) {
    if (!empty($_POST['name']) && !empty($_POST['year'])) {
        $coursename = $_POST['name'];
        
        // Check if course name already exists
        if (isCourseNameExists($coursename, $courseList->getAllCourses())) {
            echo "Course with name $coursename already exists.";
        } else {
            $course = new Course($coursename, $_POST['year']);
            $courseList->addCourse($course);
            echo "Course added successfully.";
        }
    } else {
        echo "Please provide all the required information for adding a course.";
    }
    echo '<br><br>';
    echo '<a href="enter_course.php"><button>Go Back</button></a>';
    echo '<a href="main.php"><button>Go to main</button></a>';
}
?>


