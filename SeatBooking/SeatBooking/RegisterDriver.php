<?php
if(isset($_POST["txtDriverID"])) // corrected the input name to match form field
{
    //Accept HTML Form Data
    $did=$_POST["txtDriverID"]; // corrected variable name
    $dn=$_POST["txtDriverName"];
    $pw=$_POST["txtPassword"];

    //Create a connection with MySQL Server
    $con=mysqli_connect("localhost:3306","root",""); // corrected connection parameters

    //Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    //Select Database
    mysqli_select_db($con,"seat_booking");

    //Perform SQL Operations
    $sql = "INSERT INTO registerdriver(Driver_Id,DriverName,pwrd) VALUES('$did','$dn','$pw')";

    $ret=mysqli_query($con,$sql);

    if($ret)
    {
         echo "<script>alert('Record inserted successfully');</script>" . mysqli_affected_rows($con);
        
        // Redirect to login page after successful insertion
       // header("Location: login.php");
        exit();
    } 
    else
    {
        echo "Error: " . mysqli_error($con);
    }

    //Disconnect from server
    mysqli_close($con);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="stylelogin.css">
    <title>Driver Registration</title>
    
</head>
<body>
<div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p>LIYANAGE .</p>
        </div>
        <div class="nav-button">
            <!-------<button class="btn white-btn" id="loginBtn" onclick="login()">Login</button>------->
            <!----------<button class="btn" id="registerBtn" onclick="register()">Register</button>----->
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<form name="formRegisterDriver" action="#" method="post" onsubmit="return Validation()">
<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- Driver Registration Form -------------------------->

        <div class="login-container" id="register">
            <div class="top">
                <header>Driver Registration</header>
            </div>
            <div class="two-forms">
            <div class="input-box">
                <input type="text" class="input-field" name="txtDriverID" id="txtDriverID" placeholder="Driver ID">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="txtDriverName" id="txtDriverName" placeholder="Driver Name">
                <i class="bx bx-user"></i>
            </div>
        </div>
            <div class="input-box">
                <input type="password" class="input-field" name="txtPassword" id="txtPassword" placeholder="Password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Register Driver" onclick="Validation()">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="T&C.html">Terms & conditions</a></label>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    function Validation()
    {
        var msg="# fix these errors #\n";
        var flag=0;

        if(document.getElementById("txtDriverID").value=="")
        {
            msg=msg+"Driver ID can't be blank\n";
            flag=1;
        }
        if(document.getElementById("txtDriverName").value=="")
        {
            msg=msg+"Driver Name can't be blank\n";
            flag=1;
        }
        if(document.getElementById("txtPassword").value=="")
        {
            msg=msg+"Password can't be blank\n";
            flag=1;
        }
        if(flag==1)
        {
            alert(msg);
            return false; //Prevent form submission
        }
        return true; //Allow form submission
    }
</script>

<script>
   
   function myMenuFunction() 
   {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") 
    {
        i.className += " responsive";
    } 
    else 
    {
        i.className = "nav-menu";
    }
   }
 
</script>

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() 
    {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register()
     {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

</script>

</body>
</html>