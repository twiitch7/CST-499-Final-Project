<?php
include_once './functions.php';
//    error_reporting(E_ALL ^ E_NOTICE);
//    require_once('Connect.php');
    unset($_SESSION['dropOfferingId']);
    unset($_SESSION['droppedCourseName']);
    unset($_SESSION['droppedSemester']);
    unset($_SESSION['droppedYear']);
    unset($_SESSION['numStudentsEnrolled']);
    unset($_SESSION['maxStudents']);
    unset($_SESSION['numStudentsOnWaitlist']);
    unset($_SESSION['waitlistedStudentId']);
    unset($_SESSION['dateTimeAdded']);
//    $myConnection = $newConnection->connection;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> View Schedule </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sacle=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="//ajax.googleleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <div style='margin-bottom:60px' class="container text-center">
         <?php include_once 'top-nav.php';?>
        <?php 

            if(isset($_SESSION['name'])) {
                echo "<h1>Here is your course schedule, ".$_SESSION['name']."</h1>";
                echo "<br>";
                echo "<h2>You are registered for:</h2>";

                displayCourseSchedule($_SESSION['user_id']);
            }
            else {
                echo "<h1>Course Schedule Page</h1>";
                echo "<h3>Please login or register</h3>";
            };

            if (isset($_POST['dropButton'])) {  
                echo "<meta http-equiv='refresh' content='0'>";
                $_SESSION['dropOfferingId'] = test_input($_POST["drop"]);                
                dropCourse($_SESSION['user_id'],$_SESSION['dropOfferingId']);
                echo "<p style='padding-top:15px'>You have successfully dropped ".$_SESSION['droppedCourseName']." from ".$_SESSION['droppedSemester']." ".$_SESSION['droppedYear']."</p>";
                echo "<p>Please wait while your schedule is updated.</p>";
                numStudentsEnrolled($_SESSION['dropOfferingId']);
                maxStudentsForCourse($_SESSION['dropOfferingId']);
                if ($_SESSION['numStudentsEnrolled'] == $_SESSION['maxStudents'] - 1) {
                    numStudentsOnWaitlist($_SESSION['dropOfferingId']);
                    if ($_SESSION['numStudentsOnWaitlist'] != 0) {
                        getWaitlistedStudent($myConnection,$_SESSION['dropOfferingId']);
                        registerForCourse($myConnection,$_SESSION['waitlistedStudentId'],$_SESSION['dropOfferingId']);
                        removeStudentFromWaitlist($myConnection,$_SESSION['waitlistedStudentId'],$_SESSION['dropOfferingId'],$_SESSION['dateTimeAdded']);
                        notifyStudent($myConnection,$_SESSION['waitlistedStudentId'],$_SESSION['dropOfferingId']);
                    }
                }
            };

        ?>

    </div>  

</body>
</html>
 