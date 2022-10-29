<?php
ob_start();
session_start(); 
function dbConnect() {
     $host = "localhost";
    $user = "root";
    $password = '';
    $db_name = "course_enrollment_system";

    $con = mysqli_connect($host, $user, $password, $db_name);
    if (mysqli_connect_errno()) {
        die("Failed to connect with MySQL: " . mysqli_connect_error());
    }
    return $con;
}

function all_courses_dropdown() {
    $db = dbConnect();
    $sql = "select course_id,courseName from course";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        $str = '';
        while ($row = mysqli_fetch_array($result)) {
            $str .= '<option value="' . $row["course_id"] . '">' . $row["courseName"] . '</option>';
        }
    }
    return $str;
}
function offered_courses_dropdown($semester,$year) {
    $db = dbConnect();
    $sql = "SELECT course_id,courseName from course where course_id in(
                SELECT course_id FROM `offering` where year='".$year."' and semester='".$semester."')";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $str = '';
        while ($row = mysqli_fetch_array($result)) {
            $str .= '<option value="' . $row["course_id"] . '">' . $row["courseName"] . '</option>';
        }
    }
    return $str;
}

function years_dropdown() {
    $db = dbConnect();
    $sql = "select distinct(year) as year from offering";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        $str = '';
        while ($row = mysqli_fetch_array($result)) {
            $str .= '<option value="' . $row["year"] . '">' . $row["year"] . '</option>';
        }
    }
    return $str;
}
function semesters_dropdown() {
    $db = dbConnect();
    $sql = "select distinct(semester) as semester from offering";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        $str = '';
        while ($row = mysqli_fetch_array($result)) {
            $str .= '<option value="' . $row["semester"] . '">' . $row["semester"] . '</option>';
        }
    }
    return $str;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function check_login(){
    if($_SESSION["is_login"] != 1){
        header("Location: index.php");
        exit;
    }
}
function enrolled_course($student_id){
    $db = dbConnect();
    $sql = "SELECT DISTINCT offering.course_id as course_id FROM `student` 
                left join enrollment on student.student_id=enrollment.student_id 
                left join offering on enrollment.offering_id=offering.offering_id 
            where student.student_id='".test_input($student_id)."'";
    $result = mysqli_query($db,$sql);
    $courses = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)){
            $courses[] = $row["course_id"];
        }
    } 
    return $courses;
}
function is_enrolled($student_id,$course_id){
    $courses = enrolled_course($student_id);
    if(in_array($course_id, $courses)){
        return true;
    }else{
        return false;
    }
}
 
function course_limit($course_id){
     $db = dbConnect();
     $semester = $_SESSION['selectedSemester'];
     $year = $_SESSION['selectedYear']; 
     $sql = "SELECT maxStudents, "
            . "(select count(*) as total_registered from enrollment where offering_id in(
SELECT offering_id FROM `offering` where course_id='".$course_id."' and year='".$year."' and semester='".$semester."')) as total_registered,"
             . "(SELECT offering_id FROM `offering` where year='".$year."' AND semester='".$semester."' and course_id='".$course_id."' limit 1 ) as offering_id "
            . "from course where course_id='".test_input($course_id)."'";      
    $result = mysqli_query($db,$sql);
     if (mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_assoc($result); 
         return array("maxStudents"=>$row["maxStudents"],"total_registered"=>$row["total_registered"],"offering_id"=>$row["offering_id"]);
    }else{
        return false;
    }
}

