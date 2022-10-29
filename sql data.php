<html>
<body>




Your Email is: <?php echo $_POST["email"]; ?><br>
Your Password is:<?php echo $_POST["password"]; ?><br>
Your First Name is:<?php echo $_POST["first"]; ?><br>

Your Last Name is:<?php echo $_POST["last"]; ?><br>
Your First Address is:<?php echo $_POST["address1"]; ?><br>

Your Second Address is:<?php echo $_POST["address2"]; ?><br>
Your City is:<?php echo $_POST["city"]; ?><br>

Your State is: <?php echo $_POST["state"]; ?><br>
Your Zip is: <?php echo $_POST["zip"]; ?><br>
Your Phone number is: <?php echo $_POST["phone"]; ?><br>
Your Degree is: <?php echo $_POST["degree"]; ?><br>

</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$Email = $_POST['email'];
$Password = $_POST['password'];
$First = $_POST['first'];
$Last = $_POST['last'];
$Address1 = $_POST['address1'];
$Address2 = $_POST['address2'];
$City = $_POST['city'];
$State = $_POST['state'];
$ZIP = $_POST['zip'];
$Phone = $_POST['phone'];
$Degree = $_POST['degree'];




$sql = "INSERT INTO registration_table
VALUES ('$Email', '$Password', '$First', '$Last','$Address1','$Address2', '$City', '$State', '$ZIP', '$Phone', '$Degree')";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
