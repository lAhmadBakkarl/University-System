<?php

require_once('initSession.php');

class Document {
    private $name;
    private $category;
    private $filename;
    private $filetype;
    private $filesize;
    private $filetmpname;

    public function __construct($name, $category, $filename, $filetype, $filesize, $filetmpname) {
        $this->name = $name;
        $this->category = $category;
        $this->filename = $filename;
        $this->filetype = $filetype;
        $this->filesize = $filesize;
        $this->filetmpname = $filetmpname;
    }

    public function getName() {
        return $this->name;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getFileType() {
        return $this->filetype;
    }

    public function getFileSize() {
        return $this->filesize;
    }

    public function getFileTmpName() {
        return $this->filetmpname;
    }
}


class Chapter {
    private $name;
    private $documents = array();

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function getDocuments() {
        return $this->documents;
    }

    public function addDocument($document) {
        $this->documents[] = $document;
    }

    public function removeDocument($document) {
        $index = array_search($document, $this->documents);
        if ($index !== false) {
            array_splice($this->documents, $index, 1);
        }
    }

    public function removeAllDocuments() {
        $this->documents = array();
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
    private $name;
    private $year;
    private $chapters;

    public function __construct($name, $year) {
        $this->name = $name;
        $this->year = $year;
        $this->chapters = array();
    }

    public function getName() {
        return $this->name;
    }

    public function getYear() {
        return $this->year;
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

    public function getChapterByName($chapterName) {
        foreach ($this->chapters as $chapter) {
            if ($chapter->getName() === $chapterName) {
                return $chapter;
            }
        }
        return null;
    }


    public function getChapterByIndex($index) {
        if (isset($this->chapters[$index])) {
            return $this->chapters[$index];
        } else {
            return null;
        }
    }

    public function deleteChapter($chapterName) {
        foreach ($this->chapters as $key => $chapter) {
            if ($chapter->getName() === $chapterName) {
                unset($this->chapters[$key]);
                echo "Chapter deleted: " . $chapterName;
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

    public function getCourseByName($name) {
        foreach ($this->coursesList as $course) {
            if ($course->getName() == $name) {
                return $course;
            }
        }
        return null;
    }
}
?>
