<?php
interface CourseComponent {
    public function getName();
}

class Document implements CourseComponent {
    private $name;
    private $category;
    private $fileName;
    private $fileType;
    private $fileSize;
    private $fileTmpName;

    public function __construct($name, $category, $fileName, $fileType, $fileSize, $fileTmpName) {
        $this->name = $name;
        $this->category = $category;
        $this->fileName = $fileName;
        $this->fileType = $fileType;
        $this->fileSize = $fileSize;
        $this->fileTmpName = $fileTmpName;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getFileName() {
        return $this->fileName;
    }
    public function setCategory($category) {
        $this->category = $category;
    }
    public function getCategory() {
        return $this->category;
    }
    public function getFileSize() {
        $this->fileSize;
    }
    public function getFileType() {
        $this->fileType;
    }

}

class Chapter implements CourseComponent {
    private $name;
    private $documents = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function addDocument(Document $document) {
        $this->documents[] = $document;
    }

    public function removeDocument(Document $document) {
        $index = array_search($document, $this->documents, true);
        if ($index !== false) {
            array_splice($this->documents, $index, 1);
        }
    }

    public function removeAllDocuments() {
        $this->documents = [];
    }

    public function getDocumentByName($name) {
        foreach ($this->documents as $document) {
            if ($document->getName() === $name) {
                return $document;
            }
        }
        return null;
    }
}

class Course {
    private $id;
    private $name;
    private $year;
    private $grades = [];
    private $credits;
    private $components = [];
    private $chapters;

    public function __construct($id, $name, $credits, $year) {
        $this->id = $id;
        $this->name = $name;
        $this->credits = $credits;
        $this->chapters = array();
    }
    

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getYear() {
        return $this->year;
    }
    public function getCredits() {
        return $this->credits;
    }
    public function addChapter($chapter) {
        $this->chapters[] = $chapter;
    }

    public function getChapters() {
        return $this->chapters;
    }
    public function chapterExists($chapterName) {
        foreach ($this->chapters as $chapter) {
            if ($chapter->getName() === $chapterName) {
                return true;
            }
        }
        return false;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setCredits($credits) {
        $this->credits = $credits;
    }
    public function registerGrade(Student $student, $grade) {
        $this->grades[$student->getId()] = $grade;
    }

    public function getGrade(Student $student) {
        return isset($this->grades[$student->getId()]) ? $this->grades[$student->getId()] : null;
    }

    public function addComponent(CourseComponent $component) {
        $this->components[] = $component;
    }

    public function removeComponent(CourseComponent $component) {
        $index = array_search($component, $this->components, true);
        if ($index !== false) {
            array_splice($this->components, $index, 1);
        }
    }

    public function getComponentByName($name) {
        foreach ($this->components as $component) {
            if ($component->getName() === $name) {
                return $component;
            }
        }
        return null;
    }

    public function getComponentByIndex($index) {
        return isset($this->components[$index]) ? $this->components[$index] : null;
    }

    public function deleteComponentByName($name) {
        foreach ($this->components as $index => $component) {
            if ($component->getName() === $name) {
                unset($this->components[$index]);
                return true;
            }
        }
        return false;
    }
}

class CourseListClass {
    private $coursesList = [];

    public function addCourse(Course $course) {
        $this->coursesList[] = $course;
    }

    public function getAllCourses() {
        return $this->coursesList;
    }

    public function getCourseById($id) {
        foreach ($this->coursesList as $course) {
            if ($course->getId() == $id) {
                return $course;
            }
        }
        return null;
    }

    public function getCourseByName($name) {
        foreach ($this->coursesList as $course) {
            if ($course->getName() === $name) {
                return $course;
            }
        }
        return null;
    }
}

class Student {
    private $id;
    private $fullName;
    private $major;
    private $courses = [];

    public function __construct($id, $firstName, $lastName, $major) {
        $this->id = $id;
        $this->fullName = $firstName." ".$lastName;
        $this->major = $major;
    }

    public function getId() {
        return $this->id;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function getMajor() {
        return $this->major;
    }

    public function setmajor($major) {
        $this->major = $major;
    }

    public function registerCourse(Course $course) {
        if (!in_array($course, $this->courses, true)) {
            $this->courses[] = $course;
        }
    }

    public function getCourses() {
        return $this->courses;
    }
}



class StudentListClass {
    private $studentList = [];

    public function addStudent(Student $student) {
        $this->studentList[] = $student;
    }

    public function getAllStudents() {
        return $this->studentList;
    }

    public function getStudentsByCourse($courseId) {
        $students = [];

        foreach ($this->studentList as $student) {
            $courses = $student->getCourses();
            foreach ($courses as $course) {
                if ($course->getId() == $courseId) {
                    $students[] = $student;
                    break;
                }
            }
        }
        return $students;
    }    

    public function getStudentById($id) {
        foreach ($this->studentList as $student) {
            if ($student->getId() == $id) {
                return $student;
            }
        }
        return null;
    }
}
?>