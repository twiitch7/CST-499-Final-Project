<?php
include_once './functions.php';
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Search Courses </title>
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
        <h1>Search for Available Courses</h1>
        <h3>Please select the semester and year that you would like to register for for<h3>
    </div>
    <div style='margin-bottom:60px' class="container">
        <form class="padding-top" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-row">
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="inputSemester">Semester</label>
                    <select id="inputSemester" class="form-control" name="semester" required>
                        <option>Please Select</option>
                        <?php
                           echo semesters_dropdown();
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="inputYear">Year</label>
                    <select id="inputYear" class="form-control" name="year" required>
                        <option>Please Select</option>
                        <?php
                            echo years_dropdown();
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="search_courses">Submit</button>
            <?php 
                if (isset($_POST['search_courses'])) {
                    $_SESSION['selectedSemester'] = test_input($_POST["semester"]);
                    $_SESSION['selectedYear'] = test_input($_POST["year"]);

                    header('location: addcourse.php');
                }                 
            ?>
        </form>
    </div> 
</body>
</html>

