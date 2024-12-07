<?php

if(isset($_POST["txtDriverName"]))
{
    //Accept HTML form data
    $dn=$_POST["txtDriverName"];
    $pw=$_POST["txtPassword"];

    //Create a connection to MySQL server
    $con=mysqli_connect("localhost:3306","root","");

    //Select database
    mysqli_select_db($con,"seat_booking");

    //Perform SQL operations
    $sql="SELECT * FROM driverdetails WHERE DriverName='$dn' AND pwrd='$pw'";
    $result=mysqli_query($con,$sql);

    if($row=mysqli_fetch_array($result))
    {
        session_start();
        $_SESSION['txtDriverName']=$un;
        $_SESSION['txtPassword']=$pw;
        $_SESSION["LAT"]=time();
        header("Location:Schedules.php");
    }
    else
    {
        echo "<script>alert('Invalid UserName or Password..');</script>";
       // echo "<b style=color:red;>Invalid username or password";
    }
    
    //Disconnect
    mysqli_close($con);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="stylelogin.css">
    <title>Driver Login</title>
</head>
<body>
    <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p>LIYANAGE .</p>  
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link active">Login</a></li>
                <li><a href="about.html" class="link">About</a></li>
                <li><a href="contact.html" class="link">Contact</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <!--------<button class="btn white-btn" id="loginBtn" onclick="login()">Login</button>------>
            <!-------<button class="btn" id="registerBtn" onclick="register()">Register</button>-------->
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
 
<form name="formlogin" action="#" method="post" onsubmit="return Validation()">
<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- Driver Login Form -------------------------->

        <div class="login-container" id="login">
            <div class="top">
                <header>Driver Login</header>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="txtDriverName" id="txtDriverName" placeholder="Driver Name">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="txtPassword" id="txtPassword" placeholder="Password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Login" onclick="Validation()">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
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

        if(document.getElementById("txtDriverName").value=="")
        {
            msg=msg+"Driver name can't be blank\n";
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