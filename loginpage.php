<html>  
<head>  
    <title>PHP login system</title> 

 
    <link rel = "stylesheet" type = "text/css" href = "style.css">   
</head>  

 
      
</head>  
<body>  
    <div id = "frm">  
<h1 style="color:Blue;font-size:20px;">Login to Course Enrollment System</h1>

        <form name="f1" action = "authenticate.php" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label>  Student ID: </label>  
                <input type = "text" id ="user" name  = "user"  value="Goku@hotmail.com"/>  
            </p>  
            <p>  
                <label> Password: </label>  
                <input type = "password" id ="pass" name  = "pass" value="dbz1" />  
            </p>  
            <p>     
                <input type =  "submit" id = "btn" value = "Login" />  
            </p>  
        </form>  
    </div>  
 
    <script>  
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>  
</body>     
</html>  