function registerForCourse($studentId,$offeringId) { 
        $db = dbConnect();
        $sql =  "INSERT INTO enrollment (student_id, offering_id)
            VALUES 
                ($studentId,$offeringId)";
        $results = mysqli_query($db, $sql);
        if(mysqli_affected_rows($db) > 0){
            return true;
        }else{
            return false;
        }
    }
    
      function dropCourse($studentId,$offeringId) {
          $connection = dbConnect();
        $dropQuery =  "DELETE FROM enrollment
            WHERE student_id = $studentId AND offering_id = $offeringId";
        $results = mysqli_query($connection, $dropQuery);

        $getCourseInfoQuery =  "SELECT course.courseName, offering.semester, offering.year
            FROM course
            INNER JOIN offering ON course.course_id = offering.course_id
                AND offering.offering_id = $offeringId";
        $results = mysqli_query($connection, $getCourseInfoQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['droppedCourseName'] = $row['courseName'];
                $_SESSION['droppedSemester'] = $row['semester'];
                $_SESSION['droppedYear'] = $row['year'];
            };
        };
    };
     function displayCourseSchedule($studentId) {
         $connection = dbConnect();
        $getScheduleQuery =  "SELECT enrollment.student_id, offering.offering_id, course.courseName, offering.year, offering.semester
            FROM ((enrollment
                INNER JOIN offering ON enrollment.offering_id = offering.offering_id
                    AND enrollment.student_id = $studentId)
                INNER JOIN course ON course.course_id = offering.course_id)";
        $results = mysqli_query($connection, $getScheduleQuery); 
        if (mysqli_num_rows($results) != 0) { 
            while($row = mysqli_fetch_assoc($results)) {
                $offeringId = $row['offering_id'];
                $courseName = $row['courseName'];
                $courseYear = $row['year'];
                $courseSemester = $row['semester'];

                echo "<div class='row'>";
                    echo "<div class='col-md-6 text-left'>";
                        echo "<h3>".$courseName."</h3>";
                    echo "</div>";
                    echo "<div class='col-md-2 text-left'>";
                        echo "<h3>".$courseSemester."</h3>";
                    echo "</div>";
                    echo "<div class='col-md-2 text-left'>";
                        echo "<h3>".$courseYear."</h3>";
                    echo "</div>";
                    echo "<div style='padding-top:15px' class='col-md-2 text-left'>";
                        echo "<form method='post'>";
                            echo "<input type='hidden' name='drop' value=".$offeringId.">";
                            echo "<button style='font-family:sans-serif' type='submit' class='btn btn-danger' name='dropButton'>DROP</button>";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
            }
        } 
    };
    
        function numStudentsEnrolled($offeringId) {
            $connection = dbConnect();
        $numStuEnrolledQuery =  "SELECT COUNT(enrollment.offering_id) as 'count'
            FROM enrollment
            WHERE offering_id = $offeringId";
        $results = mysqli_query($connection, $numStuEnrolledQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['numStudentsEnrolled'] = $row['count'];
            };
        };
    };

    function maxStudentsForCourse($offeringId) {
        $connection = dbConnect();
        $maxStudentsQuery =  "SELECT course.maxStudents
            FROM course
            INNER JOIN offering ON offering.course_id = course.course_id
                AND offering.offering_id = $offeringId";
        $results = mysqli_query($connection, $maxStudentsQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['maxStudents'] = $row['maxStudents'];
            };
        };
    };

    function numStudentsOnWaitlist($offeringId) {
        $connection = dbConnect();
        $numStuWaitlistQuery =  "SELECT COUNT(*) as students
            FROM waitlist
            WHERE offering_id = $offeringId";
        $results = mysqli_query($connection, $numStuWaitlistQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['numStudentsOnWaitlist'] = $row['students'];
            };
        };
    };

//    function getWaitlistedStudent($connection,$offeringId) {
//        $waitlistedStudentQuery =  "SELECT student_id, dateTimeAdded
//            FROM waitlist
//            WHERE offering_id = $offeringId
//            ORDER BY dateTimeAdded LIMIT 1";
//        $results = mysqli_query($connection, $waitlistedStudentQuery);
//        if (mysqli_num_rows($results) == 1) { 
//            while($row = mysqli_fetch_assoc($results)) {
//                $_SESSION['waitlistedStudentId'] = $row['student_id'];
//                $_SESSION['dateTimeAdded'] = $row['dateTimeAdded'];
//            };
//        };
//    };
//
//    function registerForCourse($connection,$studentId,$offeringId) {
//        $registerQuery =  "INSERT INTO enrollment (student_id, offering_id)
//            VALUES 
//                ($studentId,$offeringId)";
//        $results = mysqli_query($connection, $registerQuery);
//    }
//    
//    function removeStudentFromWaitlist($connection,$studentId,$offeringId,$dateTimeAdded) {
//        $removeFromWaitlistQuery =  "DELETE FROM waitlist 
//            WHERE student_id = $studentId
//                AND offering_id = $offeringId
//                AND dateTimeAdded = '$dateTimeAdded'";
//        $results = mysqli_query($connection, $removeFromWaitlistQuery);
//    };

//    function notifyStudent($connection,$studentId,$offeringId) {
//        $createNotificationQuery =  "INSERT INTO notification (student_id, offering_id)
//            VALUES 
//                ($studentId,$offeringId)";
//        $results = mysqli_query($connection, $createNotificationQuery);
//    };