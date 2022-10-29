<?php
    include_once './functions.php';
    check_login();
    unset($_SESSION['selectedOfferingId']);
    unset($_SESSION['registered']);
    unset($_SESSION['waitlisted']);
    unset($_SESSION['numStudentsEnrolled']);
    unset($_SESSION['maxStudents']);

//    $myConnection = $newConnection->connection;
    $msg = '';
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $course = $_POST["course"];
    $chk = '';
    if(is_enrolled($_SESSION["user_id"],$course)){
        $msg = '<p class="alert alert-danger">You already registered for this course.</p>'; 
    }else{
        $chk = course_limit($course);
        $maxStudents = $chk["maxStudents"];
        $total_registered = $chk["total_registered"];
        $offering_id = $chk["offering_id"]; 
        if($maxStudents >= $total_registered){
            if(registerForCourse($_SESSION["user_id"],$offering_id)){
                 $msg = '<p class="alert alert-success">You are successfully registered for this course.</p>'; 
            }
        }else{
            $msg = '<p class="alert alert-warning">You are added to the waiting list.</p>'; 
        }
    } 
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Add Course </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sacle=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="//ajax.googleleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container text-center">
       <?php include_once 'top-nav.php';?>
        <?php

            if($_SESSION['selectedYear'] == 2020 && $_SESSION['selectedSemester'] == 'Spring') {
                echo "<h1>Sorry, registration for ".$_SESSION['selectedSemester']." ".$_SESSION['selectedYear']." is closed.</h1>";
            } else {
                echo "<h1>Register for ".$_SESSION['selectedSemester']." ".$_SESSION['selectedYear']."</h1>";
                echo "<h3>Please select the course that you would like to register for</h3>";
            }
            echo $msg;  
        ?>
    </div>
    <div style='margin-bottom:60px' class="container">
        <form class="padding-top" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-row">
                <div class="form-group col-md-12" id="no-padding-left">
                    <label for="inputCourse">Course</label>
                    <select id="inputCourse" class="form-control" name="course" required>
                        <option>Choose...</option>
                        <?php 
                          echo offered_courses_dropdown($_SESSION['selectedSemester'],$_SESSION['selectedYear']); 
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="select_course">Submit</button>
            
        </form>
    </div>

</body>
</html>

<?php
// 
//   
//
//    function maxStudentsForCourse($connection,$offeringId) {
//        $maxStudentsQuery =  "SELECT course.maxStudents
//            FROM course
//            INNER JOIN offering ON offering.course_id = course.course_id
//                AND offering.offering_id = $offeringId";
//        $results = mysqli_query($connection, $maxStudentsQuery);
//        if (mysqli_num_rows($results) == 1) { 
//            while($row = mysqli_fetch_assoc($results)) {
//                $_SESSION['maxStudents'] = $row['maxStudents'];
//            };
//        };
//    };
//
//    function checkIfWaitlisted($connection,$studentId,$offeringId) {
//        $checkIfWaitlistedQuery =  "SELECT COUNT(*) as count
//        FROM waitlist
//        WHERE student_id = $studentId AND offering_id = $offeringId";
//        $results = mysqli_query($connection, $checkIfWaitlistedQuery);
//        if (mysqli_num_rows($results) == 1) { 
//            while($row = mysqli_fetch_assoc($results)) {
//                $_SESSION['waitlisted'] = $row['count'];
//            };
//        };
//    };
//
//    function addToWaitlist($connection,$studentId,$offeringId) {
//        $addToWaitlistQuery =  "INSERT INTO waitlist (student_id, offering_id, dateTimeAdded)
//            VALUES 
//                ($studentId,$offeringId,NOW())";
//        $results = mysqli_query($connection, $addToWaitlistQuery);
//    }
//    
//    function registerForCourse($connection,$studentId,$offeringId) {
//        $registerQuery =  "INSERT INTO enrollment (student_id, offering_id)
//            VALUES 
//                ($studentId,$offeringId)";
//        $results = mysqli_query($connection, $registerQuery);
//    }
?>