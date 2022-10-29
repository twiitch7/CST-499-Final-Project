?>
<!DOCTYPE html>
<html lang="en">

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body style="font-family:times new roman">
<div class="jumbotron" style="background-color:aqua">
    <div class="container text-center">
        <h1>BSA University</h1>
        <h2>Course Enrollment System</h2>
    </div>

<ul>

<body>  
    
<h1 style="color:blue;font-size:40px;">Course Enrollment System Registration</h1>  
    
<p style="color:green;font-size:18px;">Welcome to the BSA University Course Enrollment Portal! Please follow the below instructions to get registered succesfully.</p>    
      </body>

<li><a href="index.html">Home</a></li>

<li><a href="loginpage.php" title="Link that redirects" onclick="callFunction(this.href);return false;">Login</a></li>

</nav>

<div class="container">


<div class="container signin">

<p>Already have an account? <a href="loginpage.php" title="Link that redirects" onclick="callFunction(this.href);return false;">Please Login Here</a></li>

</div>

</form>

</body>
<form action="sql data.php" method="post">

    <div class="container text-center">
        <h1>Welcome to the Registration Page</h1>
    </div>
    <div style='margin-bottom:60px' class="container">
        <form class="padding-top" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-row">

                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" autocomplete="off" name="email" required>
                </div>
                <div class="form-group col-md-6" id="no-padding-right">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" autocomplete="off" name="password" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="inputFirstName">First Name</label>
                    <input type="firstName" class="form-control" id="inputFirstName" placeholder="First Name" autocomplete="off" name="first" required>
                </div>
                <div class="form-group col-md-6" id="no-padding-right">
                    <label for="inputLastName">Last Name</label>
                    <input type="lastName" class="form-control" id="inputLastName" placeholder="Last Name" autocomplete="off" name="last" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress1">Address</label>
                <input type="text" class="form-control" id="inputAddress1" placeholder="1234 Main St" name="address1" required>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address2">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="city" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control" name="state" required>
                        <option>Choose...</option>
                        <?php
                        $states = ["AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA", "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE", "NH", "NJ", "NM", "NV", "NY", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY"];
                        $stateLength = count($states);
                        for ($i=0; $i<$stateLength; $i++) {
                            echo "<option>$states[$i]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2" id="no-padding-right">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="zip" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="inputPhone">Phone</label>
                    <input type="tel" class="form-control" id="inputPhone" placeholder="123-456-7890" name="phone" required>
                </div>
                <div class="form-group col-md-6" id="no-padding-right">
                    <label for="inputDegree">Degree</label>
                    <input type="text" class="form-control" id="inputDegree" placeholder="B.S. in Computer Software Technology" name="degree" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="register_user">Register</button>
         
                      
                        <h2>Thank you for registering.</h2>
                     
                
                
            
        </form>
    </div>

</body>
</html>