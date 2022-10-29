<?php      
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    include_once './functions.php';
    $con = dbConnect();
    $username = $_POST['user'];  
    $password = $_POST['pass'];   
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);
    $sql = "select * from student where email = '$username' and password = '$password'";  
    $result = mysqli_query($con, $sql);   
   if(mysqli_num_rows($result)>0){ 
    $row = mysqli_fetch_assoc($result); 
       $_SESSION["is_login"] = 1;
       $_SESSION["user_id"] = $row['student_id'];
       $_SESSION["email"] = $row['email'];
       $_SESSION["name"] = $row['firstName'].' '.$row['lastName'];
       header("Location: logged in user.php");
       exit;
   }else{
        header("Location:index.php");
        exit;
   }
}else{
    header("Location:index.php");
    exit;
}
  

//header("Location:Logged in user.php?location=" . urlencode($_SERVER['REQUEST_URI']));
// Note: $_SERVER['REQUEST_URI'] is your current page

